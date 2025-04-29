<?php
namespace App\Invoice;

class CreateInvoice
{
    private $newFilePath = 'Docs/';
    private $content;

    //for QR Generator
    private $invoice_id;

    public function __construct(
        $invoice_id,
        $date_now,
        $passenger_name,
        $driver_name,
        $vin_number,
        $from,
        $destination,
        $distance,
        $order_time,
        $charge,
        $fee,
        $tax
    ) {
        $this->invoice_id = $invoice_id;
        include ('QRGenerator.php');
        $this->content = $this->generateInvoice(
            $invoice_id,
            $date_now,
            $passenger_name,
            $driver_name,
            $vin_number,
            $from,
            $destination,
            $distance,
            $order_time,
            $charge,
            $fee,
            $tax
        );

        // Sanitize parts for the file name
        $safe_date = preg_replace('/[^a-zA-Z0-9_-]/', '_', $date_now);
        $safe_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $passenger_name);

        // Append sanitized file name with .txt extension
        $fileName = "invoice_{$invoice_id}_{$safe_date}_{$safe_name}_pedobu.txt";
        $this->newFilePath .= $fileName;

        $this->CreateNewInvoice();
    }

    private function CreateNewInvoice()
    {
        $filename = $this->newFilePath;

        // Ensure the directory exists
        $directory = dirname($filename);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // Only create if the file doesn't already exist
        if (!file_exists($filename)) {
            $file = fopen($filename, "w");

            if ($file) {
                fwrite($file, $this->content);
                fclose($file);
                echo "<br>Invoice created: {$filename}";
            } else {
                echo "<br>Unable to create file at: {$filename}";
            }
        } else {
            echo "<br>Invoice file already exists: {$filename}";
        }
    }

    private function generateInvoice(
        $invoice_id,
        $date_now,
        $passenger_name,
        $driver_name,
        $vin_number,
        $from,
        $destination,
        $distance,
        $order_time,
        $charge,
        $fee,
        $tax
    ) {
        $total = $charge + $fee + $tax;

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

Passenger Name    : {$passenger_name}
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
}
?>
