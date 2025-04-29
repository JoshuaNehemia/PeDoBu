<?php
namespace App\Invoice;

class CreateInvoice
{
    private $newFilePath;
    private $content;

    public function __construct($invoice_id, $date_now, $passenger_name, $driver_name, $vin_number, $from, $destination, $distance, $order_time, $charge, $fee, $tax)
    {
        $this->content = $this->generateInvoice($invoice_id, $date_now, $passenger_name, $driver_name, $vin_number, $from, $destination, $distance, $order_time, $charge, $fee, $tax);
        $this->newFilePath = 'invoice' . $invoice_id . '_' . $date_now . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $passenger_name) . '_pedobu'; 
        $this->CreateNewInvoice();
    }

    function CreateNewInvoice()
    {

        $filename = $this->newFilePath;

        // Check if the file already exists
        if (!file_exists($filename)) {
            // Create the file
            $file = fopen($filename, "w");

            if ($file) {
                // Write content to the file
                fwrite($file, $this->content);

                // Close the file
                fclose($file);
                echo "File created and content written successfully.";
            } else {
                echo "Unable to create the file.";
            }
        } else {
            echo "The file already exists.";
        }

    }

    function generateInvoice($invoice_id, $date_now, $passenger_name, $driver_name, $vin_number, $from, $destination, $distance, $order_time, $charge, $fee, $tax)
    {
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