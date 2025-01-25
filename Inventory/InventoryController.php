<?php

require_once 'InventoryModel.php';

class InventoryController
{
    private $inventoryModel;

    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
    }

    // Fetch all inventory items
    public function viewAllInventory($with_customer=false)
    {
        $inventory = $this->inventoryModel->getAllInventory($with_customer);
        
        return json_encode($inventory);
    }

    public function viewAllInventoryUnoccupied()
    {
        $inventory = $this->inventoryModel->getAllInventoryUnoccupied();
        return json_encode($inventory);
    }


    public function getInventoriesOfCustomer($id)
    {   
        $inventory = $this->inventoryModel->getInventoriesOfCustomer($id);
        // print_r($inventory);
        return json_encode($inventory);
        
    }

    public function storeMiniInventory(){

        
        // Retrieve form data   
        $name = $_POST['name'] ?? '';
        $size = $_POST['size'] ?? '';
        $type = $_POST['type'] ?? '';
        $project = $_POST['floor'] ?? '';
        $bookingDate = date('Y-m-d H:i:s');
        $status = 'booked';
        $floor = $_POST['floor'] ?? '';
        $code = $_POST['registration_number'] ?? '';
        $customer_id = $_POST['customer_id'] ?? '';
        $possession = $_POST['possession'] ?? '';
        $utility = $_POST['utility'] ?? '';
        $extra = $_POST['extra'] ?? '';
        $corner = $_POST['corner'] ?? '';
        // Validate form inputs
        $errors = [];
        if (empty($customer_id)) {
            $errors[] = 'Customer is required.';
        }

        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
    
        if (empty($type)) {
            $errors[] = 'Type is required.';
        }
        if (empty($floor)) {
            $errors[] = 'Location is required.';
        }

        $inventoryData = [
            'name' => $name,
            'size' => $size,
            'type' => $type,
            'project' => $project,
            'code' => $code,
            'booking_date' => $bookingDate,
            'status' => $status,
            'floor' => $floor,
            'customer_id'=>$customer_id,
            'possession'=>$possession,
            'utility'=>$utility,
            'extra'=> $extra,
            'corner'=> $corner


        ];
       


        $result = $this->inventoryModel->storeInventory($inventoryData);
        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => $result['message'],
                'id' => $result['id']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to add inventory: ' . $result['message']
            ]);
        }


    }


    // Handles form submission for adding a new inventory item
    public function handleFormSubmission()
    {       
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        // Retrieve form data   
        $name = $_POST['name'] ?? '';
        $size = $_POST['size'] ?? '';
        $type = $_POST['type'] ?? '';
        $project = $_POST['project'] ?? '';
        $code = $_POST['code'] ?? '';
        $bookingDate = $_POST['booking_date'] ?? null;
        $status = $_POST['status'] ?? 'available';
        $floor = $_POST['floor'] ?? null;

        // Validate form inputs
        $errors = [];
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        if (empty($size)) {
            $errors[] = 'Size is required.';
        }
        if (empty($type)) {
            $errors[] = 'Type is required.';
        }
        if (empty($project)) {
            $errors[] = 'Project is required.';
        }

        // Check for errors
        if (!empty($errors)) {
            echo "The following errors occurred:<br>";
            foreach ($errors as $error) {
                echo "- $error<br>";
            }
            return;
        }

        // Prepare data for the model
        $inventoryData = [
            'name' => $name,
            'size' => $size,
            'type' => $type,
            'project' => $project,
            'code' => $code,
            'booking_date' => $bookingDate,
            'status' => $status,
            'floor' => $floor,
        ];
        if ($id) {
            // Update existing record
            $result = $this->inventoryModel->updateInventory($id, $inventoryData);
            // echo json_encode(['success' => $result, 'message' => $result ? 'Inventory updated successfully.' : 'Failed to update inventory.']);
        } else {
            // Create new record
            $result = $this->inventoryModel->storeInventory($inventoryData);
            // echo json_encode(['success' => $result, 'message' => $result ? 'Inventory created successfully.' : 'Failed to create inventory.']);
        }
        // Store inventory data
        

        // Display the result
        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => $result['message']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to add inventory: ' . $result['message']
            ]);
        }
    }

    public function checkNameAvailable($name){
        
        $isAvailable =$this->inventoryModel->checkNameAvailable($name);
        if ($isAvailable) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }
    public function assignCustomer($inventoryId, $customerId, $status){

        $result = $this->inventoryModel->assignCustomer($inventoryId, $customerId,$status);
       
        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => $result['message']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to Assign Customer to Inventory: ' . $result['message']
            ]);
        }

    }

    // Fetch a single inventory item by ID
    public function viewInventory($id)
    {
        $inventory = $this->inventoryModel->getInventoryById($id);
        echo json_encode($inventory);
    }

    // Delete an inventory item by ID
    public function deleteInventory($id)
    {
        $result = $this->inventoryModel->deleteInventory($id);
        echo json_encode($result);
    }

    // Update an inventory item by ID
    public function updateInventory()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Inventory ID is required.']);
            return;
        }

        // Retrieve updated data
        $data = [
            'name' => $_POST['name'] ?? '',
            'size' => $_POST['size'] ?? '',
            'type' => $_POST['type'] ?? '',
            'project' => $_POST['project'] ?? '',
            'code' => $_POST['code'] ?? '',
            'booking_date' => $_POST['booking_date'] ?? null,
            'status' => $_POST['status'] ?? 'available',
            'floor' => $_POST['floor'] ?? null,
        ];

        // Update inventory
        $result = $this->inventoryModel->updateInventory($id, $data);

        echo json_encode($result);
    }

    // Handle requests dynamically
    public function handleRequest($action)
    {
        switch ($action) {
            case'getInventorireisCustomer':
                $id =htmlentities($_GET['customer_id']) ?? null;
                if ($id) {
                   echo $this->getInventoriesOfCustomer($id);
                }
                break;
            case 'view_all':

                $this->viewAllInventory();
                break;
            case 'view_inventory':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->viewInventory($id);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Inventory ID is required.']);
                }
                break;
            case 'delete_inventory':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->deleteInventory($id);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Inventory ID is required.']);
                }
                break;
            case 'update_inventory':
                $this->updateInventory();
                break;
            case 'assign_customer':
                $this->assignCustomer($_GET['id'],$_GET['cusid'],$_GET['status']);
                break; 
            case 'checkNameAvailable':
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    $this->checkNameAvailable($name);  
                }else{
                    echo json_encode(['success' => false, 'message' => 'Invalid Params.']);
                }
                  break;  
            case 'store_inventory':
                $this->storeMiniInventory();
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
    require_once ROOT_PATH . '/../../../config.php';
    $controller = new InventoryController();
    $controller->handleRequest($_GET['action']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS', true);
    require_once ROOT_PATH . '/../../../config.php';
    $controller = new InventoryController();
    $controller->handleRequest($_GET['action']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !(isset($_GET['action']))) {
    define('ROOT_PATH', __DIR__);
    define('SECURE_ACCESS', true);
    require_once ROOT_PATH . '/../../../config.php';
    $controller = new InventoryController();
    $controller->handleFormSubmission();
}
