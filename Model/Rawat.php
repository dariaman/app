<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rawat
 *
 * @author newbiecihuy
 */
App::uses('AppModel', 'Model');

class Rawat extends AppModel {

//	public $name = 'Rawat';
    //var $name="Promo";
    public $useTable = 'survey_rawat';

    //put your code here
//    public function insertData($nama, $no_telepon, $email, $alamat, $pilihan, $keterangan, $tanggal, $time) {
//        $db = $this->getDataSource();
//
//
//        $result = $db->fetchAll("SELECT * FROM aq_survey_rawat WHERE no_tlp ='$no_telepon' OR email='$email'");
//
//        if (count($result) > 0) {
//
//            echo '<script language="javascript">';
//            echo 'alert(" Data Anda Sudah terdaftar ")';
//            echo '</script>';
//        } else {
//
//            /* pembagian batch(batch jam 06:00 - 12:00, batch jam 12:01 - 18.00, batch jam 18:01 – 05:59) fromat 24 jam,
//             * algorima greeting php
//             */
//
//            $result_id = $db->fetchAll("SELECT id FROM aq_batch WHERE '$time' >= waktu_awal AND '$time' <= waktu_akhir");
//
//            if ($result_id) {
//
//                foreach ($result_id as $item)
//                    $idBatch = $item['aq_batch']['id'];
//            }
////                echo '<script language="javascript">';
////                echo 'alert(" ' . $idBatch . '")';
////                echo '</script>';
//            //return ;
//            /* Penentuan Pemenang
//             * algoritma https://sarcoom.wordpress.com/2014/12/01/menampilkan-data-harian-mingguan-bulanan-dan-tahunan-dengan-mysql/
//             */
////                $result_idBatch = $db->fetchAll("SELECT  * FROM aq_survey_rawat WHERE tanggal='$tanggal' and idBatch ='$idBatch' GROUP BY idBatch");
//            $result_idBatch = $this->Rawat->find('all', array("SELECT  * FROM aq_survey_rawat WHERE tanggal='$tanggal' and idBatch ='$idBatch' GROUP BY idBatch" => array('my_id' => $id)));
////                if (count($result_idBatch) > 0) {
////                    foreach ($result_idBatch as $item)
//            $jumlah_batch = sizeof($result_idBatch);
////                }
////             http://stackoverflow.com/questions/10526518/cakephp-how-to-get-the-count-in-the-query
//            echo '<script language="javascript">';
//            echo 'alert(" ' . $jumlah_batch . '")';
//            echo '</script>';
//            return;
//            if ($jumlah_batch == 8) {
//                $isPemenang = "1";
//                $db->fetchAll('INSERT INTO aq_survey_rawat(nama, no_tlp, email, alamat, pilihan, keterangan, tanggal, time, idBatch, isPemenang)
//               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?)', array($nama, $no_telepon, $email, $alamat, $pilihan, $keterangan, $tanggal, $time, $idBatch, $isPemenang));
//                echo '<script language="javascript">';
//                echo 'alert(" Selamat Data Anda Terpilih Sebagai Pemenang")';
//                echo '</script>';
//            } else {
//
//                $isPemenang = "0";
//                $db->fetchAll('INSERT INTO aq_survey_rawat(nama, no_tlp, email, alamat, pilihan, keterangan, tanggal, time, idBatch, isPemenang)
//                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?)', array($nama, $no_telepon, $email, $alamat, $pilihan, $keterangan, $tanggal, $time, $idBatch, $isPemenang));
//
//                echo '<script language="javascript">';
//                echo 'alert(" Selamat Anda Tidak Terpilih Sebagai Pemenang")';
//                echo 'alert(" Kasihan Deh Lu")';
//                echo '</script>';
//            }
//        }
//         $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
//        return;
//    }

}

?>
