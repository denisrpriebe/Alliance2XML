<?php

namespace App\Files;

/**
 * Representation
 * 
 */
class File {

    /**
     *
     * @var string 
     */
    public $file;

    /**
     *
     * @var int 
     */
    public $size;

    /**
     *
     * @var string 
     */
    public $extension;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     *
     * @var string
     */
    public $basename;

    /**
     *
     * @var string
     */
    public $directory;

    /**
     *
     * @var type 
     */
    public $dateModified;

    /**
     *
     * @var type 
     */
    public $fullPath;

    /**
     * Constructor - Set the file we are working with.
     * 
     * @param string $file
     */
    public function __construct($file) {
        $this->file = $file;
        $this->analyzeFile();        
    }

    /**
     * String representation of the file.
     * 
     * @return type
     */
    public function __toString() {
        return $this->name;
    }

    /**
     * Main method to build our object.
     * 
     */
    private function analyzeFile() {

        $pathParts = pathinfo($this->file);

        $this->name = $pathParts["basename"];
        $this->basename = $pathParts["filename"];
        $this->directory = $pathParts["dirname"];
        $this->extension = $pathParts["extension"];
        $this->size = filesize($this->file);
        if ($this->size == 0) {
            $this->size = 1;
        }
        $this->dateModified = date("F d Y H:i:s.", filemtime($this->file));
        $this->fullPath = $this->file;
    }

}
