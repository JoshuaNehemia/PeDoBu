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
        $passenger_name,
        $driver_name,
        $vin_number,
        $from,
        $destination,
        $distance,
        $order_time,
        $charge
    ) {
        $this->invoice_id = $invoice_id;
        $this->content = $this->generateInvoice(
            $invoice_id,
            $passenger_name,
            $driver_name,
            $vin_number,
            $from,
            $destination,
            $distance,
            $order_time,
            $charge
        );

        // Sanitize parts for the file name
        $safe_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $passenger_name);

        // Append sanitized file name with .txt extension
        $fileName = "invoice_{$invoice_id}_{$order_time}_{$safe_name}_pedobu.txt";
        $this->newFilePath .= $fileName;
        $this->GetQRCodeForInvoice();
        $this->CreateNewInvoice();
    }

    function GetQRCodeForInvoice()
    {
        $invoice_id = $this->invoice_id;
        include ('QRGenerator.php');
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
                echo "<br><br>Invoice created: <br>{$filename}";
            } else {
                echo "<br><br>Unable to create file at: <br>{$filename}";
            }
        } else {
            echo "<br><br>Invoice file already exists: <br>{$filename}";
        }
    }

    private function generateInvoice(
        $invoice_id,
        $passenger_name,
        $driver_name,
        $vin_number,
        $from,
        $destination,
        $distance,
        $order_time,
        $charge
    ) {
        $total = $charge;

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
