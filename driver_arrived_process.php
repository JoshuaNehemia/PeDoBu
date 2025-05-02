<?php
session_start();
require_once __DIR__ . '/Library/DAO/OrderDAO.php';
use App\Database\OrderDAO;
echo $_SESSION['orderdrivermaunerimajangandipakaiini'];
OrderDAO::Finish_order($_SESSION['orderdrivermaunerimajangandipakaiini']);

header("Location: driver_dashboard.php");

?>