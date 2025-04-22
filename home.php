<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
      width: 400px;
    }

    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .greeting-container {
      max-width: 60%;
    }

    .greeting-container h1 {
      margin: 0;
      font-size: 32px;
      font-family: 'DM Sans', sans-serif;
    }

    .saldo-container {
      background-color: #f6f6f6;
      padding: 20px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      gap: 25px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .saldo-container button {
      background-color: #f6f6f6;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .saldo-container button img {
      width: 48px;
      height: 52px;
    }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 40px;
      margin-bottom: 10px;
    }

    .section-header .section-title {
      font-size: 24px;
      font-weight: bold;
      margin: 0;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
    }

    .card-container {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      width: 400px;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card img {
      width: 100%;
      height: auto;
    }

    .card .description {
      padding: 15px 20px;
    }

    .dompet img {
      width: 88px;
      height: 40x;
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
    <img class="grafis-kanan-atas" src="assets/images/GrafisKananAtas.png" alt="Grafis Kanan Atas">

    <div class="header-section">
      <div class="greeting-container">
        <h1>Hi Username!</h1>
        <div class="saldo-container">
          <div>
            <div class="dompet"><img src="assets/images/pedopay.png" alt="Pedopay"><br></div>
            RpX.xxx
          </div>
          <button><img src="assets/images/LogoTopUp.png" alt="Top Up"></button>
          <button><img src="assets/images/LogoTransfer.png" alt="Transfer"></button>
        </div>
      </div>
    </div>

    <div class="section-header">
      <div class="section-title">Event</div>
    </div>
    <div class="card-container">
      <div class="card">
        <img src="assets/images/Event1.jpg" alt="Event 1">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Sambungin Akun ke Tokopedia, Banyakin Untung
        </div>
      </div>
      <div class="card">
        <img src="assets/images/Event2.jpg" alt="Event 2">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Promo Belanja Online 10.10: Cashback hingga Rp100.000
        </div>
      </div>
      <div class="card">
        <img src="assets/images/Event3.jpg" alt="Event 3">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Aktifkan & Sambungkan GoPay & GoPayLater di Tokopedia
        </div>
      </div>
    </div>

    <div class="section-header">
      <div class="section-title">Promo</div>
    </div>
    <div class="card-container">
      <div class="card">
        <img src="assets/images/Event1.jpg" alt="Promo 1">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Sambungin Akun ke Tokopedia, Banyakin Untung
        </div>
      </div>
      <div class="card">
        <img src="assets/images/Event2.jpg" alt="Promo 2">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Promo Belanja Online 10.10: Cashback hingga Rp100.000
        </div>
      </div>
      <div class="card">
        <img src="assets/images/Event3.jpg" alt="Promo 3">
        <div class="description">
          <strong>Makin Seru 🧸</strong><br>
          Aktifkan & Sambungkan GoPay & GoPayLater di Tokopedia
        </div>
      </div>
    </div>
  </div>
</body>

</html>