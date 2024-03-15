<?php

namespace App\Controller;

use App\Model\User;


class UserController
{


    public function register($login, $password, $confirm_password)
    {

        if (!empty($login) && !empty($password)) {
            $user = new User();
            if ($password == $confirm_password) {
                $userlogin = $user->select($login);
                if ($userlogin == null) {
                    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                    $user->create($login, $password_hashed);
                    header("Location: /plateforme/pomme-d-api");
                } else {
                    echo "user already exists";
                }
            } else {
                echo "not match";
            }
        } else {
            echo "empty fields";
        }
    }

    public function login($login, $password)
    {
        if (!empty($login) && !empty($password)) {
            $user = new User();
            $userlogin = $user->select($login);
            if ($userlogin != null) {
                if (password_verify($password, $userlogin[0]["password"])) {
                    echo "logged in";
                    $user = [
                        "id" => $userlogin[0]["id"],
                        "login" => $userlogin[0]["login"],
                        "password" => $userlogin[0]["password"]
                    ];

                    $_SESSION["id_user"] = $userlogin[0]["id"];
                    var_dump($_SESSION);
                } else {
                    echo "wrong password";
                }
            } else {
                echo "user not found";
            }
        } else {
            echo "empty fields";
        }
    }
}
