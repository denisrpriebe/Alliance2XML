<?php

namespace App\Files;

use App\Files\File;

abstract class OrderblankFile {
    
    /**
     * The fullpath + filename;
     * 
     * @var string
     */
    public $file;

    /**
     * The content of the ob file. Line by line.
     * 
     * @var array
     */
    protected $content = [];

    /**
     *
     * @var type 
     */
    public $data = [[]];

    public function __construct(File $file) {

        $this->file = $file;

        $fileHandle = fopen($this->file->file, 'r');

        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);
            $this->mapData($line);
            array_push($this->content, $line);
        }
        
        fclose($fileHandle);
        
        $this->cleanData();
    }

    abstract protected function mapData($line);
        
    private function cleanData() {
        
        foreach ($this->data as $key => $dataRow) {
            $errors = array_filter($dataRow);

            if (empty($errors)) {
                unset($this->data[$key]);
            }
        }
        
    }
    
}
