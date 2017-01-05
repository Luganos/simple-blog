<?php

session_start();

// load core files
require_once 'app/vendor/model.php';
require_once 'app/vendor/view.php';
require_once 'app/vendor/controller.php';
require_once 'app/vendor/route.php';

Route::start(); // run router




