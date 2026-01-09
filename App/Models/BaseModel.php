<?php 

namespace App\Models;
use App\Database\DatabaseConnection;
use App\Models\Abstractclass\Utilisateur;
use PDO;
use Exception;

abstract class BaseModel
{
    protected PDO $db;
    protected string $table;
    protected array $attributes = [];
    public function __construct(array $data = []){
        $this->db = DatabaseConnection::connexion();
        $this->attributes = $data;
    }
    public function set(string $key, $value): void
{
    $this->attributes[$key] = $value;
}
    // getter




    // find by id
    public static function find(int $id){
        $instance = new static();
        $stmt = $instance->db->prepare(
            "SELECT * FROM {$instance->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }
    // save
    public function save()
{
    // Check if email exists
    if (!empty($this->attributes['email'])) {
        $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $this->attributes['email']]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing && !isset($this->attributes['id'])) {
            // Email already exists 
            throw new Exception("Email déjà utilisé !");
        } elseif ($existing && isset($this->attributes['id'])) {
            // Email exists but we are updating the same user
            if ($existing['id'] != $this->attributes['id']) {
                throw new Exception("Email déjà utilisé par un autre utilisateur !");
            }
        }
    }

    if (isset($this->attributes['id'])) {
        // UPDATE
        $arr = [];
        foreach ($this->attributes as $key => $value) {
            if ($key !== 'id') {
                $arr[] = "$key = :$key";
            }
        }

        $sqlsave = "UPDATE {$this->table} SET "
             . implode(',', $arr)
             . " WHERE id = :id";

        $stmt = $this->db->prepare($sqlsave);
        return $stmt->execute($this->attributes);

    } else {
        // INSERT
        $columns = implode(',', array_keys($this->attributes));
        $values  = ':' . implode(',:', array_keys($this->attributes));

        $sqlsave = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sqlsave);
        return $stmt->execute($this->attributes);
    }
}

    public function delete()
    {
        if (!isset($this->attributes['id'])) {
            throw new Exception("ID requis pour supprimer");
        }

        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET is_deleted = true WHERE id = :id"
        );

        return $stmt->execute(['id' => $this->attributes['id']]);
    }

}

?>