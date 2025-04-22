<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location - PeDoBU</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* STYLE PERSIS SEPERTI LOGIN (TIDAK DIUBAH) */
        .split-container {
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

        /* --- */

        /* HANYA TAMBAHKAN STYLE UNTUK LOCATION OPTIONS */
        .location-option {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .location-option:hover {
            background-color: #f9f9f9;
        }

        .location-input {
            height: 200px;
            overflow-y: auto;
            padding: 0 2rem;
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <!-- STRUKTUR PERSIS SEPERTI LOGIN -->
    <div class="split-container">
        <!-- LOGO SECTION (SAMA PERSIS) -->
        <div class="logo-section">
            <img src="assets/images/logo-pedobu.png" alt="PeDoBU Logo" class="logo-large">
        </div>

        <!-- FORM SECTION (HANYA GANTI KONTEN) kita ga ada location gaperlu disave paling Pin aja -->
        <div class="form-section">
            <h1 style="font-size: 4rem; color: #007944; margin-bottom: 0.5rem;">LOCATION</h1>
            <p style="color: #666; margin-bottom: 2rem;">Pick your current location</p>

            <form action="register_process.php" method="POST">
                <input type="password" name="pin" placeholder="•">
                <button type="submit" class="btn-primary">Continue</button>
            </form>
        </div>
    </div>
</body>

</html>