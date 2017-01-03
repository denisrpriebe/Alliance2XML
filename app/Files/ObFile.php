<?php

namespace App\Files;

use App\Files\OrderblankFile;

class ObFile extends OrderblankFile {

    protected function mapData($line) {
        array_push($this->data, [
            'part1' => htmlspecialchars(trim(substr($line, 0, 20)), ENT_NOQUOTES, 'UTF-8'),     // 347087800100CGSTO01
            'part2' => htmlspecialchars(trim(substr($line, 20, 35)), ENT_NOQUOTES, 'UTF-8'),    // KEVIN BEATON
            'part3' => htmlspecialchars(trim(substr($line, 55, 35)), ENT_NOQUOTES, 'UTF-8'),    // STOEL RIVES LLP
            'part4' => htmlspecialchars(trim(substr($line, 90, 35)), ENT_NOQUOTES, 'UTF-8'),    // 101 S CAPITOL BLVD
            'part5' => htmlspecialchars(trim(substr($line, 125, 35)), ENT_NOQUOTES, 'UTF-8'),   // SUITE 1900
            'part6' => htmlspecialchars(trim(substr($line, 160, 30)), ENT_NOQUOTES, 'UTF-8'),   // BOISE, ID 83702
            'part7' => htmlspecialchars(trim(substr($line, 190, 35)), ENT_NOQUOTES, 'UTF-8'),   // empty but could be 'US'
            'part8' => htmlspecialchars(trim(substr($line, 225, 40)), ENT_NOQUOTES, 'UTF-8'),   // US
            'part9' => htmlspecialchars(trim(substr($line, 265, 10)), ENT_NOQUOTES, 'UTF-8'),   // empty but could be 'BLJOHNSON'
            'part10' => htmlspecialchars(trim(substr($line, 275, 27)), ENT_NOQUOTES, 'UTF-8'),  // 032021216540230
            'part11' => htmlspecialchars(trim(substr($line, 302, 6)), ENT_NOQUOTES, 'UTF-8'),   // WEA
            'part12' => htmlspecialchars(trim(substr($line, 308, 35)), ENT_NOQUOTES, 'UTF-8'),  // STOEL RIVES BUISNESS CARD
            'part13' => htmlspecialchars(trim(substr($line, 343, 430)), ENT_NOQUOTES, 'UTF-8'), // should be blank
            'part14' => htmlspecialchars(trim(substr($line, 773, 47)), ENT_NOQUOTES, 'UTF-8'),  // NUPS GROUND          NUG
            'part15' => htmlspecialchars(trim(substr($line, 820, 10)), ENT_NOQUOTES, 'UTF-8'),  // 0000
            'part16' => htmlspecialchars(trim(substr($line, 830, 309)), ENT_NOQUOTES, 'UTF-8'), // should be blank
            'part17' => htmlspecialchars(trim(substr($line, 1139, 1)), ENT_NOQUOTES, 'UTF-8'),  // N
            'part18' => htmlspecialchars(trim(substr($line, 1140, 40)), ENT_NOQUOTES, 'UTF-8'), // empty but could be '12500WENDY ATHERTON'
            'part19' => htmlspecialchars(trim(substr($line, 1180, 35)), ENT_NOQUOTES, 'UTF-8'), // STOEL RIVES LLP
            'part20' => htmlspecialchars(trim(substr($line, 1215, 35)), ENT_NOQUOTES, 'UTF-8'), // 760 SW 9TH AVENUE SUITE 3000
            'part21' => htmlspecialchars(trim(substr($line, 1250, 20)), ENT_NOQUOTES, 'UTF-8'), // PORTLAND, OR 97205
            'part22' => htmlspecialchars(trim(substr($line, 1270, 15)), ENT_NOQUOTES, 'UTF-8'), // empty but could be 'MKH'
            'part23' => htmlspecialchars(trim(substr($line, 1285, 30)), ENT_NOQUOTES, 'UTF-8'), // empty but could be 'CHICAGO, IL 60606-6361'
            'part24' => htmlspecialchars(trim(substr($line, 1315, 35)), ENT_NOQUOTES, 'UTF-8'), // US
            'part25' => htmlspecialchars(trim(substr($line, 1350, 35)), ENT_NOQUOTES, 'UTF-8'), // empty but could be 'US'
            'part26' => htmlspecialchars(trim(substr($line, 0, 7)), ENT_NOQUOTES, 'UTF-8'),     // 3470878
            'part27' => htmlspecialchars(trim(substr($line, 12, 8)), ENT_NOQUOTES, 'UTF-8'),    // 0CGSTO01
            'part28' => htmlspecialchars(trim(substr($line, 282, 20)), ENT_NOQUOTES, 'UTF-8'),  // 16540230
            'part29' => htmlspecialchars(trim(substr($line, 283, 5)), ENT_NOQUOTES, 'UTF-8'),   // 65402
            'part30' => htmlspecialchars(trim(substr($line, 774, 20)), ENT_NOQUOTES, 'UTF-8'),  // UPS GROUND
            'part31' => htmlspecialchars(trim(substr($line, 1140, 5)), ENT_NOQUOTES, 'UTF-8'),  // 12500
            'part32' => htmlspecialchars(trim(substr($line, 1145, 35)), ENT_NOQUOTES, 'UTF-8'), // WENDY ATHERTON
            'part33' => (int) htmlspecialchars(trim(substr($line, 7, 5)), ENT_NOQUOTES, 'UTF-8'),     // 100
        ]);
    }

}
