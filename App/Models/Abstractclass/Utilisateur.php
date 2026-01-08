<?php
namespace App\Models\Abstractclass;

use App\Models\BaseModel;
use App\Enum\Role;

abstract class Utilisateur extends BaseModel
{
    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $password;
    protected Role $role;

    public function __construct(string $nom, string $prenom, string $email, string $password, Role $role)
    {
        parent::__construct([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'role' => $role->value
        ]);

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

     public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }
}
