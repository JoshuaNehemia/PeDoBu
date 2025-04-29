<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Driver Login - PeDoBU</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
.login-container {
    display: flex;
    min-height: 100vh;
    font-family: 'DM Sans', sans-serif;
}
.logo-section {
    flex: 30%;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
}
.form-section {
    flex: 70%;
    padding: 4rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.logo-large {
    width: 500px;
    margin-bottom: 1.5rem;
}
.login-header h1 {
    font-size: 4rem;
    margin-bottom: 0.1rem;
    color: #007944;
    font-weight: 700;
}
.input-line {
    margin-bottom: 15px;
}
.input-line label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
.input-line input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-primary {
    background-color: #292928;
    color: white;
    padding: 0.8rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.2s;
}
.btn-primary:hover {
    background-color: #333;
}
.auth-footer {
    margin-top: 20px;
    text-align: center;
}
.auth-footer a {
    color: #007944;
    text-decoration: none;
}
</style>
</head>
<body>
<div class="login-container">
<div class="logo-section">
    <img src="assets/images/logo-pedobu.png" alt="PeDoBU Logo" class="logo-large">
</div>
<div class="form-section">
    <div class="login-header">
    <h1>LOGIN</h1>
    <p class="subtitle">Enter your registered full name and password</p>
    <form action="driver_login_process.php" method="POST">
        <div class="input-line">
        <label>Full Name *</label>
        <input type="text" name="username" placeholder="Your username" required>
        </div>
        <div class="input-line">
        <label>Password *</label>
        <input type="password" name="password" placeholder="••••••" required>
        </div>
        <button type="submit" class="btn-primary">Continue</button>
        <div class="auth-footer">
        <p>Don't have an account? <a href="driverRegis.php">Sign up</a></p>
        <?php
            if (isset($_GET['err'])) {
            if ($_GET['err'] == 1) {
                echo '<p style="color:red;">Wrong full name or password</p>';
            } else if ($_GET['err'] == 404) {
                echo '<p style="color:red;">Error Unknown</p>';
            }
            }
        ?>
        </div>
    </form>
    </div>
</div>
</div>
</body>
</html>
