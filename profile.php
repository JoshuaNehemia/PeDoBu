<?php
session_start();

// Pastikan data user ada di session dan berbentuk array.
if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    // Jika data user tidak ada, redirect ke halaman login.
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'DM Sans', sans-serif;
      display: flex;
      overflow-x: hidden;
    }
    .sidebar {
      width: 80px;
      background-color: #F8F8F8;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 20px 0;
      border-right: 2px solid #4CAF50;
      position: fixed;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 1000;
    }
    .sidebar img {
      width: 40px;
      height: 40px;
    }
    .sidebar .top-section,
    .sidebar .middle-section,
    .sidebar .bottom-section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .sidebar button {
      background: none;
      border: none;
      margin: 10px 0;
      cursor: pointer;
    }
    .content {
      margin-left: 80px;
      padding: 30px;
      width: 100%;
      display: flex;
      justify-content: space-between;
    }
    .left-profile {
      width: 35%;
      padding: 20px;
    }
    .left-profile h1 {
      font-size: 32px;
      color: #008000;
    }
    .profile-pic {
      width: 100px;
      height: 100px;
      border-radius: 20px;
      object-fit: cover;
    }
    .pedopay-box {
      background-color: #f6f6f6;
      padding: 20px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }
    .pedopay-box button {
      background-color: #f6f6f6;
      border: none;
      cursor: pointer;
    }
    .pedopay-box button img {
      width: 48px;
      height: 52px;
    }
    .pedopay-info .dompet img {
      width: 120px;
      height: 40px;
    }
    .right-menu {
      width: 60%;
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 20px;
    }
    .menu-item {
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 20px;
      font-weight: bold;
      border-bottom: 1px solid #ccc;
      padding: 10px 0;
      text-decoration: none;
      color: black;
    }
    .menu-item:hover {
      color: #4CAF50;
    }
    .menu-item img {
      width: 24px;
      height: 24px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo PedoBu">
    </div>
    <div class="middle-section">
      <button onclick="location.href='home.php'"><img src="assets/images/homeRedup.png" alt="Home"></button>
      <button onclick="location.href='order.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='history.php'"><img src="assets/images/LogoHistory.png" alt="History"></button>
      <button onclick="location.href='profile.php'"><img src="assets/images/profileMenyala.png" alt="Profile"></button>
    </div>
    <div class="bottom-section">
      <button onclick="location.href='index.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>
  <div class="content">
    <div class="left-profile">
      <h1>PROFILE</h1>
      <img src="assets/images/profile.png" alt="Profile Picture" class="profile-pic">
      <p>
        <strong><?php echo htmlspecialchars($user['username']); ?></strong><br>
        <?php echo htmlspecialchars($user['phoneNumber']); ?>
      </p>
      <div class="pedopay-box">
        <div class="pedopay-info">
          <div class="dompet">
            <img src="assets/images/pedopay.png" alt="Pedopay"><br>
          </div>
          <?php echo 'Rp' . htmlspecialchars($user['balance']); ?>
        </div>
        <button><img src="assets/images/LogoTopUp.png" alt="Top Up"></button>
        <button><img src="assets/images/LogoTransfer.png" alt="Transfer"></button>
      </div>
    </div>
    <div class="right-menu">
      <a class="menu-item" href="history.php">
        <img src="assets/images/icon_order.png" alt="Order Icon"> Order <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item" href="home.php">
        <img src="assets/images/icon_discount.png" alt="Discount Icon"> Discount <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item" href="home.php">
        <img src="assets/images/icon_payment.png" alt="Payment Icon"> Payment Method <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item">
        <img src="assets/images/icon_driver.png" alt="Driver Icon"> Driver Partner <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item" href="home.php">
        <img src="assets/images/icon_help.png" alt="Help Icon"> Help & Report <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item" href="home.php">
        <img src="assets/images/icon_language.png" alt="Language Icon"> Language <span style="margin-left:auto;">></span>
      </a>
      <a class="menu-item" href="index.php">
        <img src="assets/images/icon_logout.png" alt="Logout Icon"> Log Out Account <span style="margin-left:auto;">></span>
      </a>
    </div>
  </div>
</body>
</html>
