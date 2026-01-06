<?php 
namespace App\Models\Entity;
use App\Models\Abstractclass\Utilisateur;
class Admin extends Utilisateur{



    public function __construct($nom,$prenom,$email,$password,$role){
        parent::__construct($nom, $prenom, $email, $password,$role::ADMIN);
    }
}

?>