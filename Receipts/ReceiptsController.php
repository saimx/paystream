<?php

require_once 'ReceiptsModel.php';

class ReceiptsController
{
    private $receiptsModel;

    public function __construct()
    {
        $this->receiptsModel = new ReceiptModel();
    }

    // Fetch all receipts
    public function viewAllReceipts()
    {
        $receipts = $this->receiptsModel->getAllReceipts();
        return json_encode($receipts);
    }

    // Fetch a single receipt by ID
    public function viewReceipt($id)
    {
        $receipt = $this->receiptsModel->getReceiptById($id);
        echo json_encode($receipt);
    }

    public function getReceiptsByPaymentId($payment_id){
        $receipt = $this->receiptsModel->getReceiptsByPaymentId($payment_id);
        echo json_encode($receipt);

    }

    public function display_receipts_for_Graph(){
        $receipts = $this->receiptsModel->showRceiptsForGraph();
        return $receipts;
    }
    
    public function make_direct_receipt(){
        // echo'<pre>';
        // print_r($_REQUEST);
        // die;
        require_once '../Payment/PaymentModel.php';
        $paymentModel = new PaymentModel;
        $payment = $paymentModel->storeDirectPayment($_REQUEST);
        if($payment['success'])
        {
            $payment_id = $payment['id'];
            $receipt = $this->receiptsModel->storeDirectReceipt($_REQUEST, $payment_id);
            if ($receipt['success']) {
                echo json_encode(['status' => 'success', 'message' => 'Payment and Receipt stored successfully','id'=>$payment_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Payment stored, but failed to store receipt']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to store payment']);
        }


    }

    
  

    // Handles form submission for adding or updating a receipt
    public function handleFormSubmission()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        $paymentId  = isset($_POST['payment-id']) ? intval($_POST['payment-id']) : null;
        
        $customerId = $_POST['customerId'] ?? null;
        $amount = $_POST['amount'] ?? null;
        $note = $_POST['note'] ?? '';
        $file_photo_path = $_POST['photo_path'];
        $ref_cheq_no =  $_POST['ref_cheq_no'];
        $method = $_POST['method'];

        // Validate inputs
        $errors = [];
        if (empty($customerId)) {
            
            $errors[] = 'Customer ID is required.';
        }
        if (empty($paymentId)) {
            $errors[] = 'Payment ID is required.';
        }

        if (empty($file_photo_path)) {
            $errors[] = 'Receipt Image is Missing.';
        }
        
        if (empty($amount)) {
            $errors[] = 'Amount is required.';
        }
        
        if (!empty($errors)) {
            echo "The following errors occurred:<br>";
            foreach ($errors as $error) {
                echo "- $error<br>";
            }
            return;
        }

        // Prepare data for the model
        $receiptData = [
            'customer_id' => $customerId,
            'payment_id' => $paymentId,
            'file'=>$file_photo_path,
            'amount' => $amount,
            'note' => $note,
            'ref_cheq_no'=> $ref_cheq_no,
            'method'=>$method,
            
        ];

        if ($id) {
            $result = $this->receiptsModel->updateReceipt($id, $receiptData);
        } else{
            try {
            require_once '../Payment/PaymentModel.php';
            // first update the payment model then update the receipt
            $paymentModel = new PaymentModel();
            $paymentModel->updatePaymentsFromReceipts($receiptData['payment_id'], $receiptData['amount']); 

            $result = $this->receiptsModel->storeReceipt($receiptData);
             } catch (Exception $e) {
            // Handle errors and rollback if needed
            echo "Error occurred: " . $e->getMessage();
            }
        }

        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => $result['message']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save receipt: ' . $result['message']
            ]);
        }
    }

    // Delete a receipt by ID
    public function deleteReceipt($id)
    {
        $result = $this->receiptsModel->deleteReceipt($id);
        echo json_encode($result);
    }

    // Handle requests dynamically
    public function handleRequest($action)
    {
        switch ($action) {
            case 'view_all':
                $this->viewAllReceipts();
                break;
            case 'view_receipt':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->viewReceipt($id);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Receipt ID is required.']);
                }
                break;
            case 'delete_receipt':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->deleteReceipt($id);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Receipt ID is required.']);
                }
                break;
            case 'create_direct_receipt':
                $this->make_direct_receipt();    
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid action.']);
                break;
        }
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS', true);
    require_once ROOT_PATH . '/../../../config-demo.php';
    $controller = new ReceiptsController();
    $controller->handleRequest($_GET['action']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS', true);
    require_once ROOT_PATH . '/../../../config-demo.php';
    $controller = new ReceiptsController();
    $controller->handleRequest($_GET['action']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !(isset($_GET['action']))) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS', true);
    require_once ROOT_PATH . '/../../../config-demo.php';
    $controller = new ReceiptsController();
    $controller->handleFormSubmission();
}
