<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>About - SocialNet</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;min-height:100vh}
.container{max-width:500px;margin:40px auto;padding:0 20px}
.card{background:white;padding:40px;border-radius:16px;box-shadow:0 2px 16px rgba(0,0,0,.08);text-align:center}
.avatar{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-size:32px;margin:0 auto 20px}
h2{font-size:22px;color:#333;margin-bottom:6px}
.mssv{color:#888;font-size:14px;margin-bottom:24px}
.info-row{display:flex;justify-content:space-between;padding:14px 0;border-bottom:1px solid #f0f0f0;font-size:15px}
.info-row:last-child{border-bottom:none}
.info-label{color:#888;font-weight:500}
.info-value{color:#333;font-weight:600}
.badge{display:inline-block;background:linear-gradient(135deg,#667eea,#764ba2);color:white;padding:6px 18px;border-radius:20px;font-size:13px;margin-top:20px}
</style>
</head>
<body>
<?php include 'menubar.php'; ?>
<div class="container">
  <div class="card">
    <div class="avatar">👨‍🎓</div>
    <h2>Ly Nguyen Bao</h2>
    <p class="mssv">MSSV: 1695555</p>
    <div class="info-row">
      <span class="info-label">Họ và tên</span>
      <span class="info-value">Ly Nguyen Bao</span>
    </div>
    <div class="info-row">
      <span class="info-label">Mã số sinh viên</span>
      <span class="info-value">1695555</span>
    </div>
    <div class="info-row">
      <span class="info-label">Môn học</span>
      <span class="info-value">Computer security</span>
    </div>
    <div class="info-row">
      <span class="info-label">Project</span>
      <span class="info-value">SocialNet</span>
    </div>
    <span class="badge">🌐 SocialNet © 2026</span>
  </div>
</div>
</body>
</html>
EOF
