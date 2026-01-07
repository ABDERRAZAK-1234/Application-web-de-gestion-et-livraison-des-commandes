<?php 
namespace App\Models\Entity;

use App\Models\Abstractclass\Utilisateur;
use App\Enum\Role;
class Admin extends Utilisateur{
    protected string $table = 'users';
    
    public function __construct($nom="",$prenom="",$email="",$password=""){
        parent::__construct($nom, $prenom, $email, $password, Role::ADMIN);
    }

}

?>