<?php
namespace BiblioTech\Entity;
use BiblioTech\Entity\Livre;
class Auteur
{
    private string $nom;
    private string $prenom;
    private Livre $livre;
    public function __construct(string $nom, string $prenom, Livre $livre)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->livre = $livre;
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
    public function getLivre(): Livre
    {
        return $this->livre;
    }
    public function setLivre($livre)
    {
        $this->livre = $livre;
    }

}
?>