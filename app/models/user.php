<?php
namespace App\Models;

class User
{
    public $id;
    public $username;
    public $email;
    public $password_hash;
    public $role;
    public $created_at;
    public $updated_at;
}
