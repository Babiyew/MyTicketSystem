<?php
session_start();
session_unset();
session_destroy();
header("Location: /MyTicketSystem/login.php");
exit;


