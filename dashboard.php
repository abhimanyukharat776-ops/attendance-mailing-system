<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Poppins;
      background: linear-gradient(135deg, #43cea2, #185a9d);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .box {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 15px;
      color: white;
      text-align: center;
    }

    button {
      width: 200px;
      padding: 12px;
      margin: 10px;
      border: none;
      border-radius: 8px;
      background: #00c6ff;
      color: white;
    }
  </style>
</head>

<body>
  <div class="box">
    <h2>Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
    <button onclick="location.href='attendance.php'">📊 Attendance</button>
    <button onclick="location.href='finder.php'">🔍 Finder</button>
    <button onclick="location.href='logout.php'" style="background:red;">Logout</button>
  </div>
</body>

</html>