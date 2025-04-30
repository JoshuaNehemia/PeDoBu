<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Driver Registration - PeDoBU</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      font-family: sans-serif;
    }
    body {
      background-color: #f4f4f4;
      overflow: hidden;
    }
    .container {
      display: flex;
      height: 100vh;
      width: 100%;
    }
    .left-panel {
      background-color: #f9f9f9;
      padding: 30px;
      border-right: 1px solid #eee;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      width: 40%;
      box-sizing: border-box;
    }
    .logo {
      text-align: center;
      margin-bottom: auto;
    }
    .logo img {
      max-width: 150px;
      height: auto;
      margin-bottom: 15px;
    }
    .logo p {
      color: #555;
      margin-bottom: 10px;
    }
    .radio-group {
      margin-bottom: 10px;
      text-align: left;
      width: 100%;
    }
    .radio-group input[type="radio"] {
      margin-right: 5px;
    }
    .radio-group label {
      margin-left: 5px;
      color: #333;
    }
    .illustration img {
      max-width: 100%;
      height: auto;
      object-fit: contain;
    }
    .right-panel {
      padding: 30px;
      width: 60%;
      box-sizing: border-box;
      overflow-y: auto;
    }
    .right-panel h1 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      font-weight: bold;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="password"] {
      width: calc(100% - 12px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 16px;
    }
    .phone-input {
      display: flex;
      align-items: center;
    }
    .phone-input input[readonly] {
      background-color: #eee;
      border-right: none;
      border-radius: 4px 0 0 4px;
      width: 60px;
      text-align: center;
    }
    .phone-input input[type="tel"] {
      border-left: none;
      border-radius: 0 4px 4px 0;
      width: calc(100% - 70px);
    }
    .continue-button {
      background-color: #28a745;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 18px;
      width: 100%;
      transition: background-color 0.3s ease;
    }
    .continue-button:hover {
      background-color: #218838;
    }
    .auth-footer {
      text-align: center;
      margin-top: 20px;
    }
    .auth-footer a {
      color: #007944;
      text-decoration: none;
      font-weight: bold;
    }
    .Logo-P {
      width: 400px;
      margin-bottom: 1.5rem;
    }
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .left-panel, .right-panel {
        width: 100%;
        padding: 20px;
        border: none;
      }
      .left-panel {
        border-bottom: 1px solid #eee;
      }
      .illustration {
        display: none;
      }
    }
  </style>
</head>
<body>
  <!-- Form untuk Registrasi Driver -->
  <form action="Driver_Process.php" method="POST">
    <div class="container">
      <div class="left-panel">
        <div class="logo">
          <img src="assets/images/LogoPeDoBu.png" alt="PeDoBU Logo">
          <p>You’ll register as a:</p>
          <div class="radio-group">
            <input type="radio" id="motorcycle_driver" name="driver_type" value="motorcycle" checked>
            <label for="motorcycle_driver">Motorcycle Driver</label>
          </div>
          <div class="radio-group">
            <input type="radio" id="car_driver" name="driver_type" value="car">
            <label for="car_driver">Car Driver</label>
          </div>
        </div>
        <div class="illustration">
          <img src="assets/images/PeDoBu-logo.png" alt="Driver Illustration" class="Logo-P">
        </div>
      </div>
      <div class="right-panel">
        <h1>SET UP YOUR PROFILE</h1>
        <?php
          if(!empty($error)){
             echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
          }
        ?>
        <div class="form-group">
          <label for="username">Username *</label>
          <input type="text" id="username" name="username" placeholder="Your username" required>
        </div>
        <div class="form-group">
          <label for="fullname">Full Name *</label>
          <input type="text" id="fullname" name="fullname" placeholder="Your full name" required>
        </div>
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" placeholder="Your email address" required>
        </div>
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" id="password" name="password" placeholder="••••••" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Phone Number *</label>
          <div class="phone-input">
            <input type="text" id="country_code" value="+62" readonly>
            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="e.g., 8123456789" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_number">ID Number *</label>
          <input type="text" id="id_number" name="id_number" placeholder="Your ID number" required>
        </div>
        <div class="form-group">
          <label for="license_number">Licence Number *</label>
          <input type="text" id="license_number" name="license_number" placeholder="Driver’s licence number" required>
        </div>
        <div class="form-group">
          <label for="plate_number">Plate Number *</label>
          <input type="text" id="plate_number" name="plate_number" placeholder="Vehicle plate number" required>
        </div>
        <button type="submit" class="continue-button">Continue</button>
        <div class="auth-footer">
          <p>Already have an account? <a href="driverLogin.php">Log in</a></p>
        </div>
      </div>
    </div>
  </form>
</body>
</html>
