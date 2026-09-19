<?php
class Product 
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        return $this->db->query('SELECT * FROM products ORDER BY id')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $name, float $price): int
    {
        $stmt = $this->db->prepare('INSERT INTO products (name, price) VALUES (?, ?) RETURNING id');
        $stmt->execute([$name, $price]);
        return $stmt->fetchColumn();
    }

    public function update(int $id, string $name, float $price): bool
    {
        $stmt = $this->db->prepare('UPDATE products SET name = ?, price = ? WHERE id = ?');
        $stmt->execute([$name, $price, $id]);
        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}
