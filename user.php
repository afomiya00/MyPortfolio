<?php

require_once 'db.php';

class User extends DB {
    public function login($userName, $password) {
        $this->connect();
    
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($row = $result->fetch_assoc()) {
          $pwdCheck = password_verify($password, $row['password']);
    
          if($pwdCheck) {
            $stmt->close();
            $this->closeConnection();
            return true;
          }
        }
        
        $stmt->close();
        $this->closeConnection();
        return false;
    } 

    public function register($userName, $password) {
        $this->connect();

        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $stmt->close();
            $this->closeConnection();
            return "Username already exists";
        } else {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          
          $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
          $stmt = $this->conn->prepare($sql);
          $stmt->bind_param("ss", $userName, $hashedPassword);
          $stmt->execute();
          
          $stmt->close();
          $this->closeConnection();
        }
    }
}

$userName = 'afomiya';
$password = '12345';

$newUser = new User();
$newUser->register($userName, $password);
?>