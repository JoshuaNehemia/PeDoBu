<?php
require_once 'CreateInvoice.php';

use App\Invoice\CreateInvoice;
// Buat nge test berhasil apa endaknya (Nama file gaboleh pakai titik dua jadi semua spasi pakai underscore ya)
$struk = new CreateInvoice('001_002_003',date("Y_m_d_H_i_s"),'Passengers','Drivers','P 1 BERAK','KENTUT','BERAK','50','2025-05-02 17:15:12',150000,15000,16500);
?>