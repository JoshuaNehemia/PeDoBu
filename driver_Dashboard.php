<?php
// Buka koneksi dan ambil data lokasi dari database
$conn = new mysqli("localhost", "root", "", "pedobu");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT locations.id, CONCAT(locations.name, ', ', streets.name, ', ', districts.name, ', ', city.name, ', ', province.name) AS full_location 
        FROM locations 
        JOIN streets ON locations.streets_id = streets.id 
        JOIN districts ON streets.districts_id = districts.id 
        JOIN city ON districts.city_id = city.id 
        JOIN province ON city.province_id = province.id 
        ORDER BY province.name, city.name, districts.name, streets.name, locations.name";
$result = $conn->query($sql);

$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Menggunakan id sebagai value dan full location sebagai tampilan
        $options .= '<option value="' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["full_location"]) . '</option>';
    }
} else {
    $options = '<option value="">No Location Available</option>';
}
$conn->close();
?>
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
    .input-group input,
    .input-group select {
      width: 100%;
      padding: 10px;
      margin: 5px 0 10px;
      border: none;
      border-bottom: 1px solid #ccc;
      font-size: 16px;
    }
    .input-group select {
      border: 1px solid #ccc;
      border-radius: 8px;
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
    <div class="bottom-section">
      <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-container">
    <!-- Left (Form) -->
    <div class="left-content">
      <h1>ORDER</h1>
      <!-- Tab -->
      <div class="vehicle-tab">
        <div class="active">Motorcycle</div>
        <div>Car</div>
      </div>
      <!-- Form Order -->
      <form action="all_process.php" method="POST">
        <!-- Field hidden untuk menentukan aksi proses -->
        <input type="hidden" name="action" value="place_order">
        <div class="input-group">
          <label for="from">From</label>
          <select id="from" name="from" required>
            <?php echo $options; ?>
          </select>
          <label for="to">To</label>
          <select id="to" name="to" required>
            <?php echo $options; ?>
          </select>
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

    <!-- Right (Map) -->
    <div class="right-map">
      <?php
      // Untuk saat ini kita menampilkan peta default.
      // Jika diinginkan, gunakan JavaScript untuk mengubah src iframe
      // berdasarkan pilihan "from" dan "to" secara dinamis.
      echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.391171237742!2d112.782338!3d-7.311205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid" allowfullscreen></iframe>';
      ?>
    </div>
  </div>
</body>
</html>
