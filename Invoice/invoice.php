<?php
require_once 'CreateInvoice.php';

require_once __DIR__ . '/../Library/DAO/LocationsDAO.php';
require_once __DIR__ . '/../Library/DAO/DistanceDAO.php';
require_once __DIR__ . '/../Library/DAO/OrderDAO.php';
require_once __DIR__ . '/../Library/DAO/DriverDAO.php';
require_once __DIR__ . '/../Library/DAO/UserDAO.php';
require_once __DIR__ . '/../Library/DAO/UserPaymentDAO.php';
require_once __DIR__ . '/../Library/Entities/drivers.php';
require_once __DIR__ . '/../Library/Entities/user.php';

use App\Database\UsersPaymentDAO;
use App\Invoice\CreateInvoice;
use App\Database\DriverDAO;
use App\Database\UserDAO;
use App\Database\OrderDAO;
use App\Database\LocationsDAO;
use App\Database\DistanceDAO;
use App\Entities\drivers;
use App\Entities\Order;
use App\Entities\User;

if (isset($_GET['order_id'])) {
    $orderA = OrderDAO::Select_Order_By_Id($_GET['order_id']);
    $driverA = DriverDAO::Select_Driver_By_Id($orderA->getDriversUsername());
    $userA = UserDAO::getUserByUsername($orderA->getUsersUsername());
    $fromA = LocationsDAO::Get_Location_By_Id($orderA->getDistanceFrom());
    $destinationA = LocationsDAO::Get_Location_By_Id($orderA->getDistanceDestination());
    $distanceA = DistanceDAO::Get_Distance_By_Id($fromA->getId(), $destinationA->getId());
    $usersPay = UsersPaymentDAO::Select_By_Orders_Id($orderA->getId());

    $invoice_id = $orderA->getId();
    $passenger = $userA->getFullName();
    $driver_name = $driverA->getFullName();
    $vin_number = $driverA->getPlateNumber();

    $from = $fromA->__toString();
    $destination = $destinationA->__toString();
    $distance = $distanceA;
    $order_time = $orderA->getOrderDate() . '' . $orderA->getMadeTime();
    $date = new DateTime($order_time);
    $order_time = $date->format("Y_m_d_H_i_s");

    $charge = $usersPay['price'];
    $total = $charge;
    $charge_display = number_format($charge, 0, ',', '.');
    $total_display = number_format($charge, 0, ',', '.');

} else {
    header('Location: home.php');
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
        <tr class="total-row">
            <td>Total Cost</td>
            <td>Rp <?= $total ?></td>
        </tr>
    </table>

    <p><strong>Payment Status</strong> : Paid</p>
    <hr>
    <p style="text-align:center;">Thank you for riding with PeDoBu!<br>
        For support, contact us at <a href="mailto:support@pedobu.com">support@pedobu.com</a>
        <br><br>
        <?php
        $struk = new CreateInvoice($invoice_id, $passenger, $driverA->getFullName(), $vin_number, from: $from, destination: $destination, distance: $distance, order_time: $order_time, charge: $charge);
        ?>
    </p>

</body>

</html>