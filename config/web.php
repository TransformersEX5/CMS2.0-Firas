<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbacademy = require __DIR__ . '/dbacademy.php';
$dbacesys = require __DIR__ . '/dbacesys.php';
$dbcitycoll = require __DIR__ . '/dbcitycoll.php';
$dbcityjb = require __DIR__ . '/dbcityjb.php';
$dbcitykk = require __DIR__ . '/dbcitykk.php';
$dbodlcitysys = require __DIR__ . '/dbodlcitysys.php';
$dbclcsys = require __DIR__ . '/dbclcsys.php';

$sysname = 'CMS2.0';




$data = $_SERVER['REQUEST_URI'];

$Url = explode('/', $data);
$NewbaseURL = '/' . $Url[1];



$config = [
    'id' => 'CMS 2.0',
    'name' => $sysname,
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => '/site/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@docsafety' => 'E:/DocumentSafety',
        '@imagesUrl' => 'E:/mypicture',

        //Document Upload folder
        '@documentupload' => 'E:/DocumentUpload',
        '@rmcimage' => 'C:\xampp\htdocs\RMC Image',
        '@CityULogoimagePath' => '\image',

    ],

    'modules' => [

        'staffportal' => [
            'class' => 'app\modules\staffportal\Staffportal',
        ],
        
        'hostel' => [
            'class' => 'app\modules\hostel\Hostel',
        ],
        'convocation' => [
            'class' => 'app\modules\convocation\Convocation',
        ],
        'studentapplication' => [
            'class' => 'app\modules\studentapplication\Studentapplication',
        ],
        'intake' => [
            'class' => 'app\modules\intake\Intake',
        ],

        'staff' => [
            'class' => 'app\modules\staff\Staff',
        ],

        'creditcontrol' => [
            'class' => 'app\modules\creditcontrol\creditcontrol',
        ],

        'datin' => [
            'class' => 'app\modules\datin\Datin',
        ],

        'iso' => [
            'class' => 'app\modules\iso\Iso',
        ],

        'safety' => [
            'class' => 'app\modules\safety\Safety',
        ],

        'recruitment' => [
            'class' => 'app\modules\recruitment\Recruitment',
        ],
        'manpower' => [
            'class' => 'app\modules\manpower\Manpower',
        ],
        'trainingevaluation' => [
            'class' => 'app\modules\trainingevaluation\Trainingevaluation',
        ],
        'agent' => [
            'class' => 'app\modules\agent\Agent',
        ],
        'academiccalendar' => [
            'class' => 'app\modules\academiccalendar\Academiccalendar',
        ],
        'programfeedocument' => [
            'class' => 'app\modules\programfeedocument\Programfeedocument',
        ],
        'studenthandbook' => [
            'class' => 'app\modules\studenthandbook\Studenthandbook',
        ],
        'employeehandbook' => [
            'class' => 'app\modules\employeehandbook\Employeehandbook',
        ],
        'visa' => [
            'class' => 'app\modules\visa\Visa',
        ],
        'marketingadmin' => [
            'class' => 'app\modules\marketingadmin\Marketingadmin',
        ],
        'others' => [
            'class' => 'app\modules\others\Others',
        ],
        'program' => [
            'class' => 'app\modules\program\Program',
        ],
        'programfee' => [
            'class' => 'app\modules\programfee\Programfee',
        ],
        'programfeejb' => [
            'class' => 'app\modules\programfeejb\Programfee',
        ],
        'programfeekk' => [
            'class' => 'app\modules\programfeekk\Programfee',
        ],

        'room' => [
            'class' => 'app\modules\room\Room',
        ],

        'room' => [
            'class' => 'app\modules\room\room',
        ],

        'debt' => [
            'class' => 'app\modules\debtcollection\debt',
        ],

        'admission' => [
            'class' => 'app\modules\admission\Admission',
        ],

        'marketing' => [
            'class' => 'app\modules\marketing\Module',
        ],

        'profile' => [
            'class' => 'app\modules\profile\module',
        ],

        'rmc' => [
            'class' => 'app\modules\rmc\RMC',
        ],

    ],


    'components' => [
        'request' => [


            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4LvW_Ap07sY-Y0iTy-bZhojLcRf2jeMN',
            'baseUrl' => $NewbaseURL,
        ],

        'function' => [
            'class' => 'app\components\FunctionComponent',
        ],

        'common' => [
            'class' => 'app\components\CommonComponent',
        ],

        'training' => [
            'class' => 'app\components\TrainingComponent',
        ],


        'creditcontrol' => [
            'class' => 'app\components\CreditControlComponent',
        ],


        'exam' => [
            'class' => 'app\components\ExamComponent',
        ],
        'marketing' => [
            'class' => 'app\components\MarketingComponent',
        ],
        'finan' => [
            'class' => 'app\components\FinanComponent',
        ],
        'hostel' => [
            'class' => 'app\components\HostelComponent',
        ],
        'human' => [
            'class' => 'app\components\HumanComponent',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        //============================================================================================
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,

            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'xxxx@city.edu.my',
                'password' => 'xxxx',
                'port' => 465,
                'encryption' => 'ssl',
            ],
            // 'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        //============================================================================================

        'mailer_creditcontrol' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'credit.control@city.edu.my',
                'password' => 'financeuci',
                'port' => 465,
                'encryption' => 'ssl',
            ],

            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'mailer_training' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'training@city.edu.my',
                'password' => 'training@008',
                'port' => 465,
                'encryption' => 'ssl',
            ],

            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'mailer_sysadmin' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'sysadmin@city.edu.my',
                'password' => 'sysadmin!@#',
                'port' => 465,
                'encryption' => 'ssl',
            ],

            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'mailer_convocation' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'convocation2023@city.edu.my',
                'password' => 'convo2023',
                'port' => 465,
                'encryption' => 'ssl',
            ],

            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        'mailer_fiqhree' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => 'muhdfiqhree.mahmud@city.edu.my',
                'password' => 'jh24lkjwqhtkjewb4krjw',
                'port' => 465,
                'encryption' => 'ssl',
            ],

            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

        //============================================================================================

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'authManager' =>
        [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],


        'db' => $db,
        'dbacademy' => $dbacademy,
        'dbacesys' => $dbacesys,
        'dbcitycoll' => $dbcitycoll,
        'dbcityjb' => $dbcityjb,
        'dbcitykk' => $dbcitykk,
        'dbodlcitysys' => $dbodlcitysys,
        'dbclcsys' => $dbclcsys,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
