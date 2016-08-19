<?php

namespace App\Utilities;

/**
 * 
 */
class FileUtil {

    /**
     * Deletes a file.
     * 
     * @param string $file
     * @return boolean
     */
    public static function deleteFile($file) {
        return unlink($file);
    }

    /**
     * Extracts the contents of a zip file to the given directory.
     * 
     * @param type $zipFile
     * @param type $directory
     * @return boolean
     */
    public static function extractZipFile($zipFile, $directory) {

        $status = false;

        $zip = new \ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            $zip->extractTo($directory);
            $zip->close();
            $status = true;
        }

        return $status;
    }

}
