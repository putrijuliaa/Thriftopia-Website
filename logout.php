<?php
    session_start();
    session_destroy();
    echo '<script>window.location="signup.php"</script>';
?>