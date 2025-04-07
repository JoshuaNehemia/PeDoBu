<?php
namespace App\Entities;

class userPayment extends Payment {
    public function __construct( $id,  $ordersId,  $fare,  $paidTime)
    {
        parent::__construct($id, $ordersId, $fare, $paidTime);
    }
}
?>
