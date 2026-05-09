<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /socialnet/signin.php");
    exit;
}
require_once 'db.php';
$uid = $_SESSION['user_id'];
$stmt2 = $conn->prepare("SELECT username, fullname FROM account WHERE id != ?");
$stmt2->bind_param("i", $uid);
$stmt2->execute();
$result = $stmt2->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Home - SocialNet</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;min-height:100vh}
.container{max-width:700px;margin:40px auto;padding:0 20px}
.welcome-card{background:linear-gradient(135deg,#667eea,#764ba2);color:white;padding:30px;border-radius:16px;margin-bottom:24px;box-shadow:0 8px 32px rgba(102,126,234,.3)}
.welcome-card h2{font-size:26px;margin-bottom:6px}
.welcome-card p{opacity:.85;font-size:15px}
.section-title{font-size:18px;font-weight:700;color:#333;margin-bottom:16px}
.user-list{display:flex;flex-direction:column;gap:12px}
.user-item{background:white;padding:16px 20px;border-radius:12px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,.06);transition:transform .2s}
.user-item:hover{transform:translateY(-2px);box-shadow:0 4px 16px rgba(0,0,0,.1)}
.user-info{display:flex;align-items:center;gap:14px}
.avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:18px}
.user-name{font-weight:600;color:#333 !important;font-size:15px}
.user-handle{color:#666 !important;font-size:13px}
.view-btn{padding:8px 16px;background:#667eea;color:#fff !important;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600}
.empty{text-align:center;color:#aaa;padding:40px;background:white;border-radius:12px}
</style>
</head>
<body>
<?php include 'menubar.php'; ?>
<div class="container">
  <div class="welcome-card">
    <h2>Xin chào, <?= htmlspecialchars($_SESSION['fullname']) ?>! 👋</h2>
    <p>@<?= htmlspecialchars($_SESSION['username']) ?> · Chào mừng trở lại SocialNet</p>
  </div>
  <p class="section-title">👥 Người dùng trong hệ thống</p>
  <div class="user-list">
  <?php if ($result->num_rows === 0): ?>
    <div class="empty">Chưa có người dùng nào khác.</div>
  <?php else: ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="user-item">
        <div class="user-info">
          <div class="avatar"><?= strtoupper(substr($row['fullname'], 0, 1)) ?></div>
          <div>
            <div class="user-name"><?= htmlspecialchars($row['fullname']) ?></div>
            <div class="user-handle">@<?= htmlspecialchars($row['username']) ?></div>
          </div>
        </div>
        <a class="view-btn" href="/socialnet/profile.php?owner=<?= urlencode($row['username']) ?>">Xem Profile</a>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
  </div>
</div>
</body>
</html>
PHPEOF
