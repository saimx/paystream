<?php


class CustomerModel
{
    private $pdo;

    // Constructor to initialize the database connection
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Store customer data into the database.
     * 
     * @param array $data Associative array of customer data.
     * @return array Result of the operation.
     */
    public function storeCustomer(array $data)
    {
        try {
            // SQL query to insert customer data
            $sql = "INSERT INTO customers (
                        name,fname, email, phone,city,address, id_card,
                        next_of_kin,phone2, next_of_kin_id_card, relationship,
                        photo_path, id_card_front, id_card_back,
                        next_of_kin_id_card_front, next_of_kin_id_card_back,
                        created_by, created_at
                    ) VALUES (
                        :name, :fname, :email, :phone, :city, :address, :id_card,
                        :next_of_kin,:phone2, :next_of_kin_id_card, :relationship,
                        :photo_path, :id_card_front, :id_card_back,
                        :next_of_kin_id_card_front, :next_of_kin_id_card_back,
                        :created_by, :created_at
                    )";

            $stmt = $this->pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':fname', $data['fname']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':phone2', $data['phone2']);
            $stmt->bindParam(':city', $data['city']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':id_card', $data['id_card']);
            $stmt->bindParam(':next_of_kin', $data['next_of_kin']);
            $stmt->bindParam(':next_of_kin_id_card', $data['next_of_kin_id_card']);
            $stmt->bindParam(':relationship', $data['relationship']);
            $stmt->bindParam(':photo_path', $data['photo_path']);
            $stmt->bindParam(':id_card_front', $data['id_card_front']);
            $stmt->bindParam(':id_card_back', $data['id_card_back']);
            $stmt->bindParam(':next_of_kin_id_card_front', $data['next_of_kin_id_card_front']);
            $stmt->bindParam(':next_of_kin_id_card_back', $data['next_of_kin_id_card_back']);
            $stmt->bindParam(':created_by', $data['created_by']);
            $stmt->bindParam(':created_at', $data['created_at']);

            // Execute the statement
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Customer created successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }


        // Function to get all customers
        public function getAllCustomers()
        {
            try {
                $stmt = $this->pdo->query("SELECT * FROM customers ORDER BY created_at DESC");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ];
            }
        }

       // Function to get a single customer by ID
       public function getCustomerById($id)
       {
           try {
               $stmt = $this->pdo->prepare("SELECT * FROM customers WHERE id = :id");
               $stmt->bindParam(':id', $id, PDO::PARAM_INT);
               $stmt->execute();
               return $stmt->fetch(PDO::FETCH_ASSOC);
           } catch (PDOException $e) {
               return [
                   'success' => false,
                   'message' => 'Error: ' . $e->getMessage()
               ];
           }
       }

       public function storeBasicCustomer($name, $phone, $id_card) {
        try {
            // Prepare the SQL statement
            $email ="$name-$id_card@mailinator.com"; //Making fake email as db required uniqe email to save the customer
            $stmt = $this->pdo->prepare("INSERT INTO customers (name, phone, id_card,email) VALUES (:name, :phone, :id_card, :email)");
            
            // Bind parameters explicitly
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':id_card', $id_card, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            // Execute the query
            $stmt->execute();
            $insertedId = $this->pdo->lastInsertId();
            
            return [
                'success' => true,
                'message' => 'Customer added successfully',
                'id' => $insertedId,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ];
        }
    }
        public function getCustomerByPhone($phone)
        {
            try {
                $sql = "SELECT id, name, id_card FROM customers WHERE phone = :phone";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt->execute();
        
                // Fetch and return customer data as an associative array
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Log the error (optional) and return false in case of failure
                error_log('Error fetching customer by phone: ' . $e->getMessage());
                return false;
            }
        }
    

       public function getCustomerByIdCard($idCard)
        {
            try {
                $sql = "SELECT id,name, phone FROM customers WHERE id_card = :id_card";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id_card', $idCard);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return false;
            }
        }
       public function deleteCustomer($id)
       {
           try {
               $stmt = $this->pdo->prepare("DELETE FROM customers WHERE id = :id");
               $stmt->bindParam(':id', $id, PDO::PARAM_INT);
               $stmt->execute();
               return [
                   'success' => true,
                   'message' => 'Customer deleted successfully.'
               ];
           } catch (PDOException $e) {
               return [
                   'success' => false,
                   'message' => 'Error: ' . $e->getMessage()
               ];
           }
       }
       
       // Function to update customer data
    public function updateCustomer($id, array $data)
    {
        try {
            $sql = "UPDATE customers SET
                        name = :name,
                        fname = :fname,
                        email = :email,
                        phone = :phone,
                        phone2 = :phone2,
                        city = :city,
                        address = :address,
                        id_card = :id_card,
                        next_of_kin = :next_of_kin,
                        next_of_kin_id_card = :next_of_kin_id_card,
                        relationship = :relationship,
                        photo_path = :photo_path,
                        id_card_front = :id_card_front,
                        id_card_back = :id_card_back,
                        next_of_kin_id_card_front = :next_of_kin_id_card_front,
                        next_of_kin_id_card_back = :next_of_kin_id_card_back,
                        updated_at = :updated_at
                        WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['id'] = $id;

            // Bind parameters
            foreach ($data as $key => $value) {
                $stmt->bindParam(":$key", $data[$key]);
            }

            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Customer updated successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

// Function to paginate customers
    public function paginateCustomers($limit, $offset)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM customers ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

// Function to search customers by name or email
    public function searchCustomers($searchTerm)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM customers WHERE name LIKE :search OR email LIKE :search ORDER BY created_at DESC");
            $searchTerm = "%$searchTerm%";
            $stmt->bindParam(':search', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    

    
}
