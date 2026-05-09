<?php
require_once '../socialnet/db.php';
$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO account (username, fullname, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $fullname, $password);

    try {
    $stmt->execute();
    header("Location: /socialnet/signin.php");
    exit;
} catch (Exception $e) {
    $message = "Username đã tồn tại, vui lòng chọn username khác.";
    $success = false;
}
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin - Tạo User</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);min-height:100vh;display:flex;align-items:center;justify-content:center}
.card{background:white;padding:40px;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.2);width:100%;max-width:420px}
h2{text-align:center;color:#333;margin-bottom:8px;font-size:24px}
.subtitle{text-align:center;color:#888;font-size:14px;margin-bottom:30px}
.alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;font-weight:500}
.success{background:#d4edda;color:#155724;border:1px solid #c3e6cb}
.error{background:#f8d7da;color:#721c24;border:1px solid #f5c6cb}
.form-group{margin-bottom:20px}
label{display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px}
input{width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;outline:none;transition:border .2s}
input:focus{border-color:#667eea}
button{width:100%;padding:13px;background:linear-gradient(135deg,#667eea,#764ba2);color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer}
button:hover{opacity:.9}
.badge{text-align:center;margin-bottom:24px}
.badge span{background:#667eea;color:white;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:600}
.back-link{display:block;text-align:center;margin-top:16px;color:#667eea;text-decoration:none;font-size:14px;font-weight:600}
.back-link:hover{text-decoration:underline}
</style>
</head>
<body>
<div class="card">
  <div class="badge"><span>ADMIN PANEL</span></div>
  <h2>Tạo User Mới</h2>
  <p class="subtitle">Thêm tài khoản vào hệ thống SocialNet</p>
  <?php if ($message): ?>
    <div class="alert <?= $success ? 'success' : 'error' ?>">
      <?= $success ? '✅ ' : '❌ ' ?><?= htmlspecialchars($message) ?>
    </div>
  <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" placeholder="Nhập username..." required>
    </div>
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="fullname" placeholder="Nhập họ tên đầy đủ..." required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" placeholder="Nhập mật khẩu..." required>
    </div>
    <button type="submit">Tạo User</button>
  </form>
  <a class="back-link" href="/socialnet/signin.php">← Quay lại trang đăng nhập</a>
</div>
</body>
</html>

