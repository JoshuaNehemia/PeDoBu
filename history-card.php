<?php

require_once __DIR__ . '/Library/DAO/LocationsDAO.php';
require_once __DIR__ . '/Library/DAO/DistanceDAO.php';
require_once __DIR__ . '/Library/DAO/OrderDAO.php';
require_once __DIR__ . '/Library/DAO/DriverDAO.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';
require_once __DIR__ . '/Library/DAO/UserPaymentDAO.php';
require_once __DIR__ . '/Library/Entities/drivers.php';
require_once __DIR__ . '/Library/Entities/user.php';

use App\Database\UsersPaymentDAO;
use App\Database\DriverDAO;
use App\Database\UserDAO;
use App\Database\OrderDAO;
use App\Database\LocationsDAO;
use App\Database\DistanceDAO;
use App\Entities\drivers;
use App\Entities\Order;
use App\Entities\User;

if (isset($id)) {
    $orderA = OrderDAO::Select_Order_By_Id($id);
    $driverA = DriverDAO::Select_Driver_By_Id($orderA->getDriversUsername());
    $userA = UserDAO::getUserByUsername($orderA->getUsersUsername());
    $fromA = LocationsDAO::Get_Location_By_Id($orderA->getDistanceFrom());
    $destinationA = LocationsDAO::Get_Location_By_Id($orderA->getDistanceDestination());
    $distanceA = DistanceDAO::Get_Distance_By_Id($fromA->getId(), $destinationA->getId());
    $usersPay = UsersPaymentDAO::Select_By_Orders_Id($orderA->getId()); 

    $driver_name = $driverA->getFullName();
    $vin_number = $driverA->getPlateNumber();
    $from = $fromA->__toString();
    $destination = $destinationA->__toString();

    $order_id = $orderA->getId();

    // Combine and format order time
    $order_time_raw = $orderA->getOrderDate() . ' ' . $orderA->getMadeTime();
    $date = new DateTime($order_time_raw);
    $date_display = $date->format("d F Y H:i"); 

    $charge = $usersPay['price'] ?? 0;
    $charge_display = number_format($charge, 0, ',', '.');
    $price = $charge_display;
}

echo <<<HTML
<div class="history-card highlight">
  <div class="left-section">
    <div class="history-time">{$date_display}</div>
    <div class="driver-info">
      <img src="assets/images/drivergojek.jpg" alt="{$driver_name}">
      <div>
        <strong>DRIVER</strong><br>
        <span>{$driver_name}</span><br>
        <span style="font-size: 12px;">{$vin_number}</span>
      </div>
    </div>
    <div class="location-section">
      <div class="timeline">
        <div class="timeline-dot"></div>
        <div class="timeline-line"></div>
        <div class="timeline-dot"></div>
      </div>
      <div class="location-texts">
        <div>{$from}</div>
        <div>{$destination}</div>
      </div>
    </div>
  </div>
  <div class="right-section">
    <div class="buttons">
      <div class="price">Rp. {$price}</div>
      <button onclick="location.href='order.php?id={$order_id}'">Order again</button>
      <button onclick="location.href='checkorder.php?id={$order_id}'">Check Order</button>
    </div>
  </div>
</div>
HTML;
?>
