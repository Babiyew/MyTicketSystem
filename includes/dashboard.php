<?php
require_once __DIR__ . "/auth.php";

switch ($_SESSION['role']) {
  case 'admin':
    header("Location: admin.php");
    exit;
  case 'staff':
    header("Location: staff.php");
    exit;
  case 'member':
    header("Location: member.php");
    exit;
  default:
    header("Location: ../login.php");
    exit;
}
