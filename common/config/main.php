<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
           // 'cache' => 'cache' //Включаем кеширование
        ],  
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
      /*  'assetManager' => [
            'linkAssets' => true,
        ],*/
    ],
];
