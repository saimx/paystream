<?php

class ReceiptModel
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

    public function storeDirectReceipt(array $data, $payment_id){
        try {
            $date = date('Y-m-d'); // Current date
    
            // Prepare the query
            $sql = "INSERT INTO `receipts` 
                    (`payment_id`, `customer_id`, `amount`, `method`, `note`, `date`, `ref_cheq_no`, `conditional`, `file`) 
                    VALUES 
                    (:payment_id, :customer_id, :amount, :method, :note, :date, :ref_cheq_no, :conditional, :file)";
    
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters
            $stmt->bindValue(':payment_id', $payment_id, PDO::PARAM_INT);
            $stmt->bindValue(':customer_id', $data['customer_id'], PDO::PARAM_INT);
            $stmt->bindValue(':amount', $data['amount']);
            $stmt->bindValue(':method', $data['method']);
            $stmt->bindValue(':note', $data['note']);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':ref_cheq_no', $data['ref_cheq_no']);
            $stmt->bindValue(':conditional', $data['condition']);
            $stmt->bindValue(':file', $data['photo_path']);
    
            // Execute the query
            $stmt->execute();
            $insertedId = $this->pdo->lastInsertId();
    
            return [
                'success' => true,
                'id' => $insertedId,
            ];
        } catch (PDOException $e) {
            // Log error and return false
            error_log('Error storing receipt: ' . $e->getMessage());
            return ['success' => false];
        }
    }




    /**
     * Store receipt data into the database.
     * 
     * @param array $data Associative array of receipt data.
     * @return array Result of the operation.
     */
    public function storeReceipt(array $data)
    {
        try {
            $sql = "INSERT INTO receipts (
            payment_id, amount, date, ref_cheq_no, file, note, method, customer_id
        ) VALUES (
            :payment_id, :amount, :date, :ref_cheq_no, :file, :note, :method, :customer_id
        )";
        $stmt = $this->pdo->prepare($sql);
        $currentDateTime = (new DateTime())->format('Y-m-d H:i:s');
        $stmt->bindParam(':payment_id', $data['payment_id'], PDO::PARAM_INT);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':date', $currentDateTime);
        $stmt->bindParam(':ref_cheq_no', $data['ref_cheq_no']);
        $stmt->bindParam(':file', $data['file']);
        $stmt->bindParam(':note', $data['note']); // Field for note
        $stmt->bindParam(':method', $data['method']); // Field for payment method
        $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT); 
        $stmt->execute();

//
//Receipt_Amt += $data['amount'] existing +this amount
//os_amt-$data['amount']


            return [
                'success' => true,
                'message' => 'Receipt created successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get all receipts for a specific payment.
     * 
     * @param int $paymentId Payment ID.
     * @return array List of receipts.
     */
    public function getReceiptsByPaymentId($paymentId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM receipts WHERE payment_id = :payment_id");
            $stmt->bindParam(':payment_id', $paymentId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function showRceiptsForGraph(){
    
        $query = "SELECT 
                    DATE(date) AS date, 
                    SUM(amount) AS amount, 
                    COUNT(*) AS count 
                FROM 
                    receipts 
                GROUP BY 
                    DATE(date) 
                ORDER BY 
                    date ASC;";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get a single receipt by ID.
     * 
     * @param int $id Receipt ID.
     * @return array Receipt data.
     */
    public function getReceiptById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM receipts WHERE id = :id");
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

    /**
     * Update a receipt by ID.
     * 
     * @param int $id Receipt ID.
     * @param array $data Associative array of updated receipt data.
     * @return array Result of the operation.
     */
    public function updateReceipt($id, array $data)
    {
        try {
            $sql = "UPDATE receipts SET
                        payment_id = :payment_id,
                        amount = :amount,
                        date = :date,
                        ref_cheq_no = :ref_cheq_no,
                        file = :file
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':payment_id', $data['payment_id'], PDO::PARAM_INT);
            $stmt->bindParam(':amount', $data['amount']);
            $stmt->bindParam(':date', $data['date']);
            $stmt->bindParam(':ref_cheq_no', $data['ref_cheq_no']);
            $stmt->bindParam(':file', $data['file']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Receipt updated successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Delete a receipt by ID.
     * 
     * @param int $id Receipt ID.
     * @return array Result of the operation.
     */
    public function deleteReceipt($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM receipts WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Receipt deleted successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
