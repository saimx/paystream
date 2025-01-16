<?php
require 'config.php';

class Customer {
    private $db;

    // Constructor to establish the database connection
    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Function to create a new customer
    public function createCustomer($data) {
        $stmt = $this->db->prepare("
            INSERT INTO customers 
                (name, email, phone, address, id_card, next_of_kin, next_of_kin_id_card, relationship, 
                photo_path, id_card_front, id_card_back, 
                next_of_kin_id_card_front, next_of_kin_id_card_back, created_by, created_at) 
            VALUES 
                (:name, :email, :phone, :address, :id_card, :next_of_kin, :next_of_kin_id_card, :relationship, 
                :photo_path, :id_card_front, :id_card_back, 
                :next_of_kin_id_card_front, :next_of_kin_id_card_back, :created_by, :created_at)
        ");

        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':id_card' => $data['id_card'],
            ':next_of_kin' => $data['next_of_kin'],
            ':next_of_kin_id_card' => $data['next_of_kin_id_card'],
            ':relationship' => $data['relationship'],
            ':photo_path' => $data['photo_path'],
            ':id_card_front' => $data['id_card_front'],
            ':id_card_back' => $data['id_card_back'],
            ':next_of_kin_id_card_front' => $data['next_of_kin_id_card_front'],
            ':next_of_kin_id_card_back' => $data['next_of_kin_id_card_back'],
            ':created_by' => $data['created_by'],
            ':created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->db->lastInsertId();
    }

    // Function to check if an ID card or email already exists
    public function recordExists($field, $value) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM customers WHERE {$field} = :value");
        $stmt->execute([':value' => $value]);
        return $stmt->fetchColumn() > 0;
    }

    // Function to fetch all customers
    public function getAllCustomers() {
        $stmt = $this->db->query("SELECT * FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to fetch a customer by ID
    public function getCustomerById($id) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Function to delete a customer by ID
    public function deleteCustomer($id) {
        $stmt = $this->db->prepare("DELETE FROM customers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Function to update customer details
    public function updateCustomer($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE customers SET 
                name = :name, email = :email, phone = :phone, address = :address, id_card = :id_card, 
                next_of_kin = :next_of_kin, next_of_kin_id_card = :next_of_kin_id_card, 
                relationship = :relationship, photo_path = :photo_path, 
                id_card_front = :id_card_front, id_card_back = :id_card_back, 
                next_of_kin_id_card_front = :next_of_kin_id_card_front, 
                next_of_kin_id_card_back = :next_of_kin_id_card_back 
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':id_card' => $data['id_card'],
            ':next_of_kin' => $data['next_of_kin'],
            ':next_of_kin_id_card' => $data['next_of_kin_id_card'],
            ':relationship' => $data['relationship'],
            ':photo_path' => $data['photo_path'],
            ':id_card_front' => $data['id_card_front'],
            ':id_card_back' => $data['id_card_back'],
            ':next_of_kin_id_card_front' => $data['next_of_kin_id_card_front'],
            ':next_of_kin_id_card_back' => $data['next_of_kin_id_card_back']
        ]);
    }
}
?>
