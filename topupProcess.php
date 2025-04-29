<?php
session_start();
if (isset($_GET['method'])) {
  $method = $_GET['method'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top Up BCA</title>
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

    .main-panel {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-top: 200px;
      padding-right: 70px;
    }

    .left-panel {
      background-color: #f2f2f2;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      width: 600px;
    }

    .left-panel img {
      height: 35px;
      vertical-align: middle;
      margin-right: 10px;
    }

    .va-section {
      margin-top: 20px;
      font-size: 24px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .va-box {
      margin-top: 10px;
      font-size: 22px;
      font-weight: bold;
    }

    .copy-button {
      padding: 10px 20px;
      border: 2px solid #00723F;
      background-color: white;
      border-radius: 10px;
      color: #00723F;
      font-weight: bold;
      cursor: pointer;
    }

    .info-text {
      margin-top: 25px;
      font-size: 16px;
      color: #333;
    }

    .steps {
      margin-top: 15px;
    }

    .steps div {
      margin: 10px 0;
    }

    .right-panel {
      display: flex;
      align-items: center;
      justify-content: right;
      margin-top: -115px;
      margin-left: 50px;
    }

    .right-panel img {
      width: 500px;
      padding-top: 1px;
      padding-bottom: 100px;
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

    .method {
      background-color: #fff;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 30px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    input {
      width: 400px;
      border-color: #00723F;
      border-width: 0.1em;
      border-radius: 15px;
      height: 2em;
      font-size: 1.5em;
      box-shadow: none;
      padding: 0.1em;
    }

    .submission {
      color: white;
      background-color: #00723F;
      width: 100px;
      margin-left: 10px;
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
    <div class="title-area">
      <div class="title">Top Up <?php echo $method; ?></div>
    </div>
    <div class="main-panel">
      <div class="left-panel">
        <div class="method">
          <img src="assets/images/logo<?php echo $method; ?>.png" alt="Logo <?php echo $method; ?>"
            style="width:100px;height:100px;">
        </div>
        <div class="va-section">
          Insert the amount of money you want to add to your balance!
        </div>
        <br>
        <form action="topUpConfirmation.php" method="post">
          <input type="text" name="amount">
          <input class="submission" type="submit">
        </form>
        <?php
        if (isset($_GET['err'])) {
          if ($_GET['err'] == 1) {
            echo "        <div class='va-section' style='color:red;'>
          Amount can't be below then zero!
        </div>";
          }
        }
        ?>
      </div>
      <div class="right-panel">
        <img src="assets/images/LogoPedoBuPerempuan.png" alt="Ilustrasi Top Up">
      </div>
    </div>
  </div>
</body>

</html>