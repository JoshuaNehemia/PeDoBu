<?php

require_once __DIR__ . '/Library/Entities/Order.php';
require_once __DIR__ . '/Library/DAO/OrderDAO.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';
require_once __DIR__ . '/Library/DAO/BalanceDAO.php';
require_once __DIR__ . '/Library/DAO/UserPaymentDAO.php';

use App\Entities\Location;
use App\Entities\User;
use App\Entities\Order;
use App\Database\OrderDAO;
use App\Database\BalanceDAO;
use App\Database\UsersPaymentDAO;

session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php?err=404");
  exit;
}

if(isset($_SESSION['order_data']))
{
    $ordersData = $_SESSION['order_data'];
    print_r($ordersData);
    $price = $ordersData['total'];
    $minPrice = 0 - $price;
    if($_SESSION['user']['balance'] >= $price)
    {
        BalanceDAO::Update_User_Balance($_SESSION['user']['username'],$minPrice);
        $userOrder = OrderDAO::Insert_New_Order(date("Y-m-d"),date("H:i:s"),$_SESSION['user']['username'],$ordersData['from'],$ordersData['to']);
        UsersPaymentDAO::Insert($userOrder->getId(),$price,date("Y-m-d H:i:S"));
        $_SESSION['user_order'] = [
            'id'              => $userOrder->getId(),
            'orderDate'       => $userOrder->getOrderDate(),
            'madeTime'        => $userOrder->getMadeTime(),
            'finishTime'      => $userOrder->getFinishTime(),
            'username'        => $userOrder->getUsersUsername(),
            'driverId'        => $userOrder->getDriversUsername(),
            'from'            => $userOrder->getDistanceFrom(),
            'destination'     => $userOrder->getDistanceDestination()
        ];
        
        header('Location: orderDetail.php');
    }
    else
    {
        echo '<h1>Insufficient Fund</h1>';
    }

}
else
{
    header('Location: order.php');
}


?>
