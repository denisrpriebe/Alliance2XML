<?php

namespace App\Controllers\Auth\System;

use App\Controllers\Controller;
use App\Utilities\DirectoryUtil;
use App\Files\File;
use App\Facades\Components\Response;
use App\Models\Setting;
use App\Models\Item;
use App\Models\History;
use App\Facades\Components\Input;
use App\Facades\Components\Redirect;
use App\Facades\Components\Session;
use App\Files\ObFile;
use App\Files\ThfFile;
use App\Files\TtfFile;
use App\Files\XmlFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SystemController extends Controller {

    /**
     *
     */
    protected function updateSystemSettings() {

        $settings = Setting::find(Input::post('id'));
        $settings->batch_countdown = Input::post('batch_countdown');
        $settings->alliance_in = Input::post('alliance_in');
        $settings->alliance_out = Input::post('alliance_out');
        $settings->alliance_completed = Input::post('alliance_completed');
        $settings->save();

        Session::flash('alert', [
            'type' => 'success',
            'title' => 'System Settings Updated',
            'text' => 'The system settings have been successfully updated.'
        ]);

        Redirect::referrer();
    }

    /**
     *
     */
    protected function getBatchFiles() {

        $allianceInFiles = $this->getAllBatchFiles();
        $data = [];

        foreach ($allianceInFiles as $allianceInFile) {
            $file = new File($allianceInFile);
            $fileArray = [$file->name, $file->size, $file->dateModified];
            array_push($data, $fileArray);
        }

        Response::json(["files" => $data]);
    }

    /**
     * 
     */
    protected function getBatchHistory() {

        $history = History::all();
        $logData = [];

        foreach ($history as $entry) {

            $status = $entry->status == 1 ? 'Successful' : 'Failed';

            $entryArray = [$status, $entry->run_at, $entry->message];
            array_push($logData, $entryArray);
        }

        Response::json(["history" => $logData]);
    }

    /**
     *
     */
    protected function processBatch() {

        $this->checkAllItemNumbers();

        $batchFiles = $this->getBatchFileObjects();

        if (count($batchFiles) == 0) {
            $history = new History;
            $history->status = 1;
            $history->message = 'No Files To Process';
            $history->save();

            Response::json([
                'status' => 'success'
            ]);
        }

        if (((int) count($batchFiles) % 3) != 0) {

            $history = new History;
            $history->status = 0;
            $history->message = 'There is an incorrect number of files in the alliance in directory.';
            $history->save();

            Response::json([
                'status' => 'failed',
                'message' => 'There is an incorrect number of files in the alliance in directory.'
            ]);
        }

        foreach ($batchFiles as $obBatchFile) {

            // OB File Loop
            if ($obBatchFile->file->extension == 'OB') {

                // Main XML Loop
                foreach ($obBatchFile->data as $obDataRow) {

                    $xmlFile = new XmlFile();
                    $xmlFile->loadObDataRow($obDataRow);

                    // THF File Loop
                    foreach ($batchFiles as $thfBatchFile) {
                        if ($thfBatchFile->file->extension == 'THF' && $thfBatchFile->file->basename == $obBatchFile->file->basename) {
                            $xmlFile->loadThfFile($thfBatchFile);
                        }
                    }

                    // TTF File Loop
                    foreach ($batchFiles as $ttfBatchFile) {
                        if ($ttfBatchFile->file->extension == 'TTF' && $ttfBatchFile->file->basename == $obBatchFile->file->basename) {
                            $xmlFile->loadTtfFile($ttfBatchFile);
                        }
                    }

//                    Header('Content-type: text/xml');
//                    print($xmlFile->toXml());
//                    die();
                    $xmlFile->save(Setting::first()->alliance_out);
                }
            }
        }

        $this->moveFiles();

        $history = new History;
        $history->status = 1;
        $history->message = 'Batch Processed';
        $history->save();

        Response::json([
            'status' => 'success'
        ]);
    }

    private function moveFiles() {
        DirectoryUtil::moveAllFilesInDirectory(Setting::first()->alliance_in . '/', Setting::first()->alliance_completed . '/');
    }

    private function checkAllItemNumbers() {

        $batchFiles = $this->getBatchFileObjects();

        foreach ($batchFiles as $thfBatchFile) {
            if ($thfBatchFile->file->extension == 'THF') {
                foreach ($thfBatchFile->data as $thfDataRow) {
                    try {
                        Item::where('item_number', '=', $thfDataRow['part3'])->firstOrFail();
                    } catch (ModelNotFoundException $ex) {

                        $history = new History;
                        $history->status = 0;
                        $history->message = 'The item "' . $thfDataRow['part3'] . '" was not found in the database. Please add this item and run the process again.';
                        $history->save();

                        Response::json([
                            'status' => 'failed',
                            'message' => 'The item "' . $thfDataRow['part3'] . '" was not found in the database. Please add this item and run the process again.'
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Creates the ObFile, ThfFile and TtfFile objects.
     * 
     * @return array
     */
    private function getBatchFileObjects() {

        // the array of ObFile, ThfFile and TtfFile objects
        $batchFileObjects = [];

        foreach ($this->getAllBatchFiles() as $batchFile) {

            $file = new File($batchFile);

            switch ($file->extension) {

                case 'OB':
                    array_push($batchFileObjects, new ObFile($file));
                    break;

                case 'THF':
                    array_push($batchFileObjects, new ThfFile($file));
                    break;

                case 'TTF':
                    array_push($batchFileObjects, new TtfFile($file));
                    break;
            }
        }

        return $batchFileObjects;
    }

    /**
     *
     * @return array
     */
    private function getAllBatchFiles() {
        return DirectoryUtil::getAllFilesInDirectory(Setting::first()->alliance_in);
    }

}
