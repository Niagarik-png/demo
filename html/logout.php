<?php
require_once __DIR__ . '/app/load.php';

$_SESSION = [];
session_destroy();
redirect('/login.php');
