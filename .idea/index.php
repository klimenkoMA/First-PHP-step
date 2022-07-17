<?php

require_once 'includes/global.inc';
?>
<html>
<head>
    <title>Homepage</title>
</head>
<body>
<?php if (isset($_SESSION['logged_in'])) : ?>
    <?php $user = unserialize($_SESSION['user']); ?>
    Hello, <?php echo $user->username; ?>. You are logged in.
    <a href="settings.php">Change E-Mail</a>
<?php else : ?>
    You are not logged in.
    <a href="login.php">Log In</a> | <a href="register.php">Register</a>
<?php endif; ?>
</body>

</html>
