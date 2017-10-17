<?php
App::uses('AppModel', 'Model');
class LiveChat extends AppModel {
	public $useDbConfig = 'livechat';
	public $useTable = false;
	
// report lama
	public function getReport($a,$b){	
		$db = $this->getDataSource();
		return $db->query("SELECT count(*) total,  
sum(case when waktu = '00' then 1 else 0 end) pukul_00, 
sum(case when waktu = '01' then 1 else 0 end) pukul_01, 
sum(case when waktu = '02' then 1 else 0 end) pukul_02, 
sum(case when waktu = '03' then 1 else 0 end) pukul_03, 
sum(case when waktu = '04' then 1 else 0 end) pukul_04, 
sum(case when waktu = '05' then 1 else 0 end) pukul_05, 
sum(case when waktu = '06' then 1 else 0 end) pukul_06, 
sum(case when waktu = '07' then 1 else 0 end) pukul_07, 
sum(case when waktu = '08' then 1 else 0 end) pukul_08, 
sum(case when waktu = '09' then 1 else 0 end) pukul_09, 
sum(case when waktu = '10' then 1 else 0 end) pukul_10, 
sum(case when waktu = '11' then 1 else 0 end) pukul_11, 
sum(case when waktu = '12' then 1 else 0 end) pukul_12, 
sum(case when waktu = '13' then 1 else 0 end) pukul_13, 
sum(case when waktu = '14' then 1 else 0 end) pukul_14, 
sum(case when waktu = '15' then 1 else 0 end) pukul_15, 
sum(case when waktu = '16' then 1 else 0 end) pukul_16, 
sum(case when waktu = '17' then 1 else 0 end) pukul_17, 
sum(case when waktu = '18' then 1 else 0 end) pukul_18, 
sum(case when waktu = '19' then 1 else 0 end) pukul_19, 
sum(case when waktu = '20' then 1 else 0 end) pukul_20, 
sum(case when waktu = '21' then 1 else 0 end) pukul_21, 
sum(case when waktu = '22' then 1 else 0 end) pukul_22, 
sum(case when waktu = '23' then 1 else 0 end) pukul_23
from ( SELECT `threadid` , from_unixtime(`dtmcreated`,'%H') waktu FROM `wb_message` where from_unixtime(`dtmcreated`,'%Y-%m-%d') between '".$a."' and '".$b."'group by `threadid` ORDER BY `wb_message`.`threadid` DESC) t1 order by waktu");
	}
// end report lama


	//report baru
	public function getReport2($a,$b){	
		$db = $this->getDataSource();

		//'%Y-%m-%d %H:%i:%s'

	// return $db->query("SELECT  FROM_UNIXTIME(wb_thread.`dtmcreated`,'%Y-%m-%d')Tanggal , username AS Nama,  wb_opgroup.`vclocalname` AS Topik ,tmessage AS Kontak, agentname
	// 	FROM wb_thread, wb_message , wb_opgroup
	// 	WHERE wb_thread.`threadid`= wb_message.`threadid`
	// 	AND wb_thread.`groupid`=wb_opgroup.`groupid`
	// 	AND (tmessage LIKE '%HP:%' OR tmessage LIKE '%E-Mail:%')
	// 	AND FROM_UNIXTIME(wb_thread.`dtmcreated`,'%Y-%m-%d') BETWEEN  '".$a."' and '".$b."'
	// 	ORDER BY wb_thread.`threadid` 
	// ");

		return $db->query(" SELECT  FROM_UNIXTIME(wb_thread.`dtmcreated`,'%Y-%m-%d')Tanggal ,DATEDIFF(FROM_UNIXTIME(wb_thread.`dtmcreated`,'%H:%i:%s'),FROM_UNIXTIME(wb_thread.`dtmclosed`,' %H:%i:%s')) AS Durasi , FROM_UNIXTIME(wb_thread.`dtmcreated`,'%Y-%m-%d %H:%i:%s')Time1 , FROM_UNIXTIME(wb_thread.`dtmclosed`,'%Y-%m-%d %H:%i:%s')Time2 ,username AS Nama,  wb_opgroup.`vclocalname` AS Topik ,tmessage AS Kontak, agentname
FROM wb_thread, wb_message , wb_opgroup
WHERE wb_thread.`threadid`= wb_message.`threadid`
AND wb_thread.`groupid`=wb_opgroup.`groupid`
AND (tmessage LIKE '%HP:%' OR tmessage LIKE '%E-Mail:%')
AND FROM_UNIXTIME(wb_thread.`dtmcreated`,'%Y-%m-%d') BETWEEN  '".$a."' AND '".$b."'
ORDER BY wb_thread.`threadid` 
");
	}
	// end report baru
	
}