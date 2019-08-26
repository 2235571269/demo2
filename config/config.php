<?php
return array(
	'logs'=>array(
		'path'=>'backup/logs',
		'type'=>'file'
	),
	'DB'=>array(
		'type'=>'mysqli',
        'tablePre'=>'iwebshop_',
		'read'=>array(
			array('host'=>'127.0.0.1:3306','user'=>'root','passwd'=>'root','name'=>'iwebshop'),
		),

		'write'=>array(
			'host'=>'127.0.0.1:3306','user'=>'root','passwd'=>'root','name'=>'iwebshop',
		),
	),
	'interceptor' => array('themeroute@onCreateController','layoutroute@onCreateView','plugin'),
	'langPath' => 'language',
	'viewPath' => 'views',
	'skinPath' => 'skin',
    'classes' => 'classes.*',
    'rewriteRule' =>'url',
	'theme' => array('pc' => array('huawei' => 'default','sysdm' => 'default','sysseller' => 'default'),'mobile' => array('mobile' => 'default','sysdm' => 'default','sysseller' => 'default')),
	'timezone'	=> 'Etc/GMT-8',
	'upload' => 'upload',
	'dbbackup' => 'backup/database',
	'safe' => 'cookie',
	'lang' => 'zh_sc',
	'debug'=> '1',
	'configExt'=> array('site_config'=>'config/site_config.php'),
	'encryptKey'=>'2f3c5400ae260486ce2115134b0d53c9',
	'authorizeCode' => '',
	'uploadSize' => '10',
	'low_withdraw' => '1',
	'low_bill' => '0',
);
?>