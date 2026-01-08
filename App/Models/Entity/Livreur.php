<?php 
namespace App\Models\Entity;

use App\Models\Abstractclass\Utilisateur;
use App\Enum\Role;

class Livreur extends Utilisateur
{
    protected string $table = 'users';

    public function __construct(
        string $nom,
        string $prenom,
        string $email,
        string $password
    ) {
        parent::__construct($nom, $prenom, $email, $password, Role::LIVREUR);
    }

    public function offres(): array
    {
        return [];
    }
   
}
