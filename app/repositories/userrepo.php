<?php
namespace App\Repositories;

use PDO;

class UserRepo extends Repository
{
    public function insert($user)
    {

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)");

        $results = $stmt->execute([
            ':username' => $user->username,
            ':email' => $user->email,
            ':password_hash' => $user->password_hash,]);
        return $results;

    }


    public function authenticateUser($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    
        $stmt->execute([':email' => $email]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\User');
        $user = $stmt->fetch();

        $userPasswordHash = $user->password_hash;
        $userEnteredPassword = $password;

        if (password_verify($userEnteredPassword, $userPasswordHash)) {
            // Password is correct, user is authenticated
            return $user;
        } else {
            // Username or password is incorrect
            return false;
        }
    }

    public function changePassword($password, $user_id)
    {

        $stmt = $this->db->prepare("UPDATE users SET password_hash = :password_hash WHERE id = :user_id;");

        $results = $stmt->execute([
            ':password_hash' => $password,
            ':user_id' => $user_id,]);

        return $results;

    }
}
