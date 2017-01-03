<?php

namespace App\Files;

use App\Files\OrderblankFile;

class TtfFile extends OrderblankFile {
    
    protected function mapData($line) {
        array_push($this->data, [
            'part1' => htmlspecialchars(trim(substr($line, 0, 25)), ENT_NOQUOTES, 'UTF-8'),                         // 347087400100010RASM
            'part2' => htmlspecialchars(trim(substr($line, 0, 7)), ENT_NOQUOTES, 'UTF-8'),                          // 3470874
            'part3' => htmlspecialchars(trim(substr($line, 15, 10)), ENT_NOQUOTES, 'UTF-8'),                        // RASM
            'part4' => htmlspecialchars(trim(substr($line, 25, 10)), ENT_NOQUOTES, 'UTF-8'),                        // LINE1CHA
            'part5' => htmlspecialchars(trim(substr($line, 25, 5)), ENT_NOQUOTES, 'UTF-8'),                         // LINE1
            'part6' => htmlspecialchars(trim(substr($line, 30, 5)), ENT_NOQUOTES, 'UTF-8'),                         // CHA
            'part7' => htmlspecialchars(trim(substr($line, 35, 76)), ENT_NOQUOTES, 'UTF-8'),                        // 014000Carie Gentile
            'part8' => htmlspecialchars(trim(substr($line, 35, 6)), ENT_NOQUOTES, 'UTF-8'),                         // 014000
            'part9' => str_replace('+', '', htmlspecialchars(trim(substr($line, 41, 70)), ENT_NOQUOTES, 'UTF-8')),  // Carie Gentile
            'part10' => htmlspecialchars(trim(substr($line, 111, 10)), ENT_NOQUOTES, 'UTF-8'),                      // line1
            'part11' => htmlspecialchars(trim(substr($line, 121, 4)), ENT_NOQUOTES, 'UTF-8'),                       // 0000
            'part12' => htmlspecialchars(trim(substr($line, 29, 1)), ENT_NOQUOTES, 'UTF-8'),                        // 1 -- from LINE1
            'part13' => htmlspecialchars(trim(substr($line, 115, 6)), ENT_NOQUOTES, 'UTF-8'),                       // 1 -- from line1
            'part14' => (int) htmlspecialchars(trim(substr($line, 35, 3)), ENT_NOQUOTES, 'UTF-8'),                  // 14
            'part15' => (int) htmlspecialchars(trim(substr($line, 35, 3)), ENT_NOQUOTES, 'UTF-8'),                  // 14
            'part16' => (int) htmlspecialchars(trim(substr($line, 7, 5)), ENT_NOQUOTES, 'UTF-8'),                   // 100
        ]);
    }

}
