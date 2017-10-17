<?php
App::uses('AppModel', 'Model');
class MetaTitle extends AppModel {
	public $useTable = false; 
	public function getMetaQuote($cat=0,$id=null){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
			);
		$listMeta[$cat]=array(
			'title'=>'Quote '.$cat.' | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, quote, illustration, purchase',
			'description'=>'Get a quote, dapatkan ilustrasi pembayaran premi yang disesuaikan dengan kebutuhan Anda dan keuangan Anda.'
		);
		if(isset($listMeta[$cat])) return $listMeta[$cat];
		else return $listDefault;
	}
	//meta data customer
	public function getMetaCust($cat=0){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
			);
		
		$listMeta[$cat]=array(
			'title'=>'Data Customer '.CakeSession::read('Purchase.produk').' | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, details, data, information',
			'description'=>'Provide your details, pada halaman ini Anda diharuskan untuk melengkapi data diri untuk mendapatkan ilustrasi secara lengkap.'
		);
		if(isset($listMeta[$cat])) return $listMeta[$cat];
		else return $listDefault;
	}
	//meta data news
	public function getMetaNews($cat=0){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
			);
		
		$listMeta[$cat]=array(
			'title'=>CakeSession::read('News.title').' | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, details, data, kesehatan, artikel kesehatan, berita, information',
			'description'=>CakeSession::read('News.title')
		);
		if(isset($listMeta[$cat])) return $listMeta[$cat];
		else return $listDefault;
	}
	//meta data checkout
	public function getMetaCheckout($cat=0){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
			);
		
		$listMeta[$cat]=array(
			'title'=>'Data Customer | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, details, data, information',
			'description'=>'Provide your details, pada halaman ini Anda diharuskan untuk melengkapi data diri untuk mendapatkan ilustrasi secara lengkap.'
		);
		if(isset($listMeta[$cat])) return $listMeta[$cat];
		else return $listDefault;
	}

	public function getMetaProductDetail($id=0){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
			);

		$listMeta[2] = array(
			'title'=>'Jaga Aman | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi ,  Jaga aman , accidental , cacat , meninggal , protection',
			'description'=>'Jaga aman , Manfaat perlindungan apabila meninggal dunia, cacat total atau cacat sebagian karena mengalami kecelakaan.'
			);
		
		$listMeta[1] = array(
			'title'=>'Jaga Sehat Plus | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga sehat plus , health , kesehatan , hospital , rawat , protection',
			'description'=>'Jaga Sehat Plus , Manfaat perlindungan apabila anda menjalani rawat inap di Rumah Sakit, sesuai dengan pilihan rencana harian yang anda inginkan'
			);
		
		$listMeta[5] = array(
			'title'=>'Jaga Sehat Demam Berdarah | JAGADIRI',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Home, "JAGADIRI", yang menjawab kebutuhan pelanggan akan Instant Protection, Claim Certainty Process dan Best Transparent Price.'
			);
		
		$listMeta[3] = array(
			'title'=>'Jaga Jiwa | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga Jiwa , life , jiwa , protection',
			'description'=>'Jaga Jiwa, produk asuransi yang memberikan perlindungan asuransi terhadap Tertanggung berupa pembayaran Uang Pertanggungan apabila Tertanggung meninggal dunia.'
			);
		$listMeta[4] = array(
			'title'=>'CAF Flexy Link | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , CAF Flexy Link , unit link , investasi , dana , ',
			'description'=>'Jaga Investasi Flexy , merupakan gabungan dari manfaat perlindungan jiwa dan investasi. Melalui produk ini,anda mendapatkan kebebasan untuk memilih sendiri penempatan dana investasi sesuai dengan kebutuhan yang anda inginkan.'
			);
		$listMeta[6] = array(
			'title'=>'Jaga Aman Instan | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga Investasi Flexy , unit link , investasi , dana , ',
			'description'=>'Jaga Aman Instan adalah produk asuransi yang memberikan perlindungan jiwa bagi nasabah atas resiko kecelakaan, termasuk perlindungan pada olahraga dan pekerjaan yang beresiko tinggi'
			);
    $listMeta[10] = array(
			'title'=>'Jaga Sehat | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga sehat plus , health , kesehatan , hospital , rawat , protection , ',
			'description'=>'Jaga Sehat, Produk asuransi yang memberikan perlindungan kesehatan bagi nasabah atas resiko akibat sakit atau kecelakaan berupa santunan harian rawat inap dan santunan pembedahan dalam masa pertanggungan.'
			);
			
    $listMeta[8] = array(
			'title'=>'Jaga Aman Plus | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi ,  Jaga Aman Plus 5 Tahun, accidental , cacat , meninggal , protection',
			'description'=>'Jaga Aman Plus 5 Tahun , Manfaat perlindungan apabila meninggal dunia, cacat total atau cacat sebagian karena mengalami kecelakaan.'
			);
    $listMeta[7] = array(
			'title'=>'Jaga Aman Plus | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi ,  Jaga Aman Plus 7 Tahun, accidental , cacat , meninggal , protection',
			'description'=>'Jaga Aman Plus 7 Tahun , Manfaat perlindungan apabila meninggal dunia, cacat total atau cacat sebagian karena mengalami kecelakaan.'
			);
    $listMeta[9] = array(
			'title'=>'Jaga Jiwa Plus | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga Jiwa , life , jiwa , protection',
			'description'=>'Jaga Jiwa Jaga Jiwa Plus 5 Tahun, produk asuransi yang memberikan perlindungan asuransi terhadap Tertanggung berupa pembayaran Uang Pertanggungan apabila Tertanggung meninggal dunia.'
			);
    $listMeta[11] = array(
			'title'=>'Jaga Sehat Keluarga | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga Jiwa , life , jiwa , protection',
			'description'=>'Jaga Jiwa Jaga Jiwa Plus 7 Tahun, produk asuransi yang memberikan perlindungan asuransi terhadap Tertanggung berupa pembayaran Uang Pertanggungan apabila Tertanggung meninggal dunia.'
			);
    $listMeta[12] = array(
			'title'=>'Jaga MotorKu | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Jaga Jiwa , life , jiwa , protection, Motor, Asuransi Motor',
			'description'=>'Jaga Jiwa Jaga Jiwa Plus 7 Tahun, produk asuransi yang memberikan perlindungan asuransi terhadap Tertanggung berupa pembayaran Uang Pertanggungan apabila Tertanggung meninggal dunia.'
			);


		if(isset($listMeta[$id])) return $listMeta[$id];
		else return $listDefault;
		}

	public function getMeta($act=''){
		$listDefault = array(
			'title'=>'Default',
			'keywords'=>'jagadiri',
			'description'=>'Default'
		);

		$listMeta['home'] = array(
			'title'=>'JAGADIRI Asuransi Tanpa Beban',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Home, JAGADIRI, yang menjawab kebutuhan pelanggan akan Instant Protection, Claim Certainty Process dan Best Transparent Price.');
		
		$listMeta['landing'] = array(
			'title'=>'Intro JAGADIRI Asuransi Tanpa Beban',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Jaga Sehat Plus, Asuransi kesehatan dari JAGADIRI dengan manfaat santunan rawat inap rumah sakit tanpa jaminan plus pengembalian premi, ada maupun tidak ada klaim.');
    
    $listMeta['landing1'] = array(
			'title'=>'Intro JAGADIRI Asuransi Tanpa Beban',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Jaga Sehat Plus, Asuransi kesehatan dari JAGADIRI dengan manfaat santunan rawat inap rumah sakit tanpa jaminan plus pengembalian premi, ada maupun tidak ada klaim.');
      
    $listMeta['landing2'] = array(
			'title'=>'Intro JAGADIRI Asuransi Tanpa Beban',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Jaga Sehat Plus, Asuransi kesehatan dari JAGADIRI dengan manfaat santunan rawat inap rumah sakit tanpa jaminan plus pengembalian premi, ada maupun tidak ada klaim.');
			
    $listMeta['landing3'] = array(
			'title'=>'Intro JAGADIRI Asuransi Tanpa Beban',
			'keywords'=>'jagadiri, caf, asuransi , home, online, claim, insurance, transparant,  instant, protection',
			'description'=>'Jaga Sehat Plus, Asuransi kesehatan dari JAGADIRI dengan manfaat santunan rawat inap rumah sakit tanpa jaminan plus pengembalian premi, ada maupun tidak ada klaim.');
      
		$listMeta['serbaserbi'] = array(
			'title'=>'Asuransi A to Z | JAGADIRI',
			'keywords'=>'jagadiri, caf, asuransi, know insurance, review, kamus,  polis , kesehatan, properti, jiwa',
			'description'=>'Know insurance, Asuransi adalah suatu tindakan, sistem, atau bisnis di mana perlindungan finansial  untuk jiwa, properti, kesehatan dan lain sebagainya.'
		);
		$listMeta['tentangjagadiri'] = array(
			'title'=>'Kisah JAGADIRI | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , About , tentang , salimgroup ',
			'description'=>'About ,Ini adalah perjalanan JAGADIRI, brand yang didirikan oleh PT Central Asia Financial, salah satu bagian dari keluarga besar Salim Group.'
		);
		$listMeta['temukansolusi']=array(
			'title'=>'Temukan Solusi | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi  , Best Plan , recommended , product, solution ',
			'description'=>'Best plan ,  Kami akan membantu Anda untuk menentukan pilihan produk yang seusai untuk kebutuhan Anda. Cukup dengan menjawab pertanyaan - pertanyaan kami berikut ini, untuk memulai proses JAGADIRI.'
		);
		$listMeta['product']=array(
			'title'=>'Temukan Perlindungan Sesuai Kebutuhan | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Product List , accidental , life , health , unit link',
			'description'=>'Product List , Produk asuransi kecelakaan pertama di Indonesia dengan waktu perlindungan suka-suka terserah Anda'
		);
		$listMeta['news']=array(
			'title'=>'Berita | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Berita, Artikel',
			'description'=>'Berita terbaru'
		);
		$listMeta['egift']=array(
			'title'=>'E-Gift | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , E-gift, E-Voucher, Voucher belanja',
			'description'=>'E-Gift Jagadiri'
		);

		$listMeta['egift_bli']=array(
			'title'=>'E-Gift | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , E-gift, E-Voucher, Voucher blibli',
			'description'=>'E-Gift Jagadiri'
		);
		$listMeta['egift_tp']=array(
			'title'=>'E-Gift | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , E-gift, E-Voucher, Voucher tokopedia',
			'description'=>'E-Gift Jagadiri'
		);
		$listMeta['egift_77']=array(
			'title'=>'E-Gift | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , E-gift, E-Voucher, Voucher es teller 77',
			'description'=>'E-Gift Jagadiri'
		);

		$listMeta['egift_redeem']=array(
			'title'=>'E-Gift | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , E-gift, E-Voucher, Voucher belanja',
			'description'=>'E-Gift Jagadiri'
		);
		

		$listMeta['fm']=array(
			'title'=>'Free Movie | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Free Movie, Nonton Gratis',
			'description'=>'Free Movie Jagadiri'
		);
		$listMeta['reservasi_nonton']=array(
			'title'=>'Reservasi Free Movie | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Free Movie, Nonton Gratis',
			'description'=>'Free Movie Jagadiri'
		);

		$listMeta['mom_n_jo_mei17']=array(
			'title'=>'Voucher Mom N Jo | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Mom N Jo, free voucher',
			'description'=>'Free Movie Jagadiri'
		);

		$listMeta['reservasi_finish']=array(
			'title'=>'Reservasi Finish | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Free Movie, Nonton Gratis',
			'description'=>'Free Movie Jagadiri'
		);

		$listMeta['cc_gagal']=array(
			'title'=>'Transaksi Gagal | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Mohon maaf, transaksi anda gagal'
		);
		$listMeta['cc_sukses']=array(
			'title'=>'Transaksi Sukses | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Transaksi anda berhasil'
		);
		$listMeta['klikpaybca_gagal']=array(
			'title'=>'Transaksi Gagal | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Mohon maaf, transaksi anda gagal'
		);
		$listMeta['klikpaybca_sukses']=array(
			'title'=>'Transaksi Sukses | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Transaksi anda berhasil'
		);


		$listMeta['cimb_gagal']=array(
			'title'=>'Transaksi Gagal | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Mohon maaf, transaksi anda gagal'
		);
		$listMeta['cimb_sukses']=array(
			'title'=>'Transaksi Sukses | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Transaksi anda berhasil'
		);

		$listMeta['aftersurvey']=array(
			'title'=>'Terima Kasih | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi',
			'description'=>'Terima Kasih'
		);
		$listMeta['galihdanratna']=array(
			'title'=>'Galih dan Ratna Di adaptasi dari novel apakah film GALIH & RATNA? | Jagadiri',
			'keywords'=>'Jagadiri , CAF , Asuransi , Galih dan Ratna',
			'description'=>'Di adaptasi dari novel apakah film GALIH & RATNA?'
		);

		$listMeta['tebak_kata']=array(
			'title'=>'Jagadiri tebak kata',
			'keywords'=>'Jagadiri , CAF , Asuransi , Galih dan Ratna',
			'description'=>'Jagadiri mini game tebak kata'
		);
		$listMeta['momnjo']=array(
			'title'=>'Mom n Jo | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo',
			'description'=>'Halaman Promo Jagadiri Mom n jo.'
		);






		$listMeta['hubungikami']=array(
			'title'=>'Hubungi Kami | JAGADIRI',
			'keywords'=>'Jagadiri , CAF , Asuransi , Contact , online , claim , message , telp , email',
			'description'=>'Contact , Asuransi cukup rumit bagi Anda? Anda bingung dan tidak tahu harus bertanya pada siapa? Kami siap melayani dan memberikan informasi yang Anda perlukan! '
		);
		
		$listMeta['step2_your_detail']=array(
			'title'=>'Data Customer | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, details, data, information',
			'description'=>'Provide your details, pada halaman ini Anda diharuskan untuk melengkapi data diri untuk mendapatkan ilustrasi secara lengkap.'
		);
		$listMeta['step4_checkout']=array(
			'title'=>'Checkout | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, confirmation, selesai, apply',
			'description'=>'Finish, langkah akhir untuk menyelesaikan ilustrasi dari data dan kebutuhan yang Anda inginkan.'
		);
		$listMeta['step6_finish']=array(
			'title'=>'Payment Page',
			'keywords'=>'Jagadiri, CAF, Asuransi, payment, purchase, slip',
			'description'=>'Payment, pilihan pembayaran yang harus Anda lakukan berdasarkan pilihan asuransi dan premi yang Anda masukkan.'
		);
		$listMeta['premium_payment']=array(
			'title'=>'Bayar Premi Online | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, online, payment, premium',
			'description'=>'Online Premium Payment, pilih polis yang ingin anda bayarkan dan manfaatkan fasilitas pembayaran online kami.'
		);
		$listMeta['claim']=array(
			'title'=>'Klaim Asuransi | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, online, claim',
			'description'=>'Online claim, klaim Anda dapat kami proses setelah melengkapi data terlebih dahulu.'
		);
		$listMeta['login']=array(
			'title'=>'Login | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, login, register, masuk, username, password',
			'description'=>'Login, Anda akan mendapatkan informasi login jika anda sudah pernah membeli salah satu produk kami.'
		);
		$listMeta['thanks_leavenumber']=array(
			'title'=>'Thank You | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, terima kasih',
			'description'=>'Terima kasih telah melakukan pembelian polis Jagadiri Asuransi Tanpa Beban.'
		);
		
		$listMeta['privacy']=array(
			'title'=>'Privacy Policy | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, privacy, policy',
			'description'=>'Privacy Policy Jagadiri.'
		);
		
		$listMeta['black_list']=array(
			'title'=>'Sorry | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, sorry, maaf',
			'description'=>'Halaman maaf Jagadiri.'
		);
    
		$listMeta['promo']=array(
			'title'=>'Promo Gratis Voucher MAP | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo',
			'description'=>'Halaman Promo Jagadiri.'
		);
    
		$listMeta['detail_promo']=array(
			'title'=>'Promo | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo',
			'description'=>'Halaman Promo Jagadiri.'
		);



		$listMeta['jagaamanmudik']=array(
			'title'=>'Mudik 2017 | JAGADIRI',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo',
			'description'=>'Event Jaga Aman Mudik 2017.'
		);

		$listMeta['jagojek_daftar']=array(
			'title'=>'JAGADIRI - GOJEK',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo, Gojek',
			'description'=>'Free Asuransi Jagadiri bekerja sama dengan Gojek.'
		);

		$listMeta['jagojek_isi']=array(
			'title'=>'JAGADIRI - GOJEK',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo, Gojek',
			'description'=>'Free Asuransi Jagadiri bekerja sama dengan Gojek.'
		);

		$listMeta['jagojek_selesai']=array(
			'title'=>'Terima Kasih | JAGADIRI - GOJEK',
			'keywords'=>'Jagadiri, CAF, Asuransi, Promo, Gojek',
			'description'=>'Free Asuransi Jagadiri bekerja sama dengan Gojek.'
		);

		$listMeta['hpn2017']=array(
			'title'=>'JAGADIRI - Hari pelanggan nasional',
			'keywords'=>'Jagadiri, CAF, Asuransi, Hari pelanggan nasional',
			'description'=>'Hari pelanggan nasional'
		);

		$listMeta['gopoint']=array(
			'title'=>'JAGADIRI - Promosi asuransi gratis GO POINT',
			'keywords'=>'Jagadiri, CAF, Asuransi, Hari pelanggan nasional',
			'description'=>'Promosi asuransi gratis GO POINT'
		);



		$listMeta['nicepay_payment']=array(
			'title'=>'Terima kasih atas pembelian Polis',
			'keywords'=>'Jagadiri, CAF, Asuransi,',
			'description'=>'Terima kasih atas pembelian Polis'
		);



		if(isset($listMeta[$act])) return $listMeta[$act];
		else return $listDefault;
	}

    



}
