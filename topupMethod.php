<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top Up</title>
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

    .sidebar img {
       width: 40px;
      height: 40px;
    }

    .content {
      margin-left: 80px;
      flex-grow: 1;
      padding: 30px;
      position: relative;
    }

    .left-wrapper {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .title-area {
      position: absolute;
      top: 60px;
      left: 45px;
    }

    .title {
      font-size: 65px;
      font-weight: bold;
      color: #00723F;
      margin-bottom: 10px;
    }

    .subtitle {
      font-size: 24px;
      color: #555;
      margin-bottom: 20px;
    }

    .left-panel {
      background-color: #f2f2f2;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      width: 650px;
      margin-top: 140px;
    }

    .payment-methods {
      display: grid;
      grid-template-columns: repeat(4, 120px);
      gap: 20px;
    }

    .method {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 30px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .method img {
      height: 40px;
      margin-bottom: 8px;
    }

    .method a {
      text-decoration: none;
      color: #333;
      display: block;
    }

    .right-panel {
  display: flex;
  align-items: center;
  justify-content: right;
  margin-top: -450px;
  margin-right: 70px;
}

.right-panel img {
  width: 500px;
}
.main-panel {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-top: 50px;
  padding-right: 70px;
}
  </style>
</head>
<body>
<div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo PedoBu">
    </div>
    <div class="middle-section">
      <button onclick="location.href='home.php'"><img src="assets/images/LogoHome.png" alt="Home"></button>
      <button onclick="location.href='order.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='history.php'"><img src="assets/images/LogoHistory.png" alt="History"></button>
      <button onclick="location.href='profile.php'"><img src="assets/images/LogoProfile.png" alt="Profile"></button>
    </div>
    <div class="bottom-section">
      <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <div class="content">
    <!-- Judul -->
    <div class="title-area">
      <div class="title">Top Up</div>
      <div class="subtitle">Pilih metode pembayaran</div>
    </div>
    <div class="main-panel">
    <!-- Kiri -->
      <div class="left-panel">
        <div class="payment-methods">
          <div class="method">
          <a href="TopUpProcess.php?method=Alfamart">
              <img src="assets/images/LogoAlfamart.png" alt="Alfamart">
              Alfamart
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=Indomaret">
              <img src="assets/images/LogoIndomaret.png" alt="Indomaret">
              Indomaret
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=Dana">
              <img src="assets/images/LogoDana.png" alt="Dana">
              Dana
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=Paypal">
              <img src="assets/images/LogoPaypal.png" alt="Paypal">
              Paypal
            </a>
          </div>
          <div class="method">
            <a href="TopUpProcess.php?method=BCA">
              <img src="assets/images/LogoBCA.png" alt="BCA">
              BCA
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=BNI">
              <img src="assets/images/LogoBNI.png" alt="BNI">
              BNI
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=Mandiri">
              <img src="assets/images/LogoMandiri.png" alt="Mandiri">
              Mandiri
            </a>
          </div>
          <div class="method">
          <a href="TopUpProcess.php?method=Mega">
              <img src="assets/images/LogoMega.png" alt="Mega">
              Mega
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Kanan -->
    <div class="right-panel">
    <img src="assets/images/LogoPedoBuPerempuan.png" alt="Ilustrasi Top Up">
  </div>
</div>
</body>
</html>
