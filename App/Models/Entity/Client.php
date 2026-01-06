<?php 
namespace App\Models\Entity;

use App\Models\Abstractclass\Utilisateur;

class Client extends Utilisateur
{
    public function __construct(string $nom, string $prenom, string $email, string $password, string $role)
    {
        return parent::__construct($nom, $prenom, $email, $password, $role::CLIENT);
    }
}
?>