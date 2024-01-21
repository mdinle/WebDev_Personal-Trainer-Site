<?php
namespace App\Services;

class UserService
{
    public function createUser($user)
    {
        $repository = new \App\Repositories\UserRepo();
        return $repository->insert($user);
    }

    public function authenticateUser($user)
    {
        $repository = new \App\Repositories\UserRepo();
        return $repository->authenticateUser($user->email, $user->password_hash);
    }

    public function changePassword($password, $user_id)
    {
        $repository = new \App\Repositories\UserRepo();
        return $repository->changePassword($password, $user_id);
    }
}
