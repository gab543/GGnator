<?php
session_start();
require_once './utils/functions.php';

session_unset();
session_destroy();

redirect('index.php');