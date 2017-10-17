<?php

App::uses('AppModel', 'Model');

class Survey extends AppModel
{
    public $useTable = 'hasil_survey_detail';

    
    public function isSurveyed($ipaddress)
    {
        $db = $this->getDataSource();
        $result = $db->fetchAll('SELECT *
                                 FROM aq_hasil_survey_detail
                                 WHERE ip_address = ?', array($ipaddress) );
        
        if( count($result) > 0 )
            return true;    //ip address already exist in database, meaning already done survey
        else
            return false;   //not yet surveyed
    }


    public function getSumberOptions()
    {
        $db = $this->getDataSource();
        $result = $db->fetchAll('SELECT *
                                 FROM aq_sumber_survey
                                 ORDER BY Id_Survey ASC');

        if($result) {
            foreach ($result as $item)
                $data[$item['aq_sumber_survey']['Id_Survey']] = $item['aq_sumber_survey']['Sumber_Survey'];
        }
        
        return $data;
    }


    public function insertSurvey($ipaddress, $sumber, $sumberLainnya)
    {
        $db = $this->getDataSource();
        
        foreach ($sumber as $item) {
            if( $item == 13 ) {   // 13 is id of Sumber Lainnya in database table
                if( $sumberLainnya ) {      //only insert to database if Sumber Lain nya is not empty string
                    $db->fetchAll('INSERT INTO aq_hasil_survey_detail(ip_address, sumber_id, sumber_lain)
                                   VALUES(?, ?, ?)', array($ipaddress, $item, $sumberLainnya) );
                }
            }
            else {
                $db->fetchAll('INSERT INTO aq_hasil_survey_detail(ip_address, sumber_id)
                               VALUES(?, ?)', array($ipaddress, $item) );
            }
        }

        return;
    }
}