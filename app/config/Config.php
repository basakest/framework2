<?php
//points to /app
//在类中用const APP_ROOT dirname(__DIR__)来定义会报错
define('APP_ROOT', dirname(__DIR__));
//points to /public
define('URL_ROOT', 'http://framework2.localhost');
define('SITE_NAME', 'the name of site');

define('DB_USER', 'root');
define('DB_PASS', '201916ab');
define('DB_NAME', 'cms');
define('DB_HOST', '127.0.0.1');
