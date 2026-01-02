<?php
require_once __DIR__ . "/auth.php";
/**
 * Authentication & Authorization Guard
 * Used by all protected pages (dashboard, tickets, admin, staff, member)
 */

/* ---------- Safe session start ---------- */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ---------- Require login ---------- */
if (!isset($_SESSION['user_id'])) {
    header("Location: /MyTicketSystem/login.php");
    exit;
}

/* ---------- Current user info ---------- */
$currentUserId   = (int) $_SESSION['user_id'];
$currentUsername = $_SESSION['username'] ?? 'User';
$currentRole     = $_SESSION['role'] ?? 'member';

/* ---------- Role helpers (optional but useful) ---------- */
function requireRole(string $role): void {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        http_response_code(403);
        echo "<h2 style='font-family:Arial'>403 – Access Denied</h2>";
        exit;
    }
}

function requireAnyRole(array $roles): void {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles, true)) {
        http_response_code(403);
        echo "<h2 style='font-family:Arial'>403 – Access Denied</h2>";
        exit;
    }
}
