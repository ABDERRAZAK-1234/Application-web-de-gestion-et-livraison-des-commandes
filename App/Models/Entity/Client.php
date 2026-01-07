<?php 
namespace App\Models\Entity;

use App\Models\Abstractclass\Utilisateur;
use App\Enum\Role;

class Client extends Utilisateur
{
    protected string $table = 'users';
    public function __construct($nom,$prenom,$email,$password)
    {
        return parent::__construct($nom, $prenom, $email, $password, Role::CLIENT);
    }
}
?>