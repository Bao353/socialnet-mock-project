
<?php
session_start();
require_once 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: /socialnet/index.php");
        exit;
    } else {
        $error = "Sai username hoặc password!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng Nhập - SocialNet</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);min-height:100vh;display:flex;align-items:center;justify-content:center}
.card{background:white;padding:40px;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.4);width:100%;max-width:420px}
.logo{text-align:center;margin-bottom:24px}
.logo h1{font-size:28px;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;font-weight:700}
.logo p{color:#888;font-size:14px;margin-top:4px}
.alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;background:#f8d7da;color:#721c24;border:1px solid #f5c6cb}
.form-group{margin-bottom:20px}
label{display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px}
input{width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;outline:none;transition:border .2s}
input:focus{border-color:#667eea}
button{width:100%;padding:13px;background:linear-gradient(135deg,#667eea,#764ba2);color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;transition:opacity .2s}
button:hover{opacity:.9}
.divider{text-align:center;color:#aaa;font-size:13px;margin-top:20px}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <h1>🌐 SocialNet</h1>
    <p>Đăng nhập vào tài khoản của bạn</p>
  </div>
  <?php if ($error): ?>
    <div class="alert">❌ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" placeholder="Nhập username..." required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" placeholder="Nhập mật khẩu..." required>
    </div>
    <button type="submit">Đăng Nhập</button>
  </form>
  <p class="divider">Chưa có tài khoản? <a href="/admin/newuser.php" style="color:#667eea;font-weight:600;text-decoration:none">Tạo tài khoản</a></p>
<p class="divider" style="margin-top:8px">SocialNet © 2026</p>
</div>
</body>
</html>
EOF
