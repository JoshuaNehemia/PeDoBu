<?php

//if(isset($_GET['order_id']))
{

    $invoice_id = 'INV123456';
    $date_now = date('Y-m-d H:i:s');
    $passenger = 'John Doe';
    $driver_name = 'Ahmad Yusuf';
    $vin_number = 'L 1234 AB';

    $from = 'Jl. Merdeka No. 1';
    $destination = 'Jl. Sudirman No. 25';
    $distance = 12.5;
    $order_time = '2025-04-29 14:30:00';

    $charge = 50000;
    $fee = $charge * 0.1;
    $tax = ($charge + $fee) * 0.1;
    $total = $charge + $fee + $tax;

    $charge_display = number_format($charge, 0, ',', '.');
    $fee_display = number_format($fee, 0, ',', '.');
    $tax_display = number_format($tax, 0, ',', '.');
    $total_display = number_format($total, 0, ',', '.');

}
//else
{
    //header('Location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PeDoBu Invoice</title>
    <link rel="stylesheet" href="invoice.css">
</head>

<body>
    <img src='../Assets/images/LogoPedobu.png' style="width:100px; margin-left:250px;">
    <h1>PeDoBu - Personal Driver Buddy</h1>
    <p style="text-align:center;">Your Personal Driver, Anytime, Anywhere</p>

    <table>
        <tr>
            <td><strong>Invoice Number</strong></td>
            <td><?= $invoice_id ?></td>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td><?= $date_now ?></td>
        </tr>
        <tr>
            <td><strong>Passenger Name</strong></td>
            <td><?= $passenger ?></td>
        </tr>
        <tr>
            <td><strong>Driver Name</strong></td>
            <td><?= $driver_name ?></td>
        </tr>
        <tr>
            <td><strong>Vehicle Plate No.</strong></td>
            <td><?= $vin_number ?></td>
        </tr>
        <tr>
            <td><strong>Pickup Location</strong></td>
            <td><?= $from ?></td>
        </tr>
        <tr>
            <td><strong>Drop-off Location</strong></td>
            <td><?= $destination ?></td>
        </tr>
        <tr>
            <td><strong>Trip Distance</strong></td>
            <td><?= $distance ?> km</td>
        </tr>
        <tr>
            <td><strong>Ride Date/Time</strong></td>
            <td><?= $order_time ?></td>
        </tr>
    </table>


    <h3>Fare Summary</h3>
    <table>
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Charge</td>
            <td>Rp <?= $charge ?></td>
        </tr>
        <tr>
            <td>Booking Fee</td>
            <td>Rp <?= $fee ?></td>
        </tr>
        <tr>
            <td>Tax Fee</td>
            <td>Rp <?= $tax ?></td>
        </tr>
        <tr class="total-row">
            <td>Total Cost</td>
            <td>Rp <?= $total ?></td>
        </tr>
    </table>

    <p><strong>Payment Status</strong> : Paid</p>
    <hr>
    <p style="text-align:center;">Thank you for riding with PeDoBu!<br>
        For support, contact us at <a href="mailto:support@pedobu.com">support@pedobu.com</a></p>

</body>

</html>