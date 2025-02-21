<?php
require_once('Database.class.php');
class User {
    public static function authenticate($email, $password) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return bin2hex(random_bytes(16));
        }
        return false;
    }
}
?>