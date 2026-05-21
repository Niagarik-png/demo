<?php

class User
{
    public $id;
    public $login;
    public $password;
    public $role;
    public $email;
    public $full_name;
    public $phone;

    public static function register($data, $role = 'user')
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare("INSERT INTO users (login, full_name, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        try {
            $stmt->execute([$data['login'], $data['full_name'], $data['email'], $data['phone'], $role, $hashedPassword]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception('Такой пользователь уже имеется');
            }
            throw $e;
        }
    }

    public static function login($data){
        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE login = ?;');
        $stmt->execute([$data['login']]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception("Неверный логин или пароль");
        }
        if (password_verify($data['password'], $user->password)) {
            throw new Exception('Неверный логин или пароль');
        }
        return $user;
    }
}