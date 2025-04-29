<?php
session_start();


require_once __DIR__ . '/library/DAO/database.php';

use App\Database\Database;
use App\Entities\Location;

// Dapatkan koneksi dari kelas Database
$conn = Database::getConnection();

$sql = "SELECT locations.id, CONCAT(locations.name, ', ', streets.name, ', ', districts.name, ', ', city.name, ', ', province.name) AS full_location 
        FROM locations 
        JOIN streets ON locations.streets_id = streets.id 
        JOIN districts ON streets.districts_id = districts.id 
        JOIN city ON districts.city_id = city.id 
        JOIN province ON city.province_id = province.id 
        ORDER BY locations.name asc";
$result = $conn->query($sql);

$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Menggunakan id sebagai value
        $options .= '<option value="' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["full_location"]) . '</option>';
    }
} else {
    $options = '<option value="">No Location Available</option>';
}
// inisiasi harga
$totalPrice = "Rp0";
$distance = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['from']) && isset($_POST['to'])) {
  $from = $_POST['from'];
  $to = $_POST['to'];
  try{
    $stmt = $conn->prepare("SELECT d.`distance` FROM distance d WHERE `from` = ? AND `destination` = ?");
    $stmt->bind_param("ii", $from, $to);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        $distance = $row["distance"];
    }
  
  // Hitung jarak dan harga
  $basePrice = 10000 + ($distance * 3000);
  // Hitung diskon jika ada
  $discount = isset($_POST['discount']) ? (int)$_POST['discount'] : 0;
  $discountAmount = $basePrice * ($discount / 100);
  $finalPrice = $basePrice - $discountAmount;
  
  $totalPrice = "Rp" . number_format($finalPrice, 0, ',', '.');
  $_SESSION['order_data'] = [
    'from' => $from,
    'to' => $to,
    'payment' => $_POST['payment'],
    'discount' => $_POST['discount'],
    'total' => $finalPrice,
    'distance' => $distance];
  }catch(Exception $e){
    error_log("Error Calculating price");
  }
}
if (isset($_POST['order'])) {
  $_SESSION['pickup'] = $_SESSION['order_data']['from']; // atau langsung string kalau belum dari DB
  $_SESSION['destination'] = $_SESSION['order_data']['to'];
  header("Location: orderdetail.php");
  exit();
}

// Jangan panggil $conn->close() di sini karena kelas Database akan menutup
// koneksi secara otomatis di destructor!
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    /* Gaya-dasar sesuai tampilan aslinya */
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'DM Sans', sans-serif; display: flex; }
    .sidebar { width: 80px; background-color: #F8F8F8; display: flex; flex-direction: column; align-items: center; justify-content: space-between; padding: 20px 0; border-right: 2px solid #4CAF50; position: fixed; height: 100vh; left: 0; top: 0; z-index: 1000; }
    .sidebar .top-section, .sidebar .middle-section, .sidebar .bottom-section { display: flex; flex-direction: column; align-items: center; }
    .sidebar button { background: none; border: none; margin: 10px 0; cursor: pointer; }
    .order-button {background-color: black;color: white;border: none;border-radius: 10px;font-size: 16px;cursor: pointer;text-align: center;text-decoration: none;}
    .sidebar img { width: 40px; height: 40px; }
    .main-container { margin-left: 80px; width: calc(100% - 80px); height: 100vh; display: flex; }
    .left-content { width: 40%; padding: 30px; }
    .left-content h1 { font-size: 36px; color: #007f3f; }
    .vehicle-tab { display: flex; gap: 20px; margin: 20px 0; }
    .vehicle-tab div { padding: 10px 20px; border-radius: 10px; cursor: pointer; }
    .vehicle-tab .active { background-color: black; color: white; }
    .input-group { border: 1px solid #ccc; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
    .input-group label { display: block; font-weight: 500; margin-top: 10px; font-size: 14px; }
    .input-group select { width: 100%; padding: 10px; margin: 5px 0 10px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; }
    .info-row { display: flex; gap: 10px; margin-bottom: 20px; }
    .info-block { flex: 1; }
    .info-block label { font-size: 14px; font-weight: 500; display: block; margin-bottom: 5px; }
    .info-block select, .info-block .output { width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 14px; }
    .info-block .output { background-color: #f4f4f4; font-weight: bold; }
    .order-button { width: 100%; padding: 15px; background-color: black; color: white; border: none; border-radius: 10px; font-size: 16px; cursor: pointer; }
    .right-map { width: 60%; height: 100vh; }
    iframe { width: 100%; height: 100%; border: none; border-radius: 12px; }
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
      <!-- Form dengan combo box untuk lokasi -->
      <form method="POST">
        <div class="input-group">
          <label for="from">From</label>
          <select id="from" name="from" required>
            <?php 
              $selectedFrom = isset($_POST['from']) ? $_POST['from'] : '';
              echo str_replace('value="' . $selectedFrom . '"', 'value="' . $selectedFrom . '" selected', $options);
            ?>
          </select>
          <label for="to">To</label>
          <select id="to" name="to" required>
          <?php 
            $selectedTo = isset($_POST['to']) ? $_POST['to'] : '';
            echo str_replace('value="' . $selectedTo . '"', 'value="' . $selectedTo . '" selected', $options);
          ?>
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
            <div class="output"><?php echo $totalPrice; ?></div>
          </div>
        </div>
        <div style="display: flex; flex-direction: column; gap: 10px;">
          <button class="order-button" type="submit" name="calculate">Check Price</button>
            <?php if (isset($_SESSION['order_data'])) : ?>
             <?php if ($_SESSION['order_data']['total'] != 10000): ?>
              <button class="order-button" type="submit" name="order">Order</button>
            <?php else: ?>
              <label>Check your price first</label>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </form>
    </div>
    <!-- Right (Map) -->
    <div class="right-map">
      <?php
      if (isset($_GET['from']) && isset($_GET['to'])) {
          $from = urlencode($_GET['from']);
          $to = urlencode($_GET['to']);
          echo '<iframe src="https://www.google.com/maps/embed/v1/directions?key=YOUR_API_KEY&origin=' 
                . $from . '&destination=' . $to . '&mode=driving" allowfullscreen></iframe>';
      } else {
          echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.391171237742!2d112.782338!3d-7.311205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid" allowfullscreen></iframe>';
      }
      ?>
    </div>
  </div>
</body>
</html>
