<?php

namespace model;

use PDO;
use PDOException;
use abstracts\Model;
use function utils\sanitize;

require_once './src/abstracts/Model.php';
require_once  './src/utils/utils.php';

class CategoryModel extends Model
{
    private ?int $id;
    private ?string $name;

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = sanitize($name);
    }

    public function add(): bool
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');
            $query->bindValue(':name', $this->getName());
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->query('SELECT id,name FROM category');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getById(int $id): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('SELECT id,name FROM category WHERE id = :id');
            $query->bindValue(':id', sanitize($id));
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getByName(string $name): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('SELECT id,name FROM category WHERE name = :name');
            $query->bindValue(':name', sanitize($name));
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }
}