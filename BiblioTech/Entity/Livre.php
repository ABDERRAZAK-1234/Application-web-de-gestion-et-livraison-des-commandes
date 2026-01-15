<?php
namespace BiblioTech\Entity;
use BiblioTech\Entity\Emprunt;
class Livre
{
    private string $titre;
    private string $description;
    private Emprunt $emprunt;

    public function __construct(string $titre, string $descreption, Emprunt $emprunt)
    {
        $this->titre = $titre;
        $this->description = $descreption;
        $this->emprunt = $emprunt;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;

    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($descreption)
    {
        $this->description = $descreption;
    }
    public function getEmprunt(): Emprunt
    {
        return $this->emprunt;
    }
    public function setEmprunt($emprunt)
    {
        $this->emprunt = $emprunt;
    }
}
?>