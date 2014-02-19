<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PROGRAMACION.COM.PY',
	'language'=>'es',
	'sourceLanguage'=>'en',
	'charset'=>'utf-8',
	'theme'=>'bootstrap',
	
	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		        'format' => array(
            'datetimeFormat'=>"d M, Y h:m:s a",
        ),
		'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
	    'responsiveCss' => true,
	),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
			'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=facturacion',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'master',
			'charset' => 'utf8',
			//'enableProfiling'=>true,
		),
		
			'coreMessages'=>array(
			'basePath'=>'protected/messages'
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'owner@PROGRAMACION.COM.PY',
		'empresa'=>'PROGRAMACION.COM.PY',
		'version'=>'1.0',
		'autor'=>'Rodrigo Paszniuk',
		'defaultnumberqty'=>'#,##0.00',
		'defaultnumberprice'=>'#,##0',
	),
);