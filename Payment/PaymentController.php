<?php

require_once 'PaymentModel.php';

class PaymentController
{
    private $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel;
    }

    

public function savePayments()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $payments = $_POST['payments'] ?? [];
        $inventoryId = $_POST['inventoryId'];
        $customerId = $_POST['customerId'];
        $status = 'booked';
        //-------------------------------------- Assinging customer to Inventory before saving the payment 
                require_once '../Inventory/InventoryModel.php';
                $inventoryModel = new InventoryModel();
                $result = $inventoryModel->assignCustomer($inventoryId, $customerId, $status);
                if (!($result['success'])) {
                    echo json_encode(['status' => 'error', 'message' =>$result['message']]);
                    return;
                }
        
        
        // ---------------------------------------------




        if (empty($payments)) {
            echo json_encode(['status' => 'error', 'message' => 'No payments provided.']);
            return;
        }

        if (empty($inventoryId) || empty($customerId)) {
            echo json_encode(['status' => 'error', 'message' => 'Inventory ID or Customer ID is missing.']);
            return;
        }

        try {
            //-------------- Check if payments already exist for the inventoryId

            // print_r($payments);
            // return;  
            $existingPayments = $this->paymentModel->getPaymentsByInventoryId($inventoryId);
            if (!empty($existingPayments)) {
                echo json_encode(['status' => 'error', 'message' => "Payments already exist for this inventory.$inventoryId"]);
                return;
            }

           
            //--------------------------------------------
            foreach ($payments as &$payment) {
                // Validate Installment_No
                if (empty($payment['Installment_No']) || !is_numeric($payment['Installment_No'])) {
                    $payment['Installment_No'] = 0; // Default value
                }

                // Validate and reformat Due_Date
                if (!empty($payment['Due_Date'])) {
                    // Convert from 'm/d/Y' to 'Y-m-d'
                    $date = DateTime::createFromFormat('m/d/Y', $payment['Due_Date']);
                    if (!$date) {
                        throw new Exception("Invalid date format for Due_Date: " . $payment['Due_Date']);
                    }
                    $payment['Due_Date'] = $date->format('Y-m-d'); // Save in correct format
                }

                $payment['Inventory_id'] = $inventoryId;
                $payment['customer_id'] = $customerId;
            }
            unset($payment);

            // Save new payments
            $this->paymentModel->savePayments($payments);
            echo json_encode(['status' => 'success', 'message' => 'Payments saved successfully.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}


    public function get_payment_with_customer($inventoryId){
        $payments = $this->paymentModel->getPaymentswidCustomerByInventoryId($inventoryId);
        $totals = $this->paymentModel->getSumOfPaymentsByInventoryId($inventoryId);
        $payments['totals'] = $totals;
        return $payments;
    }

    public function get_payment_with_receipt($paymentId){
        $payments = $this->paymentModel->getPaymentAlongReceipts($paymentId);

        return $payments;
    }

    public function display_for_dashboard(){
        $payments = $this->paymentModel->dashboard_index();
        return $payments;
    }
    public function displayAllPaymentsWithReceipts() {
        // Fetch payments with receipts
        $paymentsWithReceipts = $this->paymentModel->getPaymentsWithReceipts();
    
        // Return the data to be displayed in the view (could be as a JSON or passed to the frontend)
        return $paymentsWithReceipts;
    }
    

   
  

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !(isset($_GET['action']))) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS','1');
    require_once ROOT_PATH . '/../../../config.php';
    $controller = new PaymentController();
    $controller->savePayments();
}

// define('ROOT_PATH', __DIR__);
// require_once ROOT_PATH . '/../config.php';
// $controller = new PaymentController();
// $payments = $controller->get_payment_with_customer('33');

// print_r($payments);
// if (!empty($payments)) {
//     echo "Payments for Inventory ID 33:\n";
//     foreach ($payments as $payment) {
//         echo "Payment Description: " . $payment['Payment_Description'] . "\n";
//         echo "Installment No: " . $payment['Installment_No'] . "<br>";
//         echo "Due Date: " . $payment['Due_Date'] . "<br>";
//         echo "Customer Name: " . $payment['customer_name'] . "<br>";
//         echo "Customer Email: " . $payment['customer_email'] . "<br>";
//         echo "Customer Phone: " . $payment['customer_phone'] . "<br>";
//         echo "---------------------------------<br>";
//     }
// }    


