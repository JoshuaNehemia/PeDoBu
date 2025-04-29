<?php
function generateInvoice($invoice_id, $date_now, $driver_name, $vin_number, $from, $destination, $distance, $order_time, $charge, $fee, $tax) {
    // Calculate total cost
    $total = $charge + $fee + $tax;

    // Prepare the invoice template
    $invoice = <<<EOD
██████╗ ███████╗██████╗  █████╗ ██████╗ ██╗  ██╗
██╔══██╗██╔════╝██╔══██╗██╔══██╗██╔══██╗██║  ██║
██████╔╝█████╗  ██║  ██║██║  ██║███████║██║  ██║ 
██╔═══╝ ██╔══╝  ██║  ██║██║  ██║██╔══██║██║  ██║ 
██║     ███████╗██████╔╝ █████╔╝██████╔╝ █████╔╝   
╚═╝     ╚══════╝╚═════╝  ╚════╝ ╚═════╝  ╚════╝  

PeDoBu - Personal Driver Buddy
Your Personal Driver, Anytime, Anywhere

------------------------------------------------------------

Invoice Number    : {$invoice_id}
Date              : {$date_now}

Passenger Name    : {$invoice_id}
Driver Name       : {$driver_name}
Vehicle Plate No. : {$vin_number}

------------------------------------------------------------

Pickup Location   : {$from}
Drop-off Location : {$destination}
Trip Distance     : {$distance} km
Ride Date/Time    : {$order_time}

------------------------------------------------------------

Fare Summary

Description         | Amount
--------------------|--------------
Charge              | Rp {$charge}
Booking Fee         | Rp {$fee}
Tax Fee             | Rp {$tax}
--------------------|--------------
Total Cost          | Rp {$total}

Payment Status      : Paid
------------------------------------------------------------

Thank you for riding with PeDoBu!
For support, contact us at support@pedobu.com
EOD;
    return $invoice;
}

?>
