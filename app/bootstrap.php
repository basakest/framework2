<?php
//这里的路径都是相对bootstrap.php而言的，不是相对于/public/index.php而言的
require_once('config/Config.php');
require_once('helpers/helper.php');

spl_autoload_register(function($className) {
    require_once('libaries/' . $className . '.php');
});