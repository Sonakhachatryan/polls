<?php
session_start();

require __DIR__ . '/Core/config.php';

require __DIR__ . '/Core/helpers.php';

require __DIR__ . '/Core/autoload.php';

$_SESSION['old_token'] = $_SESSION['token'];
$_SESSION['token'] = generate_csrf_token();

require __DIR__.'/routes.php';





