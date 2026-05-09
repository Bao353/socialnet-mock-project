sudo tee /var/www/html/socialnet/signout.php << 'EOF'
<?php
session_start();
session_destroy();
header("Location: /socialnet/signin.php");
exit;
?>
EOF
