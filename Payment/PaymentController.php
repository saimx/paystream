<?php


require_once 'PaymentModel.php';

class PaymentController
{
    private $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel;
    }


    public function storeInvoice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve common invoice header data
            $customer_id  = $_POST['customer_id'];
            $due_date     = $_POST['due_date'];
            $discount_amt = isset($_POST['discount_amt']) ? $_POST['discount_amt'] : 0.00;
            $issue_by     = $_POST['issue_by'];
            $reqested_by  = $_POST['reqested_by'];
    
            // Retrieve product line items data (arrays)
            $product_ids = $_POST['product_ids']; // e.g. [1, 2, 3] - these are inventory IDs
            $quantities  = $_POST['quantities'];  // e.g. [2, 1, 5]
            $prices      = $_POST['prices'];      // e.g. [100.00, 200.00, 50.00]
    
            // Basic check: all arrays must be of equal length.
            if (count($product_ids) !== count($quantities) || count($product_ids) !== count($prices)) {
                die("Product data mismatch. Please check your input.");
            }
    
            // Calculate the total invoice amount and prepare invoice items array
            $total_invoice_amount = 0;
            $invoiceItems = [];
            foreach ($product_ids as $index => $inventory_id) {
                $quantity   = $quantities[$index];
                $price      = $prices[$index];
                $line_total = $quantity * $price;
                $total_invoice_amount += $line_total;
    
                $invoiceItems[] = [
                    'inventory_id' => $inventory_id,
                    'quantity'     => $quantity,
                    'price'        => $price,
                    'line_total'   => $line_total
                ];
            }
    
            // Generate a unique invoice token (if needed)
            $invoiceToken = uniqid('INV_');
    
            // Prepare data for the invoice header in the payment table.
            // Since this is a header record, the Inventory_id is set to NULL.
            $data = [
                'Payment_Description'     => 'Invoice',
                'Installment_No'          => 0, // Not applicable for invoices
                'Due_Date'                => $due_date,
                'Due_Amt'                 => $total_invoice_amount,
                'Receipt_Amt'             => 0.00,  // No receipt yet
                'os_amt'                  => $total_invoice_amount,  // Outstanding equals total amount
                'Discount_Amt'            => $discount_amt,
                'amount_in_words'         => '',
                'receive_mount_in_words'  => '',
                'remaining_mount_in_words'=> '',
                'remaining_date'          => date("Y-m-d H:i:s"),
                'biyanah'                 => 0,
                'biyanah_in_words'        => '',
                'biyanah_date'            => date("Y-m-d H:i:s"),
                'token_type'              => $invoiceToken,
                'Inventory_id'            => null,  // No single inventory id for header
                'issue_by'                => $issue_by,
                'reqested_by'             => $reqested_by,
                'customer_id'             => $customer_id,
            ];
    
            // Create the invoice header record in the payment table.
            $result = $this->paymentModel->createInvoice($data);
            if ($result && $result['success']) {
                $payment_id = $result['id'];  // This is the new payment record id
                // Save the invoice items linked to this payment (invoice header)
                $this->paymentModel->saveInvoiceItems($payment_id, $invoiceItems);
    
                echo json_encode([
                    'success'    => true,
                    'inventory_id' => $payment_id
                ]);
                exit;
            } else {
                die("Invoice header insertion failed.");
            }
        }
    }

    public function viewInvoice() {
        if (isset($_GET['payment_id'])) {
            
             $payment_id = $_GET['payment_id'];
             $invoice = $this->paymentModel->getInvoice($payment_id);
             
             // For example, return a JSON response:
             echo json_encode($invoice);
             exit;
        } else {
             echo json_encode(['success' => false, 'message' => 'No Payment ID provided']);
             exit;
        }
    }

    public function editInvoice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           // Get the payment id from the POST data
           $payment_id = $_POST['payment_id'];
           
           // Retrieve updated header fields from the form
           $headerData = [
              'Payment_Description' => $_POST['Payment_Description'], // May be a fixed value like "Invoice" or editable
              'Due_Date'            => $_POST['Due_Date'],
              'Discount_Amt'        => $_POST['Discount_Amt'],
              'Due_Amt'             => $_POST['Due_Amt'],   // You might recalculate this based on the items
              'os_amt'              => $_POST['os_amt'],    // Similarly, recalc if necessary
              'remaining_date'      => date("Y-m-d H:i:s"),
              'issue_by'            => $_POST['issue_by'],
              'reqested_by'         => $_POST['reqested_by'],
              'customer_id'         => $_POST['customer_id']
           ];
           
           // Retrieve updated invoice items arrays from the form.
           // Assume the form sends arrays named: inventory_ids[], quantities[], prices[]
           $inventory_ids = $_POST['inventory_ids'];
           $quantities = $_POST['quantities'];
           $prices = $_POST['prices'];
           
           $invoiceItems = [];
           $total_invoice_amount = 0;
           for ($i = 0; $i < count($inventory_ids); $i++) {
               $quantity = $quantities[$i];
               $price = $prices[$i];
               $line_total = $quantity * $price;
               $total_invoice_amount += $line_total;
               
               $invoiceItems[] = [
                  'inventory_id' => $inventory_ids[$i],
                  'quantity'     => $quantity,
                  'price'        => $price,
                  'line_total'   => $line_total
               ];
           }
           
           // Update header totals (if not computed on the fly in the model)
           $headerData['Due_Amt'] = $total_invoice_amount;
           $headerData['os_amt'] = $total_invoice_amount; // or adjust based on partial payments
           
           // Call the model method to update the invoice
           $result = $this->paymentModel->updateInvoice($payment_id, $headerData, $invoiceItems);
           
           if ($result) {
              echo json_encode(['success' => true, 'message' => 'Invoice updated successfully']);
           } else {
              echo json_encode(['success' => false, 'message' => 'Failed to update invoice']);
           }
           exit;
        }
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
    require_once ROOT_PATH . '/../../../config-demo.php';
    $controller = new PaymentController();
    $controller->savePayments();
}elseif((isset($_GET['action']))&& isset($_GET['action'])){
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS','1');
    require_once ROOT_PATH . '/../../../config-demo.php';
    $controller = new PaymentController();
    if($_GET['action']=='store_invoice'){
    
    
    $controller->storeInvoice();
    }
    elseif($_GET['action']=='viewInvoice'){
        $controller->viewInvoice();
    }
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


