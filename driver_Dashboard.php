<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <link rel="stylesheet" href="css/stylehome.css">
    <style>
        body {
    font-family: sans-serif;
    margin: 0;
    background-color: #f4f4f4;
    display: flex; /* Untuk tata letak sidebar dan konten */
    min-height: 100vh;
}

.app-container {
    display: flex;
    width: 100%;
    min-height: 100vh;
}

.tengahPlis {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px; /* Jarak antar ikon di tengah */
    margin-top: 200px;

}
.sidebar {
    background-color: #f8f9fa; /* Latar belakang sidebar terang */
    width: 60px; /* Lebar sidebar yang lebih kecil */
    padding: 20px 10px; /* Padding vertikal dan horizontal */
    display: flex;
    flex-direction: column;
    align-items: center; /* Membuat ikon di tengah horizontal */
    justify-content: space-between; /* Distribusi ruang antara item */
    gap: 20px; /* Jarak antar ikon (akan terpengaruh oleh justify-content) */
}

.sidebar-icon {
    width: 30px; /* Ukuran ikon */
    height: 30px;
    cursor: pointer; /* Memberikan efek hover seperti tombol */
    color: #28a745; /* Warna ikon hijau (sesuaikan) */
    /* Anda mungkin perlu menyesuaikan fill atau stroke tergantung format ikon */
}

.logout-icon {
    margin-top: auto; 
}

.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center; 
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15px 0;
    cursor: pointer;
    text-decoration: none;
    color: white;
    margin-bottom: 20px; 
}

/* Menghilangkan margin bottom pada item terakhir */
.nav-item:last-child {
    margin-bottom: 0;
}

.nav-item.active {
    background-color: #495057; /* Warna latar belakang item aktif */
}

.nav-icon {
    width: 24px;
    height: 24px;
    margin-bottom: 5px;
}

.nav-item span {
    font-size: 0.8em;
    text-align: center;
}

.content {
    flex-grow: 1; /* Membuat konten utama mengisi sisa ruang */
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.order-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    width: 100%;
    max-width: 400px; /* Lebar maksimum konten utama */
}

.order-header h1 {
    margin: 0;
    color: #28a745;
    margin-right: 30px;
}
.gambarJam{
    width: 100px;
    height: 45px;
}

.timer { 
    background: none;
    border: none;
    margin: 10px 0;
    cursor: pointer;
    width: 24px;
    height: 24px;
}

.circular-chart {
    width: 30px;
    height: 30px;
    margin-right: 5px;
}

.path {
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke: #ffc107;
    animation: dash 10s linear forwards;
}

@keyframes dash {
    from {
        stroke-dashoffset: 100;
    }
    to {
        stroke-dashoffset: 0;
    }
}

.timer span {
    font-weight: bold;
}

.location-info {
    margin-bottom: 20px;
    width: 100%;
    max-width: 400px;
}

.location-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.location-icon {
    width: 24px;
    height: 24px;
    margin-right: 10px;
    content: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"%3E%3Cpath d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/%3E%3Ccircle cx="12" cy="9" r="3"/%3E%3C/svg%3E');
}

.location-item p {
    margin: 0;
}

.payment-info {
    display: flex;
    flex-direction: column; /* Mengatur label dan input menjadi kolom */
    gap: 15px;
    margin-bottom: 20px;
    width: 100%;
    max-width: 400px;
}

.payment-item, .fee-item {
    display: flex; /* Mengatur label dan input menjadi baris */
    flex-direction: column;
}

.payment-item label, .fee-item label {
    display: block;
    margin-bottom: 5px;
    color: #6c757d;
    font-size: 0.9em;
}

.payment-item input, .fee-item input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1em;
    background-color: #f8f9fa;
}

.cancel-button, .accept-button {
    flex: 1;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
}

.cancel-button {
    background-color: #dc3545;
    color: white;
}

.accept-button {
    background-color: #28a745;
    color: white;
}

.Peta
{
    height: 500px;
    width: 100%;
}

/* Gaya inline sementara untuk peta, nanti dipindahkan ke style.css */
#map-container {
    width: 60%;
    height: 100vh;
}

.map-info {
    margin-bottom: 20px;
}

.map-location-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.map-location-icon {
    width: 24px;
    height: 24px;
    margin-right: 10px;
    content: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"%3E%3Cpath d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/%3E%3Ccircle cx="12" cy="9" r="3"/%3E%3C/svg%3E');
}

.map-buttons {
    display: flex;
    gap: 10px;
    justify-content: flex-end; /* Tombol di kanan bawah peta */
}
iframe {
      width: 100%;
      height: 100%;
      border: none;
      border-radius: 12px;
    }
</style>
</head>
<body>
    <nav class="sidebar">
        <img src="assets/images/LogoPedoBu.png" alt="Car" class="sidebar-icon">
        <div class="tengahPlis">
        <img src="assets/images/LogoMotor.png" alt="Motorcycle" class="sidebar-icon">
        <img src="assets/images/LogoHistory.png" alt="Box" class="sidebar-icon">
        <img src="assets/images/LogoProfile.png" alt="Person" class="sidebar-icon">
        </div>
        <img src="assets/images/LogoLogOut.png" alt="Logout" class="sidebar-icon logout-icon">
    </nav>
        <main class="content">
            <div class="order-header">
                <h1>ORDER</h1>
                <div class="timer">
                 <img src="Assets/images/button.png" alt="timer" class="gambarJam">
                </div>
            </div>
        <div class = "Information-wrap">
            <div class="location-info">
                <div class="location-item">
                    <img src="placeholder-icon.png" alt="Lokasi Awal" class="location-icon">
                    <p>lokasi awal</p>
                </div>
                <div class="location-item">
                    <img src="placeholder-icon.png" alt="Lokasi Tujuan" class="location-icon">
                    <p>lokasi berangkat</p>
                </div>
            </div>

            <div class="payment-info">
                <div class="payment-item">
                    <label for ="payment">Payment</label>
                    <input id="payment" value="Pedopay" readonly>
                </div>
                <div class="fee-item">
                    <label for="fee">Fee</label>
                    <input type="text" id="fee" value="Rp.xxx.xxx" readonly>
                </div>
            </div>
            <div class="map-buttons">
                <button class="cancel-button">Cancel</button>
                <button class="accept-button">Accept</button>
            </div>
        </div>
        </main>
        <div id="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.391171237742!2d112.782338!3d-7.311205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid" allowfullscreen>
        </iframe>
        </div>
        </div>
    </div>
</body>
</html>