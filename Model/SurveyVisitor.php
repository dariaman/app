<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class SurveyVisitor extends AppModel {

    public $useTable = 'hasil_survey_saran';

//    public function insertData_surveyVisitor($ip_address, $puas_polis, $saran, $tanggal_survey, $waktu_survey) {
//        $db = $this->getDataSource();
//        $db->fetchAll('INSERT INTO aq_hasil_survey_saran(ip_address, puas_polis, saran, tanggal_survey, waktu_survey)
//               VALUES(?, ?, ?, ?, ?)', array($ip_address, $puas_polis, $saran, $tanggal_survey, $waktu_survey));
//        return;
//    }

}

?>
