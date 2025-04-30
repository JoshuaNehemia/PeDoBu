<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Order</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'DM Sans', sans-serif;
      display: flex;
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
      left: 0;
      top: 0;
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
    .main-content {
      margin-left: 80px;
      display: flex;
      height: 100vh;
      width: calc(100% - 80px);
    }
    .left-content {
      width: 40%;
      padding: 30px;
      background-color: #ffffff;
      overflow-y: auto;
    }
    .right-map {
      width: 60%;
      height: 100%;
    }
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
    .order-box {
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 20px;
      margin-top: 30px;
    }
    .order-box h2 {
      margin-top: 0;
    }
    .driver-card {
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }
    .driver-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .driver-info img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    .print-button {
      margin-top: 20px;
      padding: 10px 20px;
      border: 2px solid green;
      background-color: white;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      color: green;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo PedoBu">
    </div>
    <div class="middle-section">
      <button onclick="location.href='driver_Dasboard.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='history.php'"><img src="assets/images/historyMenyala.png" alt="History"></button>
      <button onclick="location.href='profile.php'"><img src="assets/images/LogoProfile.png" alt="Profile"></button>
    </div>
    <div class="bottom-section">
      <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Kiri -->
    <div class="left-content">
      <h1>ORDER</h1>
      <span>Kedinding Lor → Warkop</span> <span style="background:#eee; padding:5px 10px; border-radius:20px; font-size:12px;">Motorcycle</span>

      <div class="driver-card">
        <div class="driver-info">
          <img src="assets/images/drivergojek.jpg" alt="Driver">
          <div>
            <strong>Ratna</strong><br>
          </div>
        </div>
        <div>
          Rp xx.xxx <br>
          <img src="assets/images/pedopay.png" alt="Pedopay" style="height:20px;">
        </div>
      </div>
      <h1>Your order</h1>
      <div class="order-box">
        <p><strong>🧭 Pickup:</strong><br>Jl. Kedinding Lor II No 5, Surabaya</p>
        <hr>
        <p><strong>📍 Destination:</strong><br>Warkop Indonesia, Jl. Kedung Cowek V, Surabaya</p>
        <button class="print-button">Print Order</button>
      </div>
    </div>

    <!-- Kanan -->
    <div class="right-map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d3957.407030538748!2d112.77860507582144!3d-7.309835672206315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!3m2!1d-7.311205!2d112.782338!4m5!1s0x2dd7fbca0799535f%3A0xf07a45a3065976f1!2sWarkop%20Indonesia%2C%20Jl.%20Kedung%20Cowek%20V%2C%20Surabaya!3m2!1d-7.308363!2d112.784958!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</body>
</html>
