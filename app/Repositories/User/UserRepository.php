<?php
namespace App\Repositories\User;

interface UserRepository
{
    public function getAllUsers();

    public function getUserById($id);

    public function userCount();

}
