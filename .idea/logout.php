<?php

require_once 'includes/global.inc';

$usertools = new UserTools();
$usertools-> logout();
header("Location: index.php");

?>
