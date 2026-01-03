<?php 

abstract class Utilisateur 
{
    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $password;
    protected string $role;

    public function __construct(string $nom, string $prenom, string $email, string $password, string $role){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
    
}

?>