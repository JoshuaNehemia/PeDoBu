<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$conn = new mysqli("localhost", "root", "", "pedobu");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, fullname, phoneNumber, password FROM users 
        WHERE username != 'admin'";
$result = $conn->query($sql);

$customer_data = "";
if ($result !== false && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $customer_data .= "<tr>
                            <td>{$row['username']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['phoneNumber']}</td>
                            <td>{$row['password']}</td>
                            </tr>";
    }
} else {
    $customer_data = "<tr><td colspan='6'>No data available</td></tr>";
}
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Customer Information</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<style>
* {
    box-sizing: border-box;
}
body {
    margin: 0;
    font-family: 'DM Sans';
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
    flex-direction: column;
    padding: 30px;
}
.main-container h1 {
    font-size: 50px;
    color: #007944;
    margin-bottom: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #E6E6E6;
}
th, td {
    border: 1px solid #292928;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #292928;
    color:rgb(255, 255, 255);
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
tr:hover {
    background-color:rgb(138, 138, 138);
    color: white;
}

</style>
</head>
<body>
<div class="sidebar">
<div class="top-section">
    <img src="assets/images/LogoPedoBu.png" alt="Logo">
</div>
<div class="middle-section">
    <button onclick="location.href='admin_cust_info.php'"><img src="assets/images/profileMenyala.png" alt="Customer Log"></button>
    <button onclick="location.href='admin_driver_info.php'"><img src="assets/images/LogoMotor.png" alt="Driver Log"></button>
    <button onclick="location.href='admin_activity_log.php'"><img src="assets/images/LogoHistory.png" alt="Activity Log"></button>
    <button onclick="location.href='admin_decrypt.php'"><img src="assets/images/LogoKey.png" alt="Decrypt"></button>
</div>
<div class="bottom-section">
    <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
</div>
</div>

<div class="main-container">
<h1>Customer Information</h1>
<table>
    <thead>
    <tr>
        <th>Username</th>
        <th>Fullname</th>
        <th>Phone Number</th>
        <th>Password</th>
    </tr>
    </thead>
    <tbody>
    <?php echo $customer_data; ?>
    </tbody>
</table>
</div>
</body>
</html>
