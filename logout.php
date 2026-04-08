<?php
session_start();
require_once __DIR__ . '/utils/functions.php';

session_unset();
session_destroy();

redirect('index.php');