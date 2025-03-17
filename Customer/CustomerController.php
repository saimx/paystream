    <?php

    require_once 'CustomerModel.php';

    class CustomerController
    {
        private $customerModel;

        public function __construct()
        {   
            
         
            $this->customerModel = new CustomerModel();
        }

        public function viewAllCustomers()
        {
            $customers = $this->customerModel->getAllCustomers();
            return  $customers;
            //return json_encode($customers);
        }

        /**
         * Handles the form submission.     
         * 
         * @return void
         */
        public function handleFormSubmission()
        {
            // $fname = $_POST['fname'] ?? '';
            //     echo $fname ;
            // die;

            // Retrieve form data
                $name = $_POST['name'] ?? '';
                $fname = $_POST['fname'] ?? '';
                $email = $_POST['email'] ?? '';
                $phone = $_POST['phone'] ?? '';
                $phone2 = $_POST['phone2'] ?? '';
                $city = $_POST['city'] ?? '';
                $address = $_POST['address'] ?? '';
                $idCard = $_POST['id_card'] ?? '';
                $nextOfKin = $_POST['next_of_kin'] ?? '';
                $nextOfKinIdCard = $_POST['next_of_kin_id_card'] ?? '';
                $relationship = $_POST['relationship'] ?? '';
                $photoPath = $_POST['photo_path'] ?? '';
                $idCardFrontPath = $_POST['id_card_front_path'] ?? '';
                $idCardBackPath = $_POST['id_card_back_path'] ?? '';
                $idCardNOKFrontPath = $_POST['id_card_NOK_front_path'] ?? '';
                $idCardNOKBackPath = $_POST['id_card_NOK_back_path'] ?? '';
                $createdBy = 'Admin'; // Example value, can be replaced by session data
                $createdAt = date('Y-m-d H:i:s');

            // Validate form inputs (example validation, adjust as needed)
            $errors = [];
            if (empty($name)) {
                $errors[] = 'Name is required.';
            }
            if (empty($fname)) {
                $errors[] = 'Father/Husband Name is required.';
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'A valid email is required.';
            }
            if (empty($phone)) {
                $errors[] = 'Phone number is required.';
            }
            if (empty($idCard)) {
                $errors[] = 'ID card is required.';
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
            $customerData = [
                'name' => $name,
                'fname' => $fname,
                'email' => $email,
                'phone' => $phone,
                'city' => $city,
                'address' => $address,
                'id_card' => $idCard,
                'next_of_kin' => $nextOfKin,
                'next_of_kin_id_card' => $nextOfKinIdCard,
                'phone2' => $phone2,
                'relationship' => $relationship,
                'photo_path' => $photoPath,
                'id_card_front' => $idCardFrontPath,
                'id_card_back' => $idCardBackPath,
                'next_of_kin_id_card_front' => $idCardNOKFrontPath,
                'next_of_kin_id_card_back' => $idCardNOKBackPath,
                'created_by' => $createdBy,
                'created_at' => $createdAt,
            ];

            
            

            // Store customer data
            $result = $this->customerModel->storeCustomer($customerData);

            // Display the result
            if ($result['success']) {
                echo json_encode([
                    'success' => true,
                    'message' => $result['message']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to create customer: ' . $result['message']
                ]);
            }
        }
        public function storeBasicCustomer(){
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $id_card = $_POST['id_card'] ?? '';

            if (empty($name) || empty($phone) || empty($id_card)) {
                echo json_encode(['success' => false, 'message' => 'All fields are required']);
                exit;
            }

            
            $result = $this->customerModel->storebasicCustomer($name, $phone, $id_card);

            if ($result['success']) {
                echo json_encode([
                    'success' => true,
                    'message' => $result['message'],
                    'id' => $result['id']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to create customer: ' . $result['message']
                ]);
            }
            exit;
        }


public function checkCustomerByPhone()
{
    $phone = $_POST['phone'] ?? '';

    // Check if the phone field is empty
    if (empty($phone)) {
        echo json_encode([
            'success' => false,
            'message' => 'Phone number is required.'
        ]);
        return;
    }

    // Retrieve customer details using the model
    $customer = $this->customerModel->getCustomerByPhone($phone);

    // Check if the customer exists
    if ($customer) {
        echo json_encode([
            'success' => true,
            'data' => [
                'id' => $customer['id'],
                'name' => $customer['name'],
                'id_card' => $customer['id_card'], // Optionally return the ID card here
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Customer not found.'
        ]);
    }
}
        

        public function checkCustomerByIdCard()
        {
            $idCard = $_POST['id_card'] ?? '';

            if (empty($idCard)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'ID Card is required.'
                ]);
                return;
            }

            $customer = $this->customerModel->getCustomerByIdCard($idCard);

            if ($customer) {
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'id' => $customer['id'],
                        'name' => $customer['name'],
                        'phone' => $customer['phone']
                    ]
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Customer not found.'
                ]);
            }
        }

        public function viewCustomer($id)
        {
            $customer = $this->customerModel->getCustomerById($id);
            return $customer;
            // echo json_encode($customer);
        }
    
        // Function to delete a customer by ID
        public function deleteCustomer($id)
        {
            $result = $this->customerModel->deleteCustomer($id);
            echo json_encode($result);
        }


    
        // Handle requests dynamically
        public function handleRequest($action)
        {
            switch ($action) {
                case 'view_all':
                    $this->viewAllCustomers();
                    break;
                case 'view_customer':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $this->viewCustomer($id);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Customer ID is required.']);
                    }
                    break;
                case 'delete_customer':
                    $id = $_GET['id']  ?? null;
                    if ($id) {
                        $this->deleteCustomer($id);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Customer ID is required.']);
                    }
                    break;
                case 'edit_customer':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $this->editCustomer($id);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Customer ID is required.']);
                    }
                    break;
                case 'paginate_customers':
                    $page = $_GET['page'] ?? 1;
                    $limit = $_GET['limit'] ?? 10;
                    $this->paginateCustomers($page, $limit);
                    break;
                case 'search_customers':
                    $this->searchCustomers();
                    break;
                case 'check_customer_by_id_card':
                    $this->checkCustomerByIdCard();
                    break;
                case 'check_customer_by_phone':
                        $this->checkCustomerByPhone();
                    break;
                case 'store_customer':
                    $this->storeBasicCustomer();
                break;            
                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
                    break;
            }
        }

        public function paginateCustomers($page, $limit)
        {
            $offset = ($page - 1) * $limit;
            $customers = $this->customerModel->paginateCustomers($limit, $offset);
            return  $customers;
        }

        public function searchCustomers()
        {
            $searchTerm = $_GET['search'] ?? '';
            $customers = $this->customerModel->searchCustomers($searchTerm);

            //return  $customers;

            echo json_encode($customers);
        }



        public function editCustomer($id)
        {
            // Retrieve form data
            $name = $_POST['name'] ?? '';
            $fname = $_POST['fname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $phone2 = $_POST['phone2'] ?? '';
            $city = $_POST['city'] ?? '';
            $address = $_POST['address'] ?? '';
            $idCard = $_POST['id_card'] ?? '';
            $nextOfKin = $_POST['next_of_kin'] ?? '';
            $nextOfKinIdCard = $_POST['next_of_kin_id_card'] ?? '';
            $relationship = $_POST['relationship'] ?? '';
            $photoPath = $_POST['photo_path'] ?? '';
            $idCardFrontPath = $_POST['id_card_front_path'] ?? '';
            $idCardBackPath = $_POST['id_card_back_path'] ?? '';
            $idCardNOKFrontPath = $_POST['id_card_NOK_front_path'] ?? '';
            $idCardNOKBackPath = $_POST['id_card_NOK_back_path'] ?? '';
            $updatedAt = date('Y-m-d H:i:s');

            // Prepare data for the model
            $customerData = [
                'name' => $name,
                'fname' => $fname,
                'email' => $email,
                'phone' => $phone,
                'city' => $city,
                'address' => $address,
                'id_card' => $idCard,
                'next_of_kin' => $nextOfKin,
                'next_of_kin_id_card' => $nextOfKinIdCard,
                'phone2' => $phone2,
                'relationship' => $relationship,
                'photo_path' => $photoPath,
                'id_card_front' => $idCardFrontPath,
                'id_card_back' => $idCardBackPath,
                'next_of_kin_id_card_front' => $idCardNOKFrontPath,
                'next_of_kin_id_card_back' => $idCardNOKBackPath,
            ];

            // Update customer data
            $result = $this->customerModel->updateCustomer($id, $customerData);

            // Display the result
            echo json_encode($result);
        }
    
    
    
    
    }
 //-----------------------------------------------------------------------------------------------------------------------------------------
 
    
    // Handle the request
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
        $controller = new CustomerController();
        $controller->handleRequest($_GET['action']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
        define('SECURE_ACCESS', true);
        define('ROOT_PATH', __DIR__);
        require_once ROOT_PATH . '/../../../config-demo.php';
  
        $controller = new CustomerController();
        $controller->handleRequest($_GET['action']);
    }


    // Handle the request from form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !(isset($_GET['action'])) ) {
        define('SECURE_ACCESS', true);
        define('ROOT_PATH', __DIR__);
        require_once ROOT_PATH . '/../../../config-demo.php';
    
        $controller = new CustomerController();
        $controller->handleFormSubmission();
    }
