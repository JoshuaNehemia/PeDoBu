<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PeDoBU</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .register-container {
            display: flex;
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            /* Ensure container inherits */
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
            font-family: 'DM Sans', sans-serif;
            /* Explicit set */
        }

        .logo-large {
            width: 500px;
            margin-bottom: 1.5rem;
        }

        .register-header h1,
        .subtitle,
        .input-line,
        .input-line label,
        .input-line input,
        .btn-primary,
        .auth-footer,
        .auth-footer a {
            font-family: 'DM Sans', sans-serif !important;
        }

        .register-header h1 {
            font-size: 4rem;
            margin: 0 0 0.1rem;
            color: #007944;
            font-weight: 700;
            /* Use numerical weight */
        }

        .continue-btn {
            width: 100%;
            padding: 0.8rem;
            background-color: #292928;
            /* Changed to dark gray */
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
    </style>
</head>

<body>
    <div class="register-container">

        <div class="logo-section">
            <img src="assets/images/logo-pedobu.png" alt="PeDoBU Logo" class="logo-large">
        </div>

        <div class="form-section">
            <div class="register-header">
                <h1>REGISTER</h1>

                <p class="subtitle">create a new account</p>
                <!-- SEMENTARA GET BUAT DEBUG -->
                <form action="register_process.php" method="POST">
                    <div class="input-line">
                        <label>Full Name *</label>
                        <input type="text" placeholder="Your full name" name="fullName" required>
                    </div>

                    <div class="input-line">
                        <label>Username *</label>
                        <input type="text" placeholder="Your username" name="userName" required>
                    </div>

                    <div class="input-line">
                        <label>Phone Number *</label>
                        <div class="phone-input">
                            <input type="tel" placeholder="ex: 8123456789" name="phoneNumber" required>
                        </div>
                    </div>

                    <div class="input-line">
                        <label>Password *</label>
                        <input type="password" placeholder="•" name="password" required>
                    </div>

                    <button type="submit" class="continue-btn">Continue</button>
                </form>
                <div class="auth-footer">
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>
                <div class="auth-footer">
                    <?php
                    if (isset($_GET['err'])) {
                        if ($_GET['err'] == 404) {
                            echo '<p style="color:red;">Registration Failed - Unknown Reason</p>';
                        } else if ($_GET['err'] == 001) {
                            echo '<p style="color:red;">Registration Failed - Username already taken</p>';
                        }

                    }
                    ?>
                </div>
            </div>
        </div>
</body>

</html>