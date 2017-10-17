<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
 
	// Router::connect('/', array('controller' => 'front', 'action' => 'landing5'));
	Router::connect('/', array('controller' => 'front', 'action' => 'home'));
	Router::connect('/form_promotion/', array('controller' => 'front', 'action' => 'form_promotion'));
	Router::connect('/landing-second.html', array('controller' => 'front', 'action' => 'landing1'));
	Router::connect('/landing-third.html', array('controller' => 'front', 'action' => 'landing2'));
	Router::connect('/landing-fourth.html', array('controller' => 'front', 'action' => 'landing3'));
  Router::connect('/landing-fifth.html', array('controller' => 'front', 'action' => 'landing4'));
  Router::connect('/landing-first.html', array('controller' => 'front', 'action' => 'landing'));
	Router::connect('/landing-seventh.html', array('controller' => 'front', 'action' => 'landing6'));
	Router::connect('/home', array('controller' => 'front', 'action' => 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/img/captcha.jpg', array('controller' => 'adm', 'action' => 'captcha'));
	Router::connect('/img/captcha-2.jpg', array('controller' => 'adm', 'action' => 'captcha'));
	Router::connect('/customer/login.htm', array('controller' => 'front', 'action' => 'login'));
	Router::connect('/customer/forgot/password.htm', array('controller' => 'front', 'action' => 'forgot_password'));
	Router::connect('/customer/recovery/password.htm', array('controller' => 'front', 'action' => 'recovery_password'));
	Router::connect('/get-a-quote-non-unit-link/:id.htm', array('controller' => 'front', 'action' => 'step1_non_unitlink'),array('pass' => array('id')));
	Router::connect('/get-a-quote-unit-link/:id.htm', array('controller' => 'front', 'action' => 'step1_unitlink'),array('pass' => array('id')));
	Router::connect('/provide-your-detail/:id.htm', array('controller' => 'front', 'action' => 'step2_your_detail'),array('pass' => array('id')));
	Router::connect('/add_your_beneficery/:id.htm', array('controller' => 'front', 'action' => 'step2_add_ah'),array('pass' => array('id')));
	Router::connect('/add_tertanggung/:id.htm', array('controller' => 'front', 'action' => 'step2_add_ta'),array('pass' => array('id')));
	Router::connect('/delete-ahli-waris/:id.htm', array('controller' => 'front', 'action' => 'step2_del_aw'),array('pass' => array('id')));
	Router::connect('/delete-tertanggung/:id.htm', array('controller' => 'front', 'action' => 'step2_del_ta'),array('pass' => array('id')));
	Router::connect('/purchasing/checkout.htm', array('controller' => 'front', 'action' => 'step4_checkout'));
	Router::connect('/purchasing/complete.htm', array('controller' => 'front', 'action' => 'step6_finish'));
	Router::connect('/customer/logout/', array('controller' => 'front', 'action' => 'logout'));
	Router::connect('/sorry.htm', array('controller' => 'front', 'action' => 'black_list'));


	Router::connect('/jmk_add_your_beneficery/:id.htm', array('controller' => 'front', 'action' => 'step1_add_ah'),array('pass' => array('id')));//jmk
	Router::connect('/jmk_delete-ahli-waris/:id.htm', array('controller' => 'front', 'action' => 'step1_del_aw'),array('pass' => array('id')));//jmk

	// product front
	//Router::connect('/product/:id.htm', array('controller' => 'front', 'action' => 'product'),array('pass' => array('id')));
  Router::connect('/promo-badung.htm', array('controller' => 'front', 'action' => 'promo'));
  Router::connect('/promo/:seo.htm', array('controller' => 'front','action'=>'detail_promo'),array('pass' => array('id','seo'),'id' => '[0-9]+'));
	Router::connect('/product/', array('controller' => 'front', 'action' => 'product'));
	Router::connect('/kisah-jagadiri.htm', array('controller' => 'front', 'action' => 'tentangjagadiri'));
	Router::connect('/temukan-solusi.htm', array('controller' => 'front', 'action' => 'temukansolusi'));
	Router::connect('/hubungi-kami.htm', array('controller' => 'front', 'action' => 'hubungikami'));
	Router::connect('/privacy-policy.htm', array('controller' => 'front', 'action' => 'privacy'));
	Router::connect('/product/:id.htm', array('controller' => 'front', 'action' => 'productdetail'),array('pass' => array('id')));
	Router::connect('/asuransi-a-to-z.htm', array('controller' => 'front', 'action' => 'serbaserbi'));
	Router::connect('/login.htm', array('controller' => 'front', 'action' => 'login'));
	Router::connect('/claim.htm', array('controller' => 'front', 'action' => 'claim'));
	Router::connect('/pay-premium.htm', array('controller' => 'front', 'action' => 'premium_payment'));
	Router::connect('/download/:name', array('controller' => 'front', 'action' => 'download'),array('pass' => array('name')));
	Router::connect('/preview/:name', array('controller' => 'front', 'action' => 'preview'),array('pass' => array('name')));
	Router::connect('/preview/', array('controller' => 'front', 'action' => 'list_preview') );
	Router::connect('/cara-klaim/', array('controller' => 'front', 'action' => 'klaim') );
	Router::connect('/promo/', array('controller' => 'front', 'action' => 'promosi') );
	
	Router::connect('/purchasing/response/merchant.htm', array('controller' => 'front', 'action' => 'response_purchase'));
	Router::connect('/purchasing/inquiry/merchant-bca.htm', array('controller' => 'front', 'action' => 'response_bca_inquiry'));
	Router::connect('/purchasing/flag/merchant-bca.htm', array('controller' => 'front', 'action' => 'response_bca_flag'));

	Router::connect('/purchasing/response/payment-credit-card.htm', array('controller' => 'front', 'action' => 'response_creditcard'));
	Router::connect('/credit-card-success/:id.htm', array('controller' => 'front', 'action' => 'cc_sukses'),array('pass' => array('id')));
	Router::connect('/credit-card-failed/:id.htm', array('controller' => 'front', 'action' => 'cc_gagal'),array('pass' => array('id')));

	Router::connect('/pay-premium/response/payment-credit-card.htm', array('controller' => 'front', 'action' => 'response_creditcard_premi'));
	
	Router::connect('/thank-you/:id.htm', array('controller' => 'front', 'action' => 'thanks_klikpaybca'),array('pass' => array('id')));
	Router::connect('/klik-pay-success/:id.htm', array('controller' => 'front', 'action' => 'klikpaybca_sukses'),array('pass' => array('id')));
	Router::connect('/survey-success/', array('controller' => 'front', 'action' => 'aftersurvey') );
	Router::connect('/klik-pay-failed/:id.htm', array('controller' => 'front', 'action' => 'klikpaybca_gagal'),array('pass' => array('id')));
	
	Router::connect('/thank-you-cimb/:id.htm', array('controller' => 'front', 'action' => 'thanks_cimbclick'),array('pass' => array('id')));
	Router::connect('/cimbclicks-success/:id.htm', array('controller' => 'front', 'action' => 'cimb_sukses'),array('pass' => array('id')) );
	Router::connect('/cimbclicks-failed/:id.htm', array('controller' => 'front', 'action' => 'cimb_gagal'),array('pass' => array('id')) );



	Router::connect('/terima-kasih/:id.htm', array('controller' => 'front', 'action' => 'thanks_leavenumber'),array('pass'=>array('id')));

	//LineQuiz
	Router::connect('/linequiz', array('controller' => 'front', 'action' => 'linequiz_index'));
	Router::connect('/linequiz_send', array('controller' => 'front', 'action' => 'linequiz_send'));
	Router::connect('/linequiz_thanks', array('controller' => 'front', 'action' => 'linequiz_thanks'));

	//news
	Router::connect('/news/:id.htm', array('controller' => 'front', 'action' => 'newsdetail'),array('pass' => array('id')));
	Router::connect('/news/', array('controller' => 'front', 'action' => 'news'));
	//Router::redirect('/news/*', 'http://news.jagadiri.co.id', ['status' => 301]);

	//raja premi
	Router::connect('/raja-premi/cek-token.htm', array('controller' => 'front', 'action' => 'raja_premi'));

	//kapanlagi
	Router::connect('/kapan-lagi/cek-token.htm', array('controller' => 'front', 'action' => 'kapan_lagi'));

	//free movie
	//Router::connect('/free-movie/', array('controller' => 'front', 'action' => 'fm'));
	Router::connect('/nonton-gratis/', array('controller' => 'front', 'action' => 'fm'));
	Router::connect('/nonton-gratis/reservasi.htm', array('controller' => 'front', 'action' => 'reservasi_nonton'));
	Router::connect('/nonton-gratis/reservasi-finish.htm', array('controller' => 'front', 'action' => 'reservasi_finish'));
	//Router::connect('/nonton-gratis/reservasi-finish.htm', array('controller' => 'front', 'action' => 'reservasi_finish'));
	Router::connect('/promo/nonton-gratis/', array('controller' => 'front', 'action' => 'petunjuk_fm'));

	//hari pelanggan nasional 2017
	Router::connect('/tiket-hpn/', array('controller' => 'front', 'action' => 'hpn2017'));

	//EGIFT
	//Router::connect('/free-movie/', array('controller' => 'front', 'action' => 'fm'));
	//Router::connect('/e-gift-:id.htm', array('controller' => 'front', 'action' => 'egift'),array('pass' => array('id')) );
	Router::connect('/e-gift-77-:id.htm', array('controller' => 'front', 'action' => 'egift_77'),array('pass' => array('id')) );
	Router::connect('/e-gift-tp-:id.htm', array('controller' => 'front', 'action' => 'egift_tp'),array('pass' => array('id')) );
	Router::connect('/e-gift-bli-:id.htm', array('controller' => 'front', 'action' => 'egift_bli'),array('pass' => array('id')) );
	Router::connect('/e-gift-alf-:id.htm', array('controller' => 'front', 'action' => 'egift_alf'),array('pass' => array('id')) );
	Router::connect('/e-gift-cha-:id.htm', array('controller' => 'front', 'action' => 'egift_cha'),array('pass' => array('id')) );



	Router::connect('/e-gift/redeem.htm', array('controller' => 'front', 'action' => 'egift_redeem'));
	Router::connect('/e-gift/redeem-finish.htm', array('controller' => 'front', 'action' => 'egift_finish'));
	Router::connect('/e-gift/tutorial.htm', array('controller' => 'front', 'action' => 'egift_petunjuk'));
	Router::connect('/e-gift.htm', array('controller' => 'front', 'action' => 'egift_petunjuk'));



	// mom n jo
	Router::connect('/mom-n-jo.htm', array('controller' => 'front', 'action' => 'momnjo'));

	Router::connect('/promo-voucher-mom-n-jo.htm', array('controller' => 'front', 'action' => 'mom_n_jo_mei17'));


	Router::connect('/test1/', array('controller' => 'front', 'action' => 'test'));

	//galihdanratna
	Router::connect('/galihdanratna', array('controller' => 'front', 'action' => 'galihdanratna'));

	//mini-game tebak kata
	Router::connect('/mini-game/tebak-kata.htm', array('controller' => 'front', 'action' => 'tebak_kata'));

	//jaga aman bersama mra
	Router::connect('/jaga-aman-bersama-MRA.htm', array('controller' => 'front', 'action' => 'jagaamanbersamaMRA'));


	//nicepay
	Router::connect('/payment/transfer-virtual-account/:id.htm', array('controller' => 'front', 'action' => 'nicepay_payment'),array('pass' => array('id')) );// fist biling


	Router::connect('/renewal/inquiry/merchant-nicepay.htm', array('controller' => 'front', 'action' => 'Rnicepay_inquiry'));// renewal
	Router::connect('/renewal/payment/merchant-nicepay.htm', array('controller' => 'front', 'action' => 'Rnicepay_payment'));// renewal
	Router::connect('/renewal/reversal/merchant-nicepay.htm', array('controller' => 'front', 'action' => 'Rnicepay_reversal'));// renewal

	//jaga aman bersama gambir
	Router::connect('/jaga-aman-mudik.htm', array('controller' => 'front', 'action' => 'jagaamanmudik'));


	//checkout raja premi
	Router::connect('/jaga-raja-premi.htm', array('controller' => 'front', 'action' => 'checkout_raja_premi'));

	//api nicepay
	Router::connect('/api/nice-pay', array('controller' => 'front', 'action' => 'api_nicepay'));


	//jaga aman bersama gojek
	Router::connect('/jaga-aman-gojek/', array('controller' => 'front', 'action' => 'jagojek_daftar'));
	Router::connect('/jaga-aman-gojek/daftar.htm', array('controller' => 'front', 'action' => 'jagojek_daftar'));
	Router::connect('/jaga-aman-gojek/data-diri.htm', array('controller' => 'front', 'action' => 'jagojek_isi'));
	Router::connect('/jaga-aman-gojek/selesai.htm', array('controller' => 'front', 'action' => 'jagojek_selesai'));
	//jaga aman bersama gojek

	//landing go point
	Router::connect('/go-point/', array('controller' => 'front', 'action' => 'gopoint'));

	Router::connect('/sorry.html', array('controller' => 'front', 'action' => 'sorry'));
	Router::connect('/under_construction.html', array('controller' => 'front', 'action' => 'undermaintanance'));

	//cermati payment
	Router::connect('/purchasing-cermati/checkout.htm', array('controller' => 'front', 'action' => 'step4_checkout_cermati'));



	Router::connect('/purchasing-promo/jaga-motorku.htm', array('controller' => 'front', 'action' => 'jmk_input_vocuher'));





/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
