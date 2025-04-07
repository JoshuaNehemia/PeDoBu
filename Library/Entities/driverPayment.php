<?php
namespace App\Entities;

class driverPayment extends Payment {
    public function __construct( $id,  $ordersId,  $fare,  $paidTime)
    {
        parent::__construct($id, $ordersId, $fare, $paidTime);
    }
}
?>