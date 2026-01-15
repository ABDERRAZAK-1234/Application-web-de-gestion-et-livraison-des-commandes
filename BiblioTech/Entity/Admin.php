<?php
namespace BiblioTech\Entity\Admin;
class Admin
{
    private string $nom;
    private string $prenom;
    private string $email;
    private string $telephone;
    private string $password;

    public function __construct(string $nom, string $prenom, string $email, string $telephone, string $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;

    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
?>