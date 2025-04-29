<?php
// all_process.php
session_start();
require_once __DIR__ . '/Library/DAO/Database.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak valid.");
}

if (!isset($_POST['action'])) {
    die("Aksi tidak valid.");
}

$action = $_POST['action'];

switch ($action) {
    case "place_order":
        // Pastikan data lengkap dan user login
        if (!isset($_POST['from'], $_POST['to'], $_POST['payment'], $_POST['discount'], $_SESSION['user_id'])) {
            die("Data tidak lengkap untuk pemesanan.");
        }

        $user_id       = $_SESSION['user_id'];
        $from_location = intval($_POST['from']);
        $to_location   = intval($_POST['to']);
        $payment       = $_POST['payment'];
        $discount      = intval($_POST['discount']);

        // Contoh perhitungan total_price
        $basePrice = 50000; // nilai contoh harga dasar
        if ($discount > 0) {
            $total_price = $basePrice - ($basePrice * $discount / 100);
        } else {
            $total_price = $basePrice;
        }

        // Masukkan data order ke tabel `orders`
        $sql = "INSERT INTO orders (user_id, from_location_id, to_location_id, payment_method, discount, total_price, status) 
                VALUES (?, ?, ?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisid", $user_id, $from_location, $to_location, $payment, $discount, $total_price);

        if ($stmt->execute()) {
            echo "Order berhasil dibuat!";
        } else {
            echo "Gagal membuat order: " . $stmt->error;
        }

        $stmt->close();
        break;

    case "accept_order":
        // Pastikan data lengkap dan driver login
        if (!isset($_POST['order_id'], $_SESSION['driver_id'])) {
            die("Data tidak lengkap untuk menerima order.");
        }
        $order_id  = intval($_POST['order_id']);
        $driver_id = $_SESSION['driver_id'];

        $sql = "UPDATE orders SET status = 'accepted', driver_id = ? WHERE id = ? AND status = 'pending'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $driver_id, $order_id);
        if ($stmt->execute()) {
            echo "Order berhasil diterima!";
        } else {
            echo "Gagal menerima order: " . $stmt->error;
        }
        $stmt->close();
        break;

    case "reject_order":
        // Jika driver menolak order
        if (!isset($_POST['order_id'], $_SESSION['driver_id'])) {
            die("Data tidak lengkap untuk menolak order.");
        }
        $order_id  = intval($_POST['order_id']);
        // Di sini logikanya: misalnya, update status menjadi 'canceled'
        $sql = "UPDATE orders SET status = 'canceled' WHERE id = ? AND status = 'pending'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        if ($stmt->execute()) {
            echo "Order berhasil ditolak.";
        } else {
            echo "Gagal menolak order: " . $stmt->error;
        }
        $stmt->close();
        break;

    case "update_status":
        // Contoh untuk update status order (misal: in_progress, completed)
        if (!isset($_POST['order_id'], $_POST['status'])) {
            die("Data tidak lengkap.");
        }
        $order_id = intval($_POST['order_id']);
        $status   = $_POST['status'];
        // Validasi status yang diperbolehkan
        $allowed_status = ['in_progress', 'completed', 'canceled'];
        if (!in_array($status, $allowed_status)) {
            die("Status tidak valid.");
        }
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $order_id);
        if ($stmt->execute()) {
            echo "Status order berhasil diperbarui!";
        } else {
            echo "Gagal memperbarui status: " . $stmt->error;
        }
        $stmt->close();
        break;

    default:
        die("Aksi tidak dikenal.");
}

$conn->close();
?>
