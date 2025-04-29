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

$sql = "SELECT id, orderDate, madeTime, finishTime, users_username, distance_from, distance_destination, drivers_id, status FROM orders";
$result = $conn->query($sql);

$activity = "";
if ($result !== false && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $activity .= "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['orderDate']}</td>
                            <td>{$row['madeTime']}</td>
                            <td>{$row['finishTime']}</td>
                            <td>{$row['users_username']}</td>
                            <td>{$row['distance_from']}</td>
                            <td>{$row['distance_destination']}</td>
                            <td>{$row['drivers_id']}</td>
                            <td>{$row['status']}</td>
                            </tr>";
    }
} else {
    $activity = "<tr><td colspan='9'>No data available</td></tr>";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Activity Log</title>
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
    <button onclick="location.href='admin_cust_info.php'"><img src="assets/images/LogoProfile.png" alt="Customer Log"></button>
    <button onclick="location.href='admin_driver_info.php'"><img src="assets/images/LogoMotor.png" alt="Driver Log"></button>
    <button onclick="location.href='admin_activity_log.php'"><img src="assets/images/historyMenyala.png" alt="Activity Logy"></button>
    <button onclick="location.href='admin_decrypt.php'"><img src="assets/images/LogoKey.png" alt="Decrypt"></button>
</div>
<div class="bottom-section">
    <button onclick="location.href='logout.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
</div>
</div>

<div class="main-container">
<h1>Activity Log</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Order Date</th>
        <th>Made Time</th>
        <th>Finish Time</th>
        <th>Customer's Username</th>
        <th>Distance From</th>
        <th>Distance Destination</th>
        <th>Driver's ID</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php echo $activity; ?>
    </tbody>
</table>
</div>
</body>
</html>
