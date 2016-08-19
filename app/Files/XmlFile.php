<?php

namespace App\Files;

use App\Files\ThfFile;
use App\Files\TtfFile;
use SimpleXMLElement;
use App\Models\Font;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class XmlFile {

    /**
     *
     * @var array
     */
    protected $xml = [
        'Header' => [
            'hea_Jobno' => '',
            'hea_Line' => '',
            'hea_PoNo' => '',
            'hea_Stock' => '',
            'hea_Company' => 'NRP',
            'hea_SaveTo' => '\\\Nrpfp01\nrp prep\PrepRobot\sort\\',
            'hea_SaveErr' => '\\\Nrpfp01\nrp prep\PrepRobot\errors\\',
            'hea_DueDate' => '',
            'hea_Quantity' => '',
            'hea_GroupQty' => '',
            'hea_GroupId' => '',
            'hea_BatchId' => ''
        ],
        [
        // artInfo will be added here
        ],
        'artProccess' => [
            'nrpOrderType' => [
                'nrpOrdTyp_State' => 'false',
                'nrpOrdTyp_Error' => '0',
                'nrpOrdTyp_FormatId' => '',
                'nrpOrdTyp_NumbUp' => '',
                'nrpOrdTyp_NumbCol' => '',
                'nrpOrdTyp_Output' => ''
            ],
            'nrpTemplate' => [
                'nrpTem_State' => 'false',
                'nrpTem_Error' => '0',
                'nrpTem_GroupLeavel' => '',
                'nrpTem_TemplateId' => ''
            ],
            'orderBlank' => [
                'ordBla_State' => 'false',
                'ordBla_Error' => '0',
                'ordBla_Printer' => '',
                'ordBla_GroupLeavel' => '',
                'ordBla_DateEnt' => '',
                'ordBla_DateStamp' => '',
                'ordBla_TimeStamp' => '',
                'ordBla_CustNo' => '',
                'ordBla_CustName' => '',
                'ordBla_Addr1' => '',
                'ordBla_Addr2' => '',
                'ordBla_Addr3' => '',
                'ordBla_Addr4' => '',
                'ordBla_Addr5' => '',
                'ordBla_Addr6' => '',
                'ordBla_UserId' => '',
                'ordBla_CustPO' => '',
                'ordBla_UnitOfMeas' => '',
                'ordBla_Disc' => '',
                'ordBla_SpecInst1' => '',
                'ordBla_SpecInst2' => '',
                'ordBla_SpecInst3' => '',
                'ordBla_SpecInst4' => '',
                'ordBla_SpecInst5' => '',
                'ordBla_SpecInst6' => '',
                'ordBla_ShipInst' => '',
                'ordBla_ShipAcctNo' => 'N',
                'ordBla_CarrierDisc' => '',
                'ordBla_OrderType' => 'N',
                'ordBla_Carrier' => '',
                'ordBla_RepDept' => '',
                'ordBla_RepDeptDisc' => '',
                'ordBla_RepReason' => '',
                'ordBla_RepDisc1' => '',
                'ordBla_RepDisc2' => '',
                'ordBla_RepDisc3' => '',
                'ordBla_RepDisc4' => '',
                'ordBla_RepId' => '',
                'ordBla_RepName' => '',
                'ordBla_BillTo1' => '',
                'ordBla_BillTo2' => '',
                'ordBla_BillTo3' => '',
                'ordBla_BillTo4' => '',
                'ordBla_BillTo5' => '',
                'ordBla_BillTo6' => '',
                'ordBla_SendTo' => ''
            ],
            'allianceResponse' => [
                'allRes_State' => 'false',
                'allRes_Error' => '0',
                'allRes_Tracking' => '',
                'allRes_TypsetDate' => '',
                'allRes_TypsetTime' => '',
                'allRes_TypsetMethod' => '',
                'allRes_PlateId' => '',
                'allRes_PlatePosition' => '',
                'allRes_PrintDate' => '',
                'allRea_PrintTime' => '',
                'allRes_ShippmentBoxNumb' => '',
            ]
        ],
    ];

    /**
     *
     * @var type
     */
    protected $artInfo = [
        'artInfo' => [
            'artInf_Path' => '',
            'artInf_Location' => '',
            'artInf_Text' => '',
            'artInf_TextLine' => '',
            'artInf_PointSize' => '',
            'artInf_Alingment' => '',
            'artInf_InkColor' => '',
            'artInf_FontCode' => '',
            'artInf_Font' => '',
            'artInf_Roman' => ''
        ]
    ];

    /**
     *
     */
    protected $nrpTem_GroupLeavel = [
        0 => '',
        1 => 'Single',
        2 => 'Multi',
        3 => 'NoTemplate'
    ];

    /**
     *
     * @var type
     */
    protected $ordBla_GroupLeavel = [
        'Pers' => 'NoTemplate',
        'Riso' => 'Single',
        'Onyx' => 'Multi'
    ];

    /**
     *
     * @var array
     */
    protected $obDataRow;

    /**
     *
     * @param array $obDataRow
     */
    public function loadObDataRow(array $obDataRow) {

        $this->obDataRow = $obDataRow;

        $this->xml['Header']['hea_Jobno'] = $this->obDataRow['part26'];
        $this->xml['artProccess']['orderBlank']['ordBla_CustNo'] = $this->obDataRow['part27'];
        $this->xml['artProccess']['orderBlank']['ordBla_CustName'] = $this->obDataRow['part2'];
        $this->xml['artProccess']['orderBlank']['ordBla_Addr1'] = $this->obDataRow['part3'];
        $this->xml['artProccess']['orderBlank']['ordBla_Addr2'] = $this->obDataRow['part4'];
        $this->xml['artProccess']['orderBlank']['ordBla_Addr3'] = $this->obDataRow['part5'];
        $this->xml['artProccess']['orderBlank']['ordBla_Addr4'] = $this->obDataRow['part6'];
        $this->xml['artProccess']['orderBlank']['ordBla_Addr5'] = $this->obDataRow['part7'];
        $this->xml['artProccess']['orderBlank']['ordBla_CustPO'] = $this->obDataRow['part28'];
        $this->xml['artProccess']['orderBlank']['ordBla_UnitOfMeas'] = $this->obDataRow['part29'];
        $this->xml['artProccess']['orderBlank']['ordBla_Disc'] = $this->obDataRow['part12'];
        $this->xml['artProccess']['orderBlank']['ordBla_CarrierDisc'] = $this->obDataRow['part30'];
        $this->xml['artProccess']['orderBlank']['ordBla_RepId'] = $this->obDataRow['part31'];
        $this->xml['artProccess']['orderBlank']['ordBla_RepName'] = $this->obDataRow['part32'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo1'] = $this->obDataRow['part19'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo2'] = $this->obDataRow['part20'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo3'] = $this->obDataRow['part21'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo4'] = $this->obDataRow['part22'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo5'] = $this->obDataRow['part23'];
        $this->xml['artProccess']['orderBlank']['ordBla_BillTo6'] = $this->obDataRow['part24'];
    }

    /**
     *
     * @param ThfFile $thfFile
     */
    public function loadThfFile(ThfFile $thfFile) {

        foreach ($thfFile->data as $thfDataRow) {
            if ($this->obDataRow['part26'] == $thfDataRow['part2'] && $thfDataRow['part9'] == $this->obDataRow['part33']) {

                $this->xml['Header']['hea_Line'] = $thfDataRow['part9'];
                $this->xml['Header']['hea_Stock'] = $thfDataRow['part3'];
                $this->xml['Header']['hea_DueDate'] = $thfDataRow['part10'];
                $this->xml['Header']['hea_Quantity'] = $thfDataRow['part11'];
                $this->xml['Header']['hea_BatchId'] = $thfFile->file->basename;
                $this->artInfo['artInfo']['artInf_InkColor'] = $thfDataRow['part12'];                

                try {
                    $item = Item::where('item_number', '=', $thfDataRow['part3'])->firstOrFail();
                } catch (ModelNotFoundException $ex) {
                    die('Could not find item for ' . $thfDataRow['part3']);
                }

                $this->xml['artProccess']['nrpOrderType']['nrpOrdTyp_Output'] = $item->outpur;
                $this->xml['artProccess']['nrpOrderType']['nrpOrdTyp_NumbUp'] = $item->up;
                
                switch($item->group) {
                    
                    case '0':
                        break;
                    
                    case '1':
                        $this->xml['artProccess']['nrpTemplate']['nrpTem_GroupLeavel'] = $this->nrpTem_GroupLeavel[1];
                        $this->xml['artProccess']['orderBlank']['ordBla_GroupLeavel'] = $item->up == 1 ? 'Single' : 'Multi';
                        break;
                    
                    case '2':
                        $this->xml['artProccess']['nrpTemplate']['nrpTem_GroupLeavel'] = $this->nrpTem_GroupLeavel[2];
                        $this->xml['artProccess']['orderBlank']['ordBla_GroupLeavel'] = $item->up == 1 ? 'Single' : 'Multi';
                        break;
                    
                    case '3':
                        $this->xml['artProccess']['nrpTemplate']['nrpTem_GroupLeavel'] = 'NoTemplate';
                        $this->xml['artProccess']['orderBlank']['ordBla_GroupLeavel'] = 'NoTemplate';
                        break;
                    
                }

                if (substr($item->plate_type, 0, 1) == 'R') {
                    $this->xml['artProccess']['nrpTemplate']['nrpTem_TemplateId'] = '\\\Nrpfp01\nrp prep\PrepRobot\templates\\' . $thfDataRow['part13'] . 'R.indt';
                    $this->xml['artProccess']['nrpOrderType']['nrpOrdTyp_FormatId'] = $thfDataRow['part13'] . 'R';
                } else {
                    $this->xml['artProccess']['nrpTemplate']['nrpTem_TemplateId'] = '\\\Nrpfp01\nrp prep\PrepRobot\templates\\' . $thfDataRow['part13'] . '.indt';
                    $this->xml['artProccess']['nrpOrderType']['nrpOrdTyp_FormatId'] = $thfDataRow['part13'];
                }

                $this->xml['artProccess']['orderBlank']['ordBla_Printer'] = $item->printer;                
                $this->xml['artProccess']['orderBlank']['ordBla_DateEnt'] = $thfDataRow['part14'];
                $this->xml['artProccess']['allianceResponse']['allRes_TypsetMethod'] = substr($item->plate_type, 0, 1);
            }
        }
    }

    /**
     *
     * @param TtfFile $ttfFile
     */
    public function loadTtfFile(TtfFile $ttfFile) {

        foreach ($ttfFile->data as $ttfDataRow) {
            if ($this->obDataRow['part26'] == $ttfDataRow['part2'] && $ttfDataRow['part16'] == $this->obDataRow['part33']) {

                $artInfo = $this->artInfo;
                $artInfo['artInfo']['artInf_Location'] = $ttfDataRow['part12'];
                $artInfo['artInfo']['artInf_Text'] = $ttfDataRow['part9'];
                $artInfo['artInfo']['artInf_TextLine'] = $ttfDataRow['part13'];
                $artInfo['artInfo']['artInf_PointSize'] = $ttfDataRow['part14'];
                $artInfo['artInfo']['artInf_Alingment'] = 'center';
                $artInfo['artInfo']['artInf_FontCode'] = $ttfDataRow['part6'];

                try {
                    $font = Font::where('code', '=', $ttfDataRow['part6'])->firstOrFail();
                    $artInfo['artInfo']['artInf_Font'] = $font->name;

                    if ($font->use_default == '1') {
                        $artInfo['artInfo']['artInf_Roman'] = $font->name;
                    }

                    $romanId = ((int) $font->roman_id);

                    if ($romanId > 0) {
                        try {
                            $romanIdFont = Font::where('id' , '=', $romanId)->firstOrFail();
                            $artInfo['artInfo']['artInf_Roman'] = $romanIdFont->name;
                        } catch (ModelNotFoundException $ex) {
                            
                        }
                    }
                } catch (ModelNotFoundException $ex) {
                    $artInfo['artInfo']['artInf_Font'] = 'Font Not Found.';
                }

                array_push($this->xml[0], $artInfo);
            }
        }
    }

    public function save($saveDirectory) {
        $saveFileName = date("Ymd") . $this->xml['Header']['hea_Jobno'] . '_' . $this->xml['Header']['hea_Line'] . '.xml';
        $this->toXml($saveDirectory . '/' . $saveFileName);
    }

    /**
     *
     * @return type
     */
    public function toXml($saveDirectory = null) {

        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><artJob></artJob>");
        $this->arrayToXml($this->xml, $xml);

        return $xml->asXML($saveDirectory);
    }

    /**
     *
     * @param type $array
     * @param type $xml
     */
    private function arrayToXml($array, &$xml) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml->addChild("$key");
                    $this->arrayToXml($value, $subnode);
                } else {
                    $this->arrayToXml($value, $xml);
                }
            } else {
                $xml->addChild("$key", "$value");
            }
        }
    }

}
