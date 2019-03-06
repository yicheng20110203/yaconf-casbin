<?php
return [
    ENV_LOCAL  => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/usr/local/etc/php/7.1/yaconf/',
        'web_server_hosts'       => ['127.0.0.1']
    ],
    ENV_DEV    => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/opt/www/yaconf/',
        'web_server_hosts'       => ['192.168.30.239']
    ],
    ENV_TEST   => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/opt/www/yaconf/',
        'web_server_hosts'       => ['39.105.39.72','39.96.175.106','39.96.54.142','39.105.146.84']
    ],
    ENV_TEST_1 => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/opt/www/yaconf/',
        'web_server_hosts'       => ['192.168.30.216']
    ],
    ENV_TEST_2 => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/opt/www/yaconf/',
        'web_server_hosts'       => ['39.96.202.150']
    ],
    ENV_PROD   => [
        'config_repo_path'       => '/opt/www/rd/config/',
        'ya_conf_extension_path' => '/opt/www/yaconf/',
        'web_server_hosts'       => ['39.106.30.253', '47.95.254.167', '47.95.124.154', '47.94.139.80']
    ],
];