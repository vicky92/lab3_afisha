<?php 
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR."..",
	'name' => 'Kinoafisha',
	'import' => array (
		'application.models.*',
		'application.components.*',
        'ext.YiiMongoDbSuite.*',
	),
	'defaultController'=>'Main',
    
 	'components' => array (
        /*'db' => array (
            'connectionString' => 'mysql:host=openserver;dbname=afisha',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'writery255',
            'charset' => 'utf8',
            'tablePrefix' => '',
	    ),*/
        'mongodb' => array(
            'class'            => 'EMongoDB',
            'connectionString' => 'mongodb://localhost',
            'dbName'           => 'afisha',
            'fsyncFlag'        => true,
            'safeFlag'         => true,
            'useCursor'        => false
          ),
	    'urlManager' => array (
	        'urlFormat' => 'path',
	        'showScriptName' => false,
	        'rules' => array(
	            
	        ),
	    ),
    ),
);