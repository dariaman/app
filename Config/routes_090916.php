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
 * http://book.cakephp.org/2.0/en/development/routing.html
 */
Router::connect('/survey/submit', array('controller' => 'front', 'action' => 'submitSurvey'));
Router::connect('/', array('controller' => 'front', 'action' => 'landing5'));
Router::connect('/form_promotion/', array('controller' => 'front', 'action' => 'form_promotion'));
Router::connect('/landing-second.html', array('controller' => 'front', 'action' => 'landing1'));
Router::connect('/landing-third.html', array('controller' => 'front', 'action' => 'landing2'));
Router::connect('/landing-fourth.html', array('controller' => 'front', 'action' => 'landing3'));
Router::connect('/landing-fifth.html', array('controller' => 'front', 'action' => 'landing4'));
Router::connect('/landing-sixth.html', array('controller' => 'front', 'action' => 'landing5'));
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
Router::connect('/get-a-quote-non-unit-link/:id.htm', array('controller' => 'front', 'action' => 'step1_non_unitlink'), array('pass' => array('id')));
Router::connect('/get-a-quote-unit-link/:id.htm', array('controller' => 'front', 'action' => 'step1_unitlink'), array('pass' => array('id')));
Router::connect('/provide-your-detail/:id.htm', array('controller' => 'front', 'action' => 'step2_your_detail'), array('pass' => array('id')));
Router::connect('/add_your_beneficery/:id.htm', array('controller' => 'front', 'action' => 'step2_add_ah'), array('pass' => array('id')));
Router::connect('/add_tertanggung/:id.htm', array('controller' => 'front', 'action' => 'step2_add_ta'), array('pass' => array('id')));
Router::connect('/delete-ahli-waris/:id.htm', array('controller' => 'front', 'action' => 'step2_del_aw'), array('pass' => array('id')));
Router::connect('/delete-tertanggung/:id.htm', array('controller' => 'front', 'action' => 'step2_del_ta'), array('pass' => array('id')));
Router::connect('/purchasing/checkout.htm', array('controller' => 'front', 'action' => 'step4_checkout'));
Router::connect('/purchasing/complete.htm', array('controller' => 'front', 'action' => 'step6_finish'));
Router::connect('/customer/logout/', array('controller' => 'front', 'action' => 'logout'));
Router::connect('/sorry.htm', array('controller' => 'front', 'action' => 'black_list'));

// product front
//Router::connect('/product/:id.htm', array('controller' => 'front', 'action' => 'product'),array('pass' => array('id')));
Router::connect('/promo-badung.htm', array('controller' => 'front', 'action' => 'promo'));

Router::connect('/promo/:seo.htm', array('controller' => 'front', 'action' => 'detail_promo'), array('pass' => array('id', 'seo'), 'id' => '[0-9]+'));
/* popup menang & kalah
 * 1. mendaftarkan pop_up _pemenang.ctp
 * 2.mendaftarkan pop_up_kalah.ctp
 */
Router::connect('/popup_pemenang.htm', array('controller' => 'front', 'action' => 'popup_pemenang'));
Router::connect('/popup_kalah.htm', array('controller' => 'front', 'action' => 'popup_kalah'));
//Router::connect('/success/', array('controller' => 'front', 'action' => 'success'));
Router::connect('/duplicate.htm', array('controller' => 'front', 'action' => 'duplicate'));
//	
Router::connect('/product/', array('controller' => 'front', 'action' => 'product'));
Router::connect('/kisah-jagadiri.htm', array('controller' => 'front', 'action' => 'tentangjagadiri'));
Router::connect('/temukan-solusi.htm', array('controller' => 'front', 'action' => 'temukansolusi'));
Router::connect('/hubungi-kami.htm', array('controller' => 'front', 'action' => 'hubungikami'));
Router::connect('/privacy-policy.htm', array('controller' => 'front', 'action' => 'privacy'));
Router::connect('/product/:id.htm', array('controller' => 'front', 'action' => 'productdetail'), array('pass' => array('id')));
Router::connect('/asuransi-a-to-z.htm', array('controller' => 'front', 'action' => 'serbaserbi'));
Router::connect('/login.htm', array('controller' => 'front', 'action' => 'login'));
Router::connect('/claim.htm', array('controller' => 'front', 'action' => 'claim'));
Router::connect('/pay-premium.htm', array('controller' => 'front', 'action' => 'premium_payment'));
Router::connect('/download/:name', array('controller' => 'front', 'action' => 'download'), array('pass' => array('name')));

Router::connect('/purchasing/response/merchant.htm', array('controller' => 'front', 'action' => 'response_purchase'));
Router::connect('/purchasing/response/payment-credit-card.htm', array('controller' => 'front', 'action' => 'response_creditcard'));
Router::connect('/pay-premium/response/payment-credit-card.htm', array('controller' => 'front', 'action' => 'response_creditcard_premi'));

Router::connect('/thank-you/:id.htm', array('controller' => 'front', 'action' => 'thanks_klikpaybca'), array('id'));
Router::connect('/thank-you/ecashmandiri/:id.htm', array('controller' => 'front', 'action' => 'thanks_ecash'), array('pass' => array('id')));
Router::connect('/terima-kasih/:id.htm', array('controller' => 'front', 'action' => 'thanks_leavenumber'), array('pass' => array('id')));

//LineQuiz
Router::connect('/linequiz', array('controller' => 'front', 'action' => 'linequiz_index'));
Router::connect('/linequiz_send', array('controller' => 'front', 'action' => 'linequiz_send'));
Router::connect('/linequiz_thanks', array('controller' => 'front', 'action' => 'linequiz_thanks'));

//Hubungi Saya
Router::connect('/products/contact_us', array('controller' => 'front', 'action' => 'contact_us'));

//Router::connect('/nama', array('controller' => 'front', 'action' => 'lemparnama'));

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
