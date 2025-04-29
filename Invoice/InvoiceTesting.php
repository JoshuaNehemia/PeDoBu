<?php
require_once 'CreateInvoice.php';

use App\Invoice\CreateInvoice;
// Buat nge test berhasil apa endaknya (Nama file gaboleh pakai titik dua jadi semua spasi pakai underscore ya)
$struk = new CreateInvoice(invoice_id: '001_002_003',passenger_name: 'Passengers',driver_name: 'Drivers',vin_number: 'P 1 BERAK',from: 'KENTUT',destination: 'BERAK',distance: 50,order_time: '2025-05-02 17:15:12',charge: 150000);
?>