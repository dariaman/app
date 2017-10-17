<?php
/**
 *
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
 * Database configuration class.
 *
 * You can specify multiple configurations for production, development and testing.
 *
 * datasource => The name of a supported datasource; valid options are as follows:
 *  Database/Mysql - MySQL 4 & 5,
 *  Database/Sqlite - SQLite (PHP5 only),
 *  Database/Postgres - PostgreSQL 7 and higher,
 *  Database/Sqlserver - Microsoft SQL Server 2005 and higher
 *
 * You can add custom database datasources (or override existing datasources) by adding the
 * appropriate file to app/Model/Datasource/Database. Datasources should be named 'MyDatasource.php',
 *
 *
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 *
 * host =>
 * the host you connect to the database. To add a socket or port number, use 'port' => #
 *
 * prefix =>
 * Uses the given prefix for all the tables in this database. This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 *
 * schema =>
 * For Postgres/Sqlserver specifies which schema you would like to use the tables in.
 * Postgres defaults to 'public'. For Sqlserver, it defaults to empty and use
 * the connected user's default schema (typically 'dbo').
 *
 * encoding =>
 * For MySQL, Postgres specifies the character encoding to use when connecting to the
 * database. Uses database default not specified.
 *
 * unix_socket =>
 * For MySQL to connect via socket specify the `unix_socket` parameter instead of `host` and `port`
 *
 * settings =>
 * Array of key/value pairs, on connection it executes SET statements for each pair
 * For MySQL : http://dev.mysql.com/doc/refman/5.6/en/set-statement.html
 * For Postgres : http://www.postgresql.org/docs/9.2/static/sql-set.html
 * For Sql Server : http://msdn.microsoft.com/en-us/library/ms190356.aspx
 *
 * flags =>
 * A key/value array of driver specific connection options.
 */
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		//'host' => '103.24.12.244',

		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		//'login' => 'root',
		//'password' => 'C4f$P4sswD#!',
		'database' => 'caf_web',
		'prefix' => 'aq_',
		
		//ecash Mandiri
		'midEcash'=>'centralasiafinance',
		'passwordEcash'=>'pass123456',
		'ecashInitiate'=>'https://mandiri-ecash.com/ecommgateway/services/ecommgwws',
		'ecashValidation'=>'https://mandiri-ecash.com/ecommgateway/validation.html',
		'ecashPayment'=>'https://mandiri-ecash.com/ecommgateway/payment.html',
		
		//'ApiHost'=>'life.caf.co.id',
		'ApiHost'=>'202.169.43.67', //stagging

		//'ApiHost'=>'life.caf.co.id', //stagging


		//'ApiHost'=>'192.168.1.16', //stagging rusak
		//'ApiHost'=>'192.168.1.17', //stagging
		//'ApiHost'=>'life.caf.co.id',
		//'ApiHost'=>'JKT00WEX01',
		//'ApiHost'=>'JKT00WEX02',
		//'klikPayCode'=>'11JAGAWB01',
		//'clearKey'=>'ClearKeyDev2Web1',
		//'klikPayUrl'=>'http://simpg.sprintasia.net:8779/klikpay/webgw',

		'klikPayCode'=>'11JAGADR14',
		'clearKey'=>'ClearKeyDev2Jaga',
		'klikPayUrl'=>'https://simpg.sprintasia.net/klikpay/webgw',
		
		'NicePayUrl'=>'https://dev.nicepay.co.id/nicepay/api/onePass.do',

		'DOurl'=>'https://training.doappx.com/sprintAsia/api/webAuthorization.cfm',
		'ApiCTS'=>'http://192.168.1.141/caf/rest_customers.json', // nolonger in use
		'ApiGrandSpot'=>'http://202.169.39.2/CAF/upload/read_xml_upload.php',
		//'encoding' => 'utf8',

		//CIMB CLICK
		'cimbClick'=>'https://sandbox.e2pay.co.id/epayment/entry.asp',
		'merchantCode'=> 'IF00147',
		'merchantKey'=>'MGvP2YPHnn',

		//raja premi
		'TokenRajaPremi'=>'Slt0do0NNf+ljNi+MJxZqR6u9Fz1FDYlJ1Lkc91Ej/4=',
		'TokenRajaPremiDesc'=>'HK3mMA2rpmS42MbCD6Lvg9yaV5AzhqwtbpyVjCZNn4k=',

		//kapan lagi
		'TokenKapanLagi'=>'8JJpH9a0dPARlMNA1FqCfENOD50',
		'TokenKapanLagiDesc'=>'J+CQP0Ra3x2uNTjUypL3QNWkPig',

		//free movie
		'wsFm'=>'http://202.169.43.67/ws/',
		'keyFm'=>'7FED54BA63911032B72AA697044B6E47',
	);
	
	
	public $livechat = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'caf_chat_livedump',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $api_nicepay = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		//'host' => '202.169.43.67',
		'host' => '192.168.30.18',
		'login' => 'samuel.wicaksana',
		'password' => 'P@ssw0rd',
		'database' => 'prod_life21p',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
	
	
}
