<?php

namespace App\Files;

use App\Files\OrderblankFile;

class ThfFile extends OrderblankFile {
   
    protected function mapData($line) {
        array_push($this->data, [
            'part1' => htmlspecialchars(trim(substr($line, 0, 27)), ENT_NOQUOTES, 'UTF-8'),         // 347087400100SCG54BK
            'part2' => htmlspecialchars(trim(substr($line, 0, 7)), ENT_NOQUOTES, 'UTF-8'),          // 3470874
            'part3' => htmlspecialchars(trim(substr($line, 12, 15)), ENT_NOQUOTES, 'UTF-8'),        // SCG54BK
            'part4' => htmlspecialchars(trim(substr($line, 27, 17)), ENT_NOQUOTES, 'UTF-8'),        // 0000001RASM
            'part5' => htmlspecialchars(trim(substr($line, 27, 7)), ENT_NOQUOTES, 'UTF-8'),         // 0000001
            'part6' => htmlspecialchars(trim(substr($line, 34, 10)), ENT_NOQUOTES, 'UTF-8'),        // RASM
            'part7' => htmlspecialchars(trim(substr($line, 44, 47)), ENT_NOQUOTES, 'UTF-8'),        // NNBLACK0120160623NN20160627N0000SCG54BK
            'part8' => htmlspecialchars(trim(substr($line, 91, 2)), ENT_NOQUOTES, 'UTF-8'),         // NN
            'part9' => (int) htmlspecialchars(trim(substr($line, 7, 5)), ENT_NOQUOTES, 'UTF-8'),    // 100
            'part10' => htmlspecialchars(trim(substr($line, 63, 8)), ENT_NOQUOTES, 'UTF-8'),        // 20160627
            'part11' => (int) htmlspecialchars(trim(substr($line, 27, 7)), ENT_NOQUOTES, 'UTF-8'),  // 0000001 becomes 1
            'part12' => htmlspecialchars(trim(substr($line, 46, 5)), ENT_NOQUOTES, 'UTF-8'),        // BLACK
            'part13' => htmlspecialchars(trim(substr($line, 34, 10)), ENT_NOQUOTES, 'UTF-8'),       // RASM
            'part14' => htmlspecialchars(trim(substr($line, 53, 8)), ENT_NOQUOTES, 'UTF-8'),        // 20160623            
        ]);
    }
    
}
