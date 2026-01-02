<?php
require_once __DIR__ . "/auth.php";
require_once __DIR__ . "/db.php";

// Logged-in user info
$userId   = (int)($_SESSION["user_id"] ?? 0);
$username = $_SESSION["username"] ?? "User";
$role     = $_SESSION["role"] ?? "member";

$error = "";
$success = "";

/**
 * ROLE RULES (practical):
 * - admin/staff: can view ALL tickets
 * - member/volunteer/viewer: can view ONLY their own tickets
 */
$canSeeAll = in_array($role, ["admin", "staff"], true);

// ------------------------------
// CREATE TICKET (POST)
// ------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $status = trim($_POST["status"] ?? "open");

  $allowedStatus = ["open", "in_progress", "closed"];
  if (!in_array($status, $allowedStatus, true)) {
    $status = "open";
  }

  if ($title === "") {
    $error = "Title is required.";
  } else {
    $stmt = $conn->prepare("
      INSERT INTO tickets (title, description, status, created_by)
      VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("sssi", $title, $description, $status, $userId);

    if ($stmt->execute()) {
      $success = "Ticket created successfully.";
    } else {
      $error = "Failed to create ticket. Please try again.";
    }

    $stmt->close();
  }
}

// ------------------------------
// FETCH TICKETS (GET)
// ------------------------------
if ($canSeeAll) {
  // Admin/Staff: all tickets
  $stmt = $conn->prepare("
    SELECT t.id, t.title, t.status, t.created_at, u.username AS created_by_name
    FROM tickets t
    LEFT JOIN users u ON u.id = t.created_by
    ORDER BY t.created_at DESC
    LIMIT 200
  ");
} else {
  // Everyone else: own tickets only
  $stmt = $conn->prepare("
    SELECT t.id, t.title, t.status, t.created_at, u.username AS created_by_name
    FROM tickets t
    LEFT JOIN users u ON u.id = t.created_by
    WHERE t.created_by = ?
    ORDER BY t.created_at DESC
    LIMIT 200
  ");
  $stmt->bind_param("i", $userId);
}

$stmt->execute();
$tickets = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tickets</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

<?php require_once __DIR__ . "/nav.php"; ?>

<div class="container">
  <div class="card">
    <h1>Tickets</h1>
    <p class="small">Create a new ticket and view tickets.</p>

    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off" style="margin-top:16px;">
      <label>Title</label>
      <input name="title" type="text" placeholder="e.g., Login issue" required>

      <label>Description</label>
      <textarea name="description" placeholder="Describe the issue briefly (optional)"></textarea>

      <label>Status</label>
      <select name="status">
        <option value="open">open</option>
        <option value="in_progress">in_progress</option>
        <option value="closed">closed</option>
      </select>

      <button type="submit">Create Ticket</button>
    </form>

    <hr style="margin:24px 0; border:none; border-top:1px solid #e5e7eb;">

    <h2>All Tickets</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <?php if ($canSeeAll): ?>
            <th>Created By</th>
          <?php endif; ?>
          <th>Status</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($tickets->num_rows === 0): ?>
          <tr>
            <td colspan="<?php echo $canSeeAll ? 5 : 4; ?>" class="small">No tickets yet.</td>
          </tr>
        <?php else: ?>
          <?php while ($row = $tickets->fetch_assoc()): ?>
            <?php
              $status = $row["status"] ?? "open";
              $badgeClass = "badge " . htmlspecialchars($status);
            ?>
            <tr>
              <td><?php echo (int)$row["id"]; ?></td>
              <td><?php echo htmlspecialchars($row["title"]); ?></td>

              <?php if ($canSeeAll): ?>
                <td><?php echo htmlspecialchars($row["created_by_name"] ?? "unknown"); ?></td>
              <?php endif; ?>

              <td><span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($status); ?></span></td>
              <td><?php echo htmlspecialchars($row["created_at"]); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>

  </div>
</div>

</body>
</html>
