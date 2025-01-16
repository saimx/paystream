<?php


class InventoryModel
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
     * Store inventory data into the database.
     * 
     * @param array $data Associative array of inventory data.
     * @return array Result of the operation.
     */
    
    
    
    public function storeInventory(array $data)
    {
        try {
            // SQL query with customer_id included
            $sql = "INSERT INTO inventory (
                        name, size, type, project, code, 
                        booking_date, status, floor, customer_id
                    ) VALUES (
                        :name, :size, :type, :project, :code, 
                        :booking_date, :status, :floor, :customer_id
                    )";
    
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':size', $data['size']);
            $stmt->bindParam(':type', $data['type']);
            $stmt->bindParam(':project', $data['project']);
            $stmt->bindParam(':code', $data['code']);
            $stmt->bindParam(':booking_date', $data['booking_date']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':floor', $data['floor']);
    
            // Use null if customer_id is not present in $data
            $customer_id = $data['customer_id'] ?? null;
            $stmt->bindParam(':customer_id', $customer_id);
    
            $stmt->execute();
            $insertedId = $this->pdo->lastInsertId();
            return [
                'success' => true,
                'message' => 'Inventory item created successfully.',
                'id' => $insertedId,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get all inventory items.
     * 
     * @return array All inventory items.
     */
    public function getInventoriesOfCustomer($cus_id){
        $sql = "SELECT 
        inventory.id AS inventory_id,
        inventory.name AS inventory_name,
        inventory.size,
        inventory.code,
        inventory.booking_date,
        inventory.type,
        inventory.status,
        inventory.project,
        inventory.floor,
        customer_id
    FROM 
        inventory
    WHERE 
        customer_id = ?";

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $cus_id, PDO::PARAM_INT); // Bind the parameter with type hinting
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ];
    }

    }

    public function getAllInventoryUnoccupied(){

        $sql = 'SELECT * FROM inventory WHERE status = "available" ';
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }

    }
    
    
     public function getAllInventory($with_customer=false)
    {
        if($with_customer){

            $sql = "SELECT  
        inventory.id AS inventory_id,
        inventory.name AS inventory_name,
        inventory.size,
        inventory.code,
        inventory.booking_date,
        inventory.type,
        inventory.status,
        inventory.project,
        inventory.floor,
        customers.id AS customer_id,
        customers.name AS customer_name,
        customers.email AS customer_email,
        customers.phone AS customer_phone,
        COALESCE(SUM(payment.Due_Amt), 0) AS total_due_amt,
        COALESCE(SUM(payment.Receipt_Amt), 0) AS total_receipt_amt
    FROM 
        inventory
    LEFT JOIN 
        customers
    ON 
        inventory.customer_id = customers.id
    LEFT JOIN 
        payment
    ON 
        inventory.id = payment.Inventory_id
    GROUP BY 
        inventory.id, 
        inventory.name, 
        inventory.size, 
        inventory.code, 
        inventory.booking_date, 
        inventory.type, 
        inventory.status, 
        inventory.project, 
        inventory.floor, 
        customers.id, 
        customers.name, 
        customers.email, 
        customers.phone ";

            //     $sql = "SELECT 
            //     inventory.id AS inventory_id,
            //     inventory.name AS inventory_name,
            //     inventory.size,
            //     inventory.code,
            //     inventory.booking_date,
            //     inventory.type,
            //     inventory.status,
            //     inventory.project,
            //     inventory.floor,
            //     customers.id AS customer_id,
            //     customers.name AS customer_name,
            //     customers.email AS customer_email,
            //     customers.phone AS customer_phone
            // FROM 
            //     inventory
            // LEFT JOIN 
            //     customers
            // ON 
            //     inventory.customer_id = customers.id";
        }else{
            $sql = 'SELECT * FROM inventory ORDER BY created_date DESC';
        }


        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get a single inventory item by ID.
     * 
     * @param int $id Inventory ID.
     * @return array Inventory item data.
     */
    public function getInventoryById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM inventory WHERE id = :id");
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

    public function assignCustomer($inventoryId, $customerId,$status) {
        try {
            // Corrected SQL query
            
            $stmt = $this->pdo->prepare("UPDATE inventory SET customer_id = ?, status = ?, booking_date = NOW() WHERE id = ?");

            // Bind values and execute
            $stmt->execute([$customerId, $status, $inventoryId]);
    
            // Return success response
            return [
                'success' => true,
                'message' => 'Successfully Inventory assigned to the Customer.'
            ];
        } catch (PDOException $e) {
            // Catch and return error
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    

    
    public function updateInventory($id, array $data)
    {
        try {
            $sql = "UPDATE inventory SET
                        name = :name,
                        size = :size,
                        type = :type,
                        project = :project,
                        code = :code,
                        booking_date = :booking_date,
                        status = :status,
                        floor = :floor
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':size', $data['size']);
            $stmt->bindParam(':type', $data['type']);
            $stmt->bindParam(':project', $data['project']);
            $stmt->bindParam(':code', $data['code']);
            $stmt->bindParam(':booking_date', $data['booking_date']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':floor', $data['floor']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Inventory item updated successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }




    /**
     * Delete an inventory item by ID.
     * 
     * @param int $id Inventory ID.
     * @return array Result of the operation.
     */
    public function deleteInventory($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM inventory WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Inventory item deleted successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }



    public function checkNameAvailable($name)
    {
        try {
            // Prepare the SQL query to check for the name
            $query = "SELECT COUNT(*) as count FROM inventory WHERE name = :name";

            // Prepare the statement
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return true if the name does not exist, false otherwise
            return ($result['count'] == 0);
        } catch (PDOException $e) {
            // Handle any potential errors
            error_log("Database query failed: " . $e->getMessage());
            return false;
        }
    }
}
