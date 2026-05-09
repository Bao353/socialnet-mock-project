<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /socialnet/signin.php");
    exit;
}
require_once 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description']);
    $stmt = $conn->prepare("UPDATE account SET description = ? WHERE id = ?");
    $stmt->bind_param("si", $description, $_SESSION['user_id']);
    $stmt->execute();
    $message = "success";
}

$stmt = $conn->prepare("SELECT description FROM account WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Setting - SocialNet</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;min-height:100vh}
.container{max-width:600px;margin:40px auto;padding:0 20px}
.card{background:white;padding:36px;border-radius:16px;box-shadow:0 2px 16px rgba(0,0,0,.08)}
.card h2{font-size:22px;color:#333;margin-bottom:6px}
.card p.sub{color:#888;font-size:14px;margin-bottom:28px}
.alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;background:#d4edda;color:#155724;border:1px solid #c3e6cb}
label{display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:8px}
textarea{width:100%;padding:14px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;outline:none;resize:vertical;font-family:inherit;transition:border .2s}
textarea:focus{border-color:#667eea}
button{margin-top:16px;padding:12px 28px;background:linear-gradient(135deg,#667eea,#764ba2);color:white;border:none;border-radius:8px;font-size:15px;font-weight:600;cursor:pointer}
button:hover{opacity:.9}
</style>
</head>
<body>
<?php include 'menubar.php'; ?>
<div class="container">
  <div class="card">
    <h2>⚙️ Cài đặt Profile</h2>
    <p class="sub">Chỉnh sửa nội dung hiển thị trên trang Profile của bạn</p>
    <?php if ($message): ?>
      <div class="alert">✅ Cập nhật thành công!</div>
    <?php endif; ?>
    <form method="POST">
      <label>Mô tả bản thân</label>
      <textarea name="description" rows="6" placeholder="Viết gì đó về bản thân..."><?= htmlspecialchars($row['description'] ?? '') ?></textarea>
      <button type="submit">💾 Lưu thay đổi</button>
    </form>
  </div>
</div>
</body>
</html>
EOF
