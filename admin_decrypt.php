<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Decrypt Message</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
        }
        body {
            margin: 0;
            display: flex;
            background-color: white;
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
            padding: 0;
        }
        .sidebar img {
            width: 40px;
            height: 40px;
        }
        .main-container {
            margin-left: 80px;
            width: calc(100% - 80px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px;
        }
        .main-container h1 {
            font-size: 50px;
            color: #007944;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .content-wrapper {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }
        .image-container {
            flex: 1;
            max-width: 400px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .decrypt-container {
            flex: 1;
            max-width: 600px;
        }
        .image-container p {
            color: #333;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.5;
        }
        .decrypt-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #292928;
            font-size: 16px;
        }
        .form-group label span {
            color: #ff0000;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .btn-decrypt {
            background-color: #007944;
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-decrypt:hover {
            background-color: #006633;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="top-section">
            <img src="assets/images/LogoPedoBu.png" alt="Logo">
        </div>
        <div class="middle-section">
            <button onclick="location.href='admin_cust_info.php'">
                <img src="assets/images/LogoProfile.png" alt="Customer Log">
            </button>
            <button onclick="location.href='admin_driver_info.php'">
                <img src="assets/images/LogoMotor.png" alt="Driver Log">
            </button>
            <button onclick="location.href='admin_activity_log.php'">
                <img src="assets/images/LogoHistory.png" alt="Activity Log">
            </button>
            <button onclick="location.href='admin_decrypt.php'">
                <img src="assets/images/LogoKeyBold.png" alt="Decrypt">
            </button>
        </div>
        <div class="bottom-section">
            <button onclick="location.href='logout.php'">
                <img src="assets/images/LogoLogOut.png" alt="Logout">
            </button>
        </div>
    </div>

    <div class="main-container">
        <h1>Decrypt Ciphertext</h1>
        <div class="content-wrapper">
            <div class="image-container">
                <p>Paste encrypted message &amp; key below to decode:</p>
                <img src="assets/images/decrypt1.png" alt="Decryption Illustration">
            </div>
            <div class="decrypt-container">
                <form class="decrypt-form" method="POST" action="admin_decrypt_process.php">
                    <div class="form-group">
                        <label for="ciphertext">Ciphertext <span>*</span></label>
                        <!-- Pastikan name attribute ada agar data dapat dikirim via POST -->
                        <textarea id="ciphertext" name="ciphertext" class="form-control" rows="4" placeholder="Enter encrypted message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="key">Key <span>*</span></label>
                        <input type="text" id="key" name="key" class="form-control" placeholder="Enter decryption key">
                    </div>
                    <button type="submit" class="btn-decrypt">Decrypt</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>