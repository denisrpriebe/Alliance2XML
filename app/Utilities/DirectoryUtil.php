<?php

namespace App\Utilities;

/**
 * 
 */
class DirectoryUtil {

    /**
     * Returns all files in the given directory.
     *
     * @param type $directory
     * @return array
     */
    public static function getAllFilesInDirectory($directory) {

        $files = array();

        if (is_dir($directory)) {
            if ($directoryHandle = opendir($directory)) {
                while ((($file = readdir($directoryHandle)) !== false)) {
                    if (!in_array($file, array(".", ".."))) {
                        if (!is_dir($directory . "/" . $file)) {
                            array_push($files, $directory . "/" . $file);
                        }
                    }
                }
                closedir($directoryHandle);
            }
        }

        return $files;
    }

    public static function getAllFilesInDirectoryWithExt($directory, $exts = array()) {

        $files = array();

        if (is_dir($directory)) {
            if ($directoryHandle = opendir($directory)) {
                while ((($file = readdir($directoryHandle)) !== false)) {
                    if (!in_array($file, array(".", ".."))) {
                        if (!is_dir($directory . "/" . $file)) {
                            $fileInfo = pathinfo($directory . "/" . $file);
                            if (in_array($fileInfo['extension'], $exts)) {
                                array_push($files, $directory . "/" . $file);
                            }
                        }
                    }
                }
                closedir($directoryHandle);
            }
        }

        return $files;
    }

    /**
     * Returns all directories in the given directory.
     * 
     * @param string $directory
     * @return array
     */
    public static function getAllDirectoriesInDirectory($directory) {

        $files = array();

        if (is_dir($directory)) {
            if ($directoryHandle = opendir($directory)) {
                while ((($file = readdir($directoryHandle)) !== false)) {
                    if (!in_array($file, array(".", ".."))) {
                        if (is_dir($directory . "/" . $file)) {
                            array_push($files, $file);
                        }
                    }
                }
                closedir($directoryHandle);
            }
        }

        return $files;
    }

    public static function moveAllFilesInDirectory($sourceDirectory, $newDirectory) {
        // Get array of all source files
        $files = scandir($sourceDirectory);
// Identify directories
        $source = $sourceDirectory;
        $destination = $newDirectory;
// Cycle through all source files
        foreach ($files as $file) {
            if (in_array($file, array(".", "..")))
                continue;
            // If we copied this successfully, mark it for deletion
            if (copy($source . $file, $destination . $file)) {
                $delete[] = $source . $file;
            }
        }
// Delete all successfully-copied files
        foreach ($delete as $file) {
            unlink($file);
        }
    }

    /**
     * Creates the given directory.
     *
     * @param type $directory
     * @return boolean
     */
    public static function createDirectory($directory) {
        return mkdir($directory);
    }

    /**
     * Deletes a directory and its contents.
     * 
     * @param string $directory
     */
    public static function deleteDirectory($directory) {
        foreach (glob($directory . '/*') as $file) {
            if (is_dir($file)) {
                rrmdir($file);
            } else {
                unlink($file);
            }
        }
        return rmdir($directory);
    }

    /**
     * Removes all files in the given directory except for the given filetypes.
     * 
     * @param array $fileTypes
     * @param string $directory
     */
    public static function removeAllFilesInDirectoryExceptFor(array $fileTypes, $directory) {

        if (is_dir($directory)) {
            if ($directoryHandle = opendir($directory)) {
                while ((($file = readdir($directoryHandle)) !== false)) {
                    if (!in_array($file, array(".", ".."))) {
                        $pathParts = pathinfo($file);
                        if (!in_array($pathParts["extension"], $fileTypes)) {
                            unlink($directory . "/" . $file);
                        }
                    }
                }
                closedir($directoryHandle);
            }
        }
    }

}
