<?php 

namespace App\Models;
use App\Database\DatabaseConnection;
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
    // find by id
    public static function find(int $id){
        $instance = new static();
        $stmt = $instance->db->prepare(
            "SELECT * FROM {$instance->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // save
    public function save()
    {
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