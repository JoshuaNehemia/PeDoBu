<?php
// QRGenerator.php

// Check if the invoice_id is set (this comes from the main file)
if (isset($invoice_id)) {
    // Use the invoice_id to generate the URL or whatever logic is needed
    $urlAddress = 'http://localhost/pedobu/Invoice/invoice.php?order_id=' . $invoice_id;

    // URL-encode the full URL
    $url = urlencode($urlAddress);

    // Generate the QR code using the goQR.me API
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=$url&size=200x200";

    // Display the QR code image
    echo '<img src="' . $qrUrl . '" alt="QR Code" />';
} else {
    echo "No invoice ID provided.<br>";
}
?>
