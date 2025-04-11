<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order</title>
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
    .main-container {
      margin-left: 80px;
      width: calc(100% - 80px);
      height: 100vh;
      display: flex;
    }
    .left-content {
      width: 40%;
      padding: 30px;
    }
    .left-content h1 {
      font-size: 36px;
      color: #007f3f;
    }
    .vehicle-tab {
      display: flex;
      gap: 20px;
      margin: 20px 0;
    }
    .vehicle-tab div {
      padding: 10px 20px;
      border-radius: 10px;
      cursor: pointer;
    }
    .vehicle-tab .active {
      background-color: black;
      color: white;
    }
    .input-group {
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .input-group label {
      display: block;
      font-weight: 500;
      margin-top: 10px;
      font-size: 14px;
    }
    .input-group input {
      width: 100%;
      padding: 10px;
      margin: 5px 0 10px;
      border: none;
      border-bottom: 1px solid #ccc;
      font-size: 16px;
    }
    .info-row {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    .info-block {
      flex: 1;
    }
    .info-block label {
      font-size: 14px;
      font-weight: 500;
      display: block;
      margin-bottom: 5px;
    }
    .info-block select,
    .info-block .output {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .info-block .output {
      background-color: #f4f4f4;
      font-weight: bold;
    }
    .order-button {
      width: 100%;
      padding: 15px;
      background-color: black;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
    }
    .right-map {
      width: 60%;
      height: 100vh;
    }
    iframe {
      width: 100%;
      height: 100%;
      border: none;
      border-radius: 12px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo">
    </div>
    <div class="middle-section">
      <button onclick="location.href='home.php'"><img src="assets/images/homeRedup.png" alt="Home"></button>
      <button onclick="location.href='order.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='history.php'"><img src="assets/images/LogoHistory.png" alt="History"></button>
      <button onclick="location.href='profile.php'"><img src="assets/images/LogoProfile.png" alt="Profile"></button>
    </div>
    <div class ="bottom-section">
      <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-container">
    <!-- Kiri -->
    <div class="left-content">
      <h1>ORDER</h1>

      <!-- Tab -->
      <div class="vehicle-tab">
        <div class="active">Motorcycle</div>
        <div>Car</div>
      </div>

      <!-- Form -->
      <form method="GET">
        <div class="input-group">
          <label for="from">From</label>
          <input type="text" id="from" name="from" placeholder="Enter pickup location" required>
          <label for="to">To</label>
          <input type="text" id="to" name="to" placeholder="Enter destination" required>
        </div>

        <div class="info-row">
          <div class="info-block">
            <label for="payment">Payment</label>
            <select name="payment" id="payment">
              <option value="pedopay">Pedopay</option>
              <option value="cash">Cash</option>
            </select>
          </div>

          <div class="info-block">
            <label for="discount">Discount</label>
            <select name="discount" id="discount">
              <option value="0">No Discount</option>
              <option value="15">Diskon 15% for Motorcycle</option>
            </select>
          </div>

          <div class="info-block">
            <label>Total</label>
            <div class="output">Rpxx.xxx</div>
          </div>
        </div>

        <button class="order-button" type="submit">Order Now</button>
      </form>
    </div>

    <!-- Kanan (Map) -->
    <div class="right-map">
      <?php
        if (isset($_GET['from']) && isset($_GET['to'])) {
          $from = urlencode($_GET['from']);
          $to = urlencode($_GET['to']);
          echo '<iframe src="https://www.google.com/maps/embed/v1/directions?key=YOUR_API_KEY&origin=' . $from . '&destination=' . $to . '&mode=driving" allowfullscreen></iframe>';
        } else {
          echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.391171237742!2d112.782338!3d-7.311205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid" allowfullscreen></iframe>';
        }
      ?>
    </div>
  </div>
</body>
</html>
