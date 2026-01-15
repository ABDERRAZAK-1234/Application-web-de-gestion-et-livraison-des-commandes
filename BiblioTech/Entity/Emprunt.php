<?php
namespace BiblioTech\Entity;
class Emprunt
{
    private string $descreption;
    private string $dateDebut;
    private string $dateFin;

    public function __construct(string $descreption, string $dateDebut, string $dateFin)
    {
        $this->descreption = $descreption;
        $this->$dateDebut = $dateDebut;
        $this->$dateFin = $dateFin;
    }

    public function getDescreption()
    {
        return $this->descreption;
    }
    public function setDescreption($descreption)
    {
        return $this->descreption = $descreption;
    }
    public function getDateDebut()
    {
        return $this->dateDebut;
    }
    public function setDateDebut($dateDebut)
    {
        return $this->dateDebut = $dateDebut;
    }
    public function getDateFin()
    {
        return $this->dateFin;
    }
    public function setDateFin($dateFin)
    {
        return $this->dateFin = $dateFin;
    }
}
?>