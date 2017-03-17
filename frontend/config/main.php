<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'modules' => [
        'reportico' => [
        'class' => 'reportico\reportico\Module' ,
        'controllerMap' => [
            'reportico' => 'reportico\reportico\controllers\ReporticoController',
            'mode' => 'reportico\reportico\controllers\ModeController',
            'ajax' => 'reportico\reportico\controllers\AjaxController',
            ]
        ],     
    ],
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            'api/bus-out' => 'api/bus-out',
            'api/bus-in' => 'api/bus-in',

            ],
        ],
        'request' => [
            'parsers' => [
               'application/json' => 'yii\web\JsonParser',
            ]
         ],    
        
       'formatter' => [
       'class' => 'yii\i18n\Formatter',
       'dateFormat' => 'd-M-Y',
       'datetimeFormat' => 'd-M-Y H:i:s',
       'timeFormat' => 'H:i:s', ]
    ],

    
    'params' => $params,
    'defaultRoute' => 'site/login',

];
