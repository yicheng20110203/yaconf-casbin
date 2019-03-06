<?php
/**
 * Created by PhpStorm.
 * User: yicheng
 * Date: 2019/1/10
 * Time: 16:06
 */

return [
    'id'           => 'cms',
    'basePath'     => dirname(__DIR__),
    'runtimePath'  => '/opt/log/cms/',
    'viewPath'     => TEMPLATE_PATH,
    'layoutPath'   => TEMPLATE_PATH . 'layouts',
    'defaultRoute' => 'home/index',
    'components'   => [
        'casbin'     => [
            'class'   => '\CasbinAdapter\Yii\Casbin',
            'model'   => [
                'config_type'      => 'file',
                'config_file_path' => CONFIG_PATH,
                'config_text'      => '',
            ],
            'adapter' => '\CasbinAdapter\Yii\Adapter',
            /*'database' => [
                'connection'         => 'db',
                'casbin_rules_table' => '{{%casbin_rule}}',
            ],*/
        ],
        'request'    => [
            'enableCsrfValidation'   => false,
            'enableCookieValidation' => false,
        ],
        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => true
        ],
        'log'        => [
            'traceLevel' => 3,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                ],
            ],
        ],
        /*'db'         => [
            'class'               => 'yii\db\Connection',
            'dsn'                 => DB_DSN,
            'username'            => DB_USERNAME,
            'password'            => DB_PWD,
            'charset'             => 'utf8',
            'enableSchemaCache'   => true,
            // Duration of schema cache.
            'schemaCacheDuration' => 3600,
        ],*/
    ]
];