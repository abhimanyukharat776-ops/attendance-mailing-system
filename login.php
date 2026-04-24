<?php
session_start();
include "database.php";

$error = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid Username or Password!";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins';
      background: linear-gradient(135deg, #667eea, #764ba2);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .box {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 15px;
      color: white;
    }

    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
    }

    button {
      width: 95%;
      padding: 10px;
      background: #00c6ff;
      border: none;
      border-radius: 8px;
      color: white;
    }

    .error {
      color: #ffcccb;
    }
  </style>
</head>

<body>
  <div class="box">
    <center>
      <h2>Login</h2>
    </center >
    <?php if ($error != "") echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button name="login">Login</button>
    </form>
  </div>
</body>

</html>