<?php

// load config file first
require_once ('config.php');

// load basic functions next so that everything after can use them
require_once (LIB_PATH . DS . 'functions.php');

// load core objects
require_once (LIB_PATH . DS . 'session.php');
require_once (LIB_PATH . DS . 'database.php');
require_once (LIB_PATH . DS . 'database_object.php');
require_once (LIB_PATH . DS . 'pagination.php');
require_once (LIB_PATH . DS . 'class_object.php');
// require_once (LIB_PATH . DS . 'pagination_new.php');
require_once (LIB_PATH . DS . "phpMailer" . DS . "class.phpmailer.php");
require_once (LIB_PATH . DS . "phpMailer" . DS . "class.smtp.php");
require_once (LIB_PATH . DS . "phpMailer" . DS . "language" . DS . "phpmailer.lang-en.php");

// load database-related classes
require_once (LIB_PATH . DS . 'user.php');
require_once (LIB_PATH . DS . 'photograph.php');
require_once (LIB_PATH . DS . 'comment.php');
require_once (LIB_PATH . DS . 'logger.php');
require_once (LIB_PATH . DS . 'class.password.php');
require_once (LIB_PATH . DS . 'Smarty-3.1.16' . DS . "libs" . DS . "Smarty.class.php");

?>