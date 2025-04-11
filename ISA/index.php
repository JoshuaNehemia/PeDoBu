<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeDoBU - Ojek Online</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            align-items: center;
            padding: 2rem;
        }
        
        .left-section {
            flex: 1;
            text-align: center;
        }
        
        .right-section {
            flex: 1;
            text-align: center;
        }
        
        .logo-text {
            width: 80%;
            max-width: 400px;
            margin-bottom: 2rem;
        }
        
        .tagline-image {
            width: 100%;
            max-width: 500px;
            margin-bottom: 3rem;
        }
        
        .lady-image {
            width: 100%;
            max-width: 500px;
        }
        
        .button-group {
            display: flex;
            gap: 1rem;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .btn {
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-login {
            background-color: #292928;
            color: white;
        }
        
        .btn-register {
            background-color: #ffff;
            color: black;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .divider {
            width: 80%;
            max-width: 300px;
            height: 1px;
            background-color: #e0e0e0;
            margin: 2rem auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <img src="assets/images/PedobuLogoFont.png" alt="PeDoBU Logo" class="logo-text">
            
            <div class="divider"></div>
            
            <div class="button-group">
                <button class="btn btn-login" onclick="window.location.href='login.php'">Login</button>
                <button class="btn btn-register" onclick="window.location.href='register.php'">Register</button>
            </div>
        </div>
        
        <!-- Right Section -->
        <div class="right-section">
            <img src="assets/images/LadiesPedoBu.png" alt="PeDoBU Lady" class="lady-image">
        </div>
    </div>
</body>
</html>