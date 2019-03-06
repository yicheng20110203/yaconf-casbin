<?php

define('YII_ENV', 'local');
define('YII_DEBUG', true);

define('FRAMEWORK_PATH', '/opt/www/rd/cms/cms-yii2/vendor/');
define('APP_PATH', '/opt/www/rd/cms/');
define('CONFIG_PATH', '/opt/www/rd/cms/config/casbin/');
define('TEMPLATE_PATH', '/opt/www/rd/cms/views/');

require(FRAMEWORK_PATH . 'autoload.php');
require(FRAMEWORK_PATH . 'yiisoft/yii2/Yii.php');

require(APP_PATH . 'config/common.php');

$GLOBAL_CONFIG = require(APP_PATH . 'config/yaconf/common/config.php');

$config = require(APP_PATH . 'config/web.php');

$application = new yii\web\Application($config);
$application->run();