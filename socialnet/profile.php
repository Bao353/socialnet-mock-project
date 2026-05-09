<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /socialnet/signin.php");
    exit;
}
require_once 'db.php';

$owner_username = isset($_GET['owner']) ? trim($_GET['owner']) : $_SESSION['username'];
$stmt = $conn->prepare("SELECT username, fullname, description FROM account WHERE username = ?");
$stmt->bind_param("s", $owner_username);
$stmt->execute();
$owner = $stmt->get_result()->fetch_assoc();
$is_own = ($owner_username === $_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Profile - SocialNet</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;min-height:100vh}
.container{max-width:600px;margin:40px auto;padding:0 20px}
.card{background:white;border-radius:16px;box-shadow:0 2px 16px rgba(0,0,0,.08);overflow:hidden}
.cover{height:120px;background:linear-gradient(135deg,#667eea,#764ba2)}
.profile-body{padding:0 30px 30px}
.avatar{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#1a1a2e,#16213e);border:4px solid white;display:flex;align-items:center;justify-content:center;color:white;font-size:32px;font-weight:700;margin-top:-40px;margin-bottom:12px}
.fullname{font-size:22px;font-weight:700;color:#333}
.username{color:#888;font-size:14px;margin-bottom:20px}
.own-badge{display:inline-block;background:#e8f0fe;color:#667eea;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;margin-left:8px}
.desc-box{background:#f8f9fa;border-radius:10px;padding:16px;color:#555;font-size:15px;line-height:1.6}
.desc-empty{color:#bbb;font-style:italic}
.edit-btn{display:inline-block;margin-top:16px;padding:10px 22px;background:linear-gradient(135deg,#667eea,#764ba2);color:white;border-radius:8px;text-decoration:none;font-size:14px;font-weight:600}
.not-found{text-align:center;padding:60px;color:#aaa}
</style>
</head>
<body>
<?php include 'menubar.php'; ?>
<div class="container">
  <?php if ($owner): ?>
  <div class="card">
    <div class="cover"></div>
    <div class="profile-body">
      <div class="avatar"><?= strtoupper(substr($owner['fullname'], 0, 1)) ?></div>
      <div class="fullname">
        <?= htmlspecialchars($owner['fullname']) ?>
        <?php if ($is_own): ?><span class="own-badge">Bạn</span><?php endif; ?>
      </div>
      <div class="username">@<?= htmlspecialchars($owner['username']) ?></div>
      <div class="desc-box">
        <?php if (!empty($owner['description'])): ?>
          <?= nl2br(htmlspecialchars($owner['description'])) ?>
        <?php else: ?>
          <span class="desc-empty">Chưa có mô tả.</span>
        <?php endif; ?>
      </div>
      <?php if ($is_own): ?>
        <a class="edit-btn" href="/socialnet/setting.php">✏️ Chỉnh sửa Profile</a>
      <?php endif; ?>
    </div>
  </div>
  <?php else: ?>
    <div class="not-found">Không tìm thấy người dùng này.</div>
  <?php endif; ?>
</div>
</body>
</html>
