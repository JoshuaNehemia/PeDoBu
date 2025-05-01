<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History</title>
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
    .grafis-kanan-atas {
      position: absolute;
      top: 0;
      right: 0;
      width: 220px; /* diperkecil dari 400px */
    }
    h1 {
      font-size: 40px;
      font-weight: bold;
      color: #00703C;
    }
    .tab-buttons {
      margin: 20px 0;
    }
    .tab-buttons button {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      margin-right: 10px;
      font-weight: bold;
      cursor: pointer;
    }
    .tab-buttons .active {
      background-color: #333;
      color: #fff;
    }
    .tab-buttons .inactive {
      background-color: transparent;
      color: #333;
    }
    .history-card {
      border: 2px solid #E0E0E0;
      border-left: 5px solid #00703C;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    .left-section {
      max-width: 70%;
    }
    .history-card .driver-info {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }
    .history-card .driver-info img {
      width: 48px;
      height: 48px;
      border-radius: 50%;
    }
    .location-section {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-left: 58px;
    }
    .location-texts {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .timeline {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .timeline-dot {
      width: 12px;
      height: 12px;
      background-color: #00703C;
      border-radius: 50%;
    }
    .timeline-line {
      width: 2px;
      height: 20px;
      background-color: #00703C;
    }
    .right-section {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 10px;
    }
    .price {
      font-weight: bold;
      color: #00703C;
    }
    .right-section button {
      border: 2px solid #00703C;
      background-color: white;
      color: #00703C;
      padding: 6px 16px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 600;
    }
    .history-time {
      font-size: 12px;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo PedoBu">
    </div>
    <div class="middle-section">
      <button onclick="location.href='driver_Dashboard.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='driver_history.php'"><img src="assets/images/historyMenyala.png" alt="History"></button>
      <button onclick="location.href='driver_profile.php'"><img src="assets/images/LogoProfile.png" alt="Profile"></button>
    </div>
    <div class="bottom-section">
      <button onclick="location.href='driverLogin.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="content">
    <img class="grafis-kanan-atas" src="assets/images/GrafisKananAtas.png" alt="Grafis Kanan Atas">

    <h1>HISTORY</h1>

    <div class="tab-buttons">
      <button class="active">Motorcycle</button>
      <button class="inactive" onclick="location.href='ordercar.php'">Car</button>
    </div>

    <!-- CARD 1 -->
    <div class="history-card highlight">
      <div class="left-section">
        <div class="history-time">28 Des 11.36</div>
        <div class="driver-info">
          <img src="assets/images/drivergojek.jpg" alt="Driver Ratna">
          <div>
            <strong>Customer</strong><br>
            <span>Ratna</span><br>
          </div>
        </div>
        <div class="location-section">
          <div class="timeline">
            <div class="timeline-dot"></div>
            <div class="timeline-line"></div>
            <div class="timeline-dot"></div>
          </div>
          <div class="location-texts">
            <div>Jl. Kedinding Lor II No 5, Surabaya</div>
            <div>Warkop Indonesia, Jl. Kedung Cowek, V Surabaya</div>
          </div>
        </div>
      </div>
      <div class="right-section">
      <div class="buttons">
        <div class="price">Rp.xx.xxx</div>
        <button onclick="location.href='driver_checkorder.php'">Check Order</button>
      </div>
    </div>
</div>
    <!-- CARD 2 -->
    <div class="history-card">
      <div class="left-section">
        <div class="history-time">28 Des 11.36</div>
        <div class="driver-info">
          <img src="assets/images/driver2.png" alt="Driver">
          <div>
            <strong>CUSTOMER</strong><br>
            <span>xxxxx</span><br>
            <span style="font-size: 12px;">xx xxxx xxx</span>
          </div>
        </div>
        <div class="location-section">
          <div class="timeline">
            <div class="timeline-dot"></div>
            <div class="timeline-line"></div>
            <div class="timeline-dot"></div>
          </div>
          <div class="location-texts">
            <div>xxxxxx</div>
            <div>xxxxx</div>
          </div>
        </div>
      </div>
      <div class="right-content">
  <div class="price">Rp.xx.xxx</div>
  <div class="right-section">
  <div class="buttons">
    <button onclick="location.href='driver_checkorder.php'">Check Order</button>
  </div>
</div>
</div>
  </div>
</body>
</html>
