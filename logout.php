<?php
    // TODO : No redirect (form)
    require_once 'functions.php';
    if(current_user()) unset($_SESSION['current_user']);
    header("Location: ".get_home_url());
?>