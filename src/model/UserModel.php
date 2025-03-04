<?php

namespace model;

require_once './src/utils/utils.php';
require_once './src/abstracts/Model.php';

use abstracts\Model;
use PDO;
use PDOException;
use function utils\sanitize;

class UserModel extends Model
{
    private ?int $id;
    private ?string $nickname;
    private ?string $email;
    private ?string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = sanitize($nickname);
    }

    public function setEmail(string $email): void
    {
        $this->email = sanitize($email);
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function add(): bool
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('INSERT INTO users (nickname, email, psswrd) VALUES (:username,:email,:password)');
            $query->bindValue(':username', $this->getNickname());
            $query->bindValue(':email', $this->getEmail());
            $query->bindValue(':password', $this->getPassword());
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->query('SELECT id,nickname,email FROM users');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getPasswordHashByEmail(string $email) {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('SELECT psswrd FROM users WHERE email = :email');
            $query->bindValue(':email', sanitize($email));
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getByEmail(string $email): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('SELECT id,nickname,email FROM users WHERE email = :email');
            $query->bindValue(':email', sanitize($email));
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createSession(): void {
        $_SESSION['session_user'] = $this->getEmail();
    }

    public function getSession(): mixed
    {
        return $_SESSION['session_user'];
    }

    public function isAuthenticated(): bool {
        return isset($_SESSION['session_user']);
    }
}