<?php

session_start();

require_once __DIR__ . '/utils/functions.php';
// require_once __DIR__ . '/utils/auth.php';

$template = __DIR__ . '/templates/index.phtml';
include_once __DIR__ . '/templates/layout.phtml';
