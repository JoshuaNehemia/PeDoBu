<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - PeDoBU</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
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
            <p class="subtitle">Enter your registered username and password</p>
            <form action="login_process.php" method="POST">
                <div class="input-line">
                    <label>Username *</label>
                    <input type="text" name="username" placeholder="Your username" required>
                </div>
                <div class="input-line">
                    <label>Password *</label>
                    <input type="password" name="password" placeholder="••••••" required>
                </div>
                <button type="submit" class="btn-primary">Continue</button>
                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Sign up</a></p>
                    <?php
                    if (isset($_GET['err'])) {
                        if ($_GET['err'] == 1) {
                            echo '<p style="color:red;">Wrong username or password</p>';
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
