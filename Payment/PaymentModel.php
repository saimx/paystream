<?php

class PaymentModel
{
    private $pdo;

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

    public function savePayments($payments)
    {

        $query = "INSERT INTO payment (
            Payment_Description, Installment_No, Due_Date, Discount_Amt, Inventory_id, due_date_u, customer_id, Due_Amt, os_amt
        )
        VALUES (
            :Payment_Description, :Installment_No, :Due_Date, :Discount_Amt, :Inventory_id, :due_date_u, :customer_id, :Due_Amt, :os_amt
        )";
        $stmt = $this->pdo->prepare($query);
        // echo'<pre>';
        // print_r($payments);
        // die;
    
        foreach ($payments as $payment) {
            $unix_date =strtotime($payment['Due_Date']);
            $stmt->bindParam(':Payment_Description', $payment['Payment_Description']);
            $stmt->bindParam(':Installment_No', $payment['Installment_No']);
            $stmt->bindParam(':Due_Amt', $payment['Due_Amt']);
            $stmt->bindParam(':os_amt', $payment['Due_Amt']);
            $stmt->bindParam(':Due_Date', $payment['Due_Date']);
            $stmt->bindParam(':due_date_u', $unix_date);
            $stmt->bindParam(':Discount_Amt', $payment['Discount_Amt']);
            $stmt->bindParam(':Inventory_id', $payment['Inventory_id']);
            $stmt->bindParam(':customer_id', $payment['customer_id']);
            $stmt->execute();
        }

        return true;
    }


    public function storeDirectPayment(array $data)
{
    try {
        $today = date('Y-m-d'); // Current date

        // Determine `os_amt` based on the status
        $os_amt = (empty($data['ramount'])) ? 0 : $data['ramount'];
        // --------------
        if(!empty($data['token_type'])){
            $token = $data['token_type'];
        }else{
            $token = 'N/A';
        }
      

  
        // -------------------------

        // Get the `issued_by` from the session
        session_start();
        $issued_by = $_SESSION['Name'];

        // Prepare the query with the additional fields
        $sql = "INSERT INTO `payment` 
            (`Payment_Description`, `Installment_No`, `Due_Date`, `Due_Amt`, `Receipt_Amt`, `os_amt`, `Discount_Amt`, `Inventory_id`, `customer_id`, 
             `remaining_mount_in_words`, `receive_mount_in_words`, `amount_in_words`, `issue_by`, `reqested_by`, `biyanah`, `biyanah_date`, 
             `biyanah_in_words`, `remaining_date`, `token_type`) 
            VALUES 
            (:Payment_Description, :Installment_No, :Due_Date, :Due_Amt, :Receipt_Amt, :os_amt, :Discount_Amt, :Inventory_id, :customer_id,
             :remaining_mount_in_words, :receive_mount_in_words, :amount_in_words, :issue_by, :reqested_by, :biyanah, :biyanah_date, 
             :biyanah_in_words, :remaining_date, :token_type)";

        $stmt = $this->pdo->prepare($sql);

        // Bind parameters for the existing fields
        $stmt->bindValue(':Payment_Description', $data['inv-name'] . '-' . $data['floor']);
        $stmt->bindValue(':Installment_No', 0);
        $stmt->bindValue(':Due_Date', $today);
        $stmt->bindValue(':Due_Amt', $data['famount']);
        $stmt->bindValue(':Receipt_Amt', $data['amount']);
        $stmt->bindValue(':os_amt', $os_amt);
        $stmt->bindValue(':Discount_Amt', 0.00);
        $stmt->bindValue(':Inventory_id', $data['inventory_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':customer_id', $data['customer_id'], PDO::PARAM_INT);
        $stmt->bindValue(':remaining_mount_in_words', $data['remaining_mount_in_words'] ?? '');
        $stmt->bindValue(':receive_mount_in_words', $data['receive_mount_in_words'] ?? '');
        $stmt->bindValue(':amount_in_words', $data['amount_in_words'] ?? '');
        $stmt->bindValue(':issue_by', $issued_by);

        // Bind parameters for the new fields
        $stmt->bindValue(':reqested_by', $data['reqested_by'] ?? '');
        $stmt->bindValue(':biyanah', $data['biyanah'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':biyanah_date', $data['biyanah_date'] ?? null);
        $stmt->bindValue(':biyanah_in_words', $data['biyanah_in_words'] ?? '');
        $stmt->bindValue(':remaining_date', $data['remaining_date'] ?? null);

        // Bind parameter for `token_type`
        $stmt->bindValue(':token_type', $token ?? '');

        // Execute the query
        $stmt->execute();
        $insertedId = $this->pdo->lastInsertId();

        return [
            'success' => true,
            'id' => $insertedId,
        ];
    } catch (PDOException $e) {
        // Log error and return false
        error_log('Error storing payment: ' . $e->getMessage());
        return false;
    }
}

    public function getSumOfPaymentsByInventoryId($inventoryId)
    {
        $query = "
            SELECT 
                SUM(Due_Amt) AS total_due_amt, 
                SUM(Receipt_Amt) AS total_receipt_amt 
            FROM 
                payment 
            WHERE 
                Inventory_id = :Inventory_id
        ";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':Inventory_id', $inventoryId, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row as the result
    }

    public function showRceipts(){
    
        $query = "SELECT * FROM `receipts` ORDER BY `receipts`.`id` DESC ";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPaymentsWithReceipts() {
        // Query to get payments and their associated receipts
        $query = "
         SELECT 
    payment.id AS payment_id,
    payment.Payment_Description,
    payment.Installment_No,
    payment.Due_Date,
    payment.Due_Amt,
    payment.Receipt_Amt,
    payment.os_amt,
    payment.issue_by,
    payment.Discount_Amt,
    customer.name AS customer_name,
    receipt.id AS receipt_id,
    receipt.amount AS receipt_amount,
    receipt.date AS receipt_date,
    receipt.file AS receipt_file
FROM payment
LEFT JOIN customers AS customer ON payment.customer_id = customer.id
LEFT JOIN receipts AS receipt ON payment.id = receipt.payment_id
WHERE MONTH(receipt.date) = MONTH(CURRENT_DATE)  -- Filter for the current month
  AND YEAR(receipt.date) = YEAR(CURRENT_DATE)    -- Filter for the current year
ORDER BY payment.id DESC;

        ";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public function dashboard_index(){
        $query ="
                    SELECT  
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
                customers.photo_path AS customer_photo,
                customers.phone AS customer_phone,
                COALESCE(SUM(payment.Due_Amt), 0) AS total_due_amt,
                COALESCE(SUM(payment.Receipt_Amt), 0) AS total_receipt_amt,
                COALESCE(
                    SUM(
                        CASE 
                            WHEN UNIX_TIMESTAMP() > payment.due_date_u THEN payment.os_amt 
                            ELSE 0 
                        END
                    ), 
                    0
                ) AS total_overdue_amt,
                COALESCE(
                    COUNT(  
                        CASE 
                            WHEN UNIX_TIMESTAMP() > payment.due_date_u THEN 1 
                            ELSE NULL 
                        END
                    ), 
                    0
                ) AS overdue_count
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
            WHERE 
                payment.due_date_u IS NOT NULL
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
                customers.phone
            ORDER BY 
                overdue_count DESC;
";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
    


    public function getPaymentAlongReceipts($paymentId)
    {


    $query="SELECT
    payment.*,                    -- Select all fields from the payment table
    receipt.*,                    -- Select all fields from the receipts table
    inventory.name AS inventory_name,  -- Select the 'name' field from the inventory table
    inventory.floor AS inventory_floor,  -- Select the 'floor' field from the inventory table
    customers.name AS customer_name,     -- Select the 'name' field from the customer table
    customers.id_card AS customer_id_card,
    customers.phone AS customer_phone
FROM
    receipts AS receipt
JOIN
    payment AS payment
ON
    payment.id = receipt.payment_id
LEFT JOIN
    inventory AS inventory
ON
    payment.Inventory_id = inventory.id
LEFT JOIN
    customers AS customers
ON
    payment.customer_id = customers.id
WHERE
    receipt.payment_id = :payment_id;
";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':payment_id', $paymentId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }






    public function getPaymentswidCustomerByInventoryId($inventoryId)
    {


    $query="SELECT 
    p.*, 
    c.id AS customer_id,
    c.photo_path AS customer_photo,
    c.fname AS customer_father, 
    c.name AS customer_name,
    c.id_card AS customer_idCard, 
    c.email AS customer_email, 
    c.phone AS customer_phone,
    GROUP_CONCAT(
        JSON_OBJECT(
            'receipt_id', r.id,
            'amount', r.amount,
            'date', r.date,
            'file',r.file
        ) SEPARATOR ','
    ) AS receipts
FROM 
    payment p
LEFT JOIN 
    customers c ON p.customer_id = c.id
LEFT JOIN 
    receipts r ON p.id = r.payment_id
WHERE 
    p.Inventory_id = :Inventory_id
GROUP BY 
    p.id, c.id;
";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':Inventory_id', $inventoryId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPaymentsByInventoryId($inventoryId)
    {
    $query = "SELECT * FROM payment WHERE Inventory_id = :Inventory_id";
    
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':Inventory_id', $inventoryId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePaymentsFromReceipts($payment_id, $amount)
    {
        // Start a transaction to ensure the operations are atomic
        $this->pdo->beginTransaction();

        try {
            // Fetch the current payment details by $payment_id
            $stmt = $this->pdo->prepare("SELECT Receipt_Amt, os_amt FROM payment WHERE id = :payment_id");
            $stmt->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);
            $stmt->execute();
            $payment = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($payment) {
                // Calculate the new values
                $new_receipt_amt = $payment['Receipt_Amt'] + $amount;
                $new_os_amt = $payment['os_amt'] - $amount;

                // Update the payment record with the new values
                $updateStmt = $this->pdo->prepare(
                    "UPDATE payment 
                    SET Receipt_Amt = :new_receipt_amt, os_amt = :new_os_amt
                    WHERE id = :payment_id"
                );
                $updateStmt->bindParam(':new_receipt_amt', $new_receipt_amt, PDO::PARAM_STR);
                $updateStmt->bindParam(':new_os_amt', $new_os_amt, PDO::PARAM_STR);
                $updateStmt->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);

                // Execute the update query
                $updateStmt->execute();

                // Commit the transaction
                $this->pdo->commit();
            } else {
                // Payment record not found, roll back the transaction
                $this->pdo->rollBack();
                throw new Exception("Payment record with ID $payment_id not found.");
            }
        } catch (Exception $e) {
            // Rollback in case of any error
            $this->pdo->rollBack();
            throw $e;
        }
    }
      




}


