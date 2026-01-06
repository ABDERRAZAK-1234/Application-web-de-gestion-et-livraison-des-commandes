<?php 
namespace App\Models\Abstractclass;
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
    public function getNom(): string{
        return $this->nom;
    }
    public function getPrenom(): string{
        return $this->prenom;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function getRole(): string{
        return $this->role;
    }

}

?>