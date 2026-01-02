<?php
// includes/nav.php
$isLoggedIn = isset($_SESSION['user_id']);
?>
<div class="topnav">
  <a href="/MyTicketSystem/index.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/MyTicketSystem/index.php') ? 'active' : ''; ?>">
    Home
  </a>

  <?php if ($isLoggedIn): ?>
    <a href="/MyTicketSystem/includes/dashboard.php" class="<?php echo (str_contains($_SERVER['SCRIPT_NAME'], 'dashboard.php')) ? 'active' : ''; ?>">
      Dashboard
    </a>
    <a class="logout" href="/MyTicketSystem/logout.php">Logout</a>
  <?php else: ?>
    <a href="/MyTicketSystem/login.php" class="<?php echo (str_contains($_SERVER['SCRIPT_NAME'], 'login.php')) ? 'active' : ''; ?>">
      Login
    </a>
  <?php endif; ?>
</div>
