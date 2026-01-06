<?php 
namespace App\Models\Entity;

use Dom\Text;

class Commande 
{
    protected string $nomCmd;
    protected string $description;
    protected string $adresseCmd;
    protected string $status;
    protected string $dateCmd;
    protected string $option;

    public function __construct($nomCmd,$description,$adresseCmd,$status,$dateCmd,$option)
    {
        $this->nomCmd = $nomCmd;
        $this->description = $description;
        $this->adresseCmd = $adresseCmd;
        $this->status = $status;
        $this->dateCmd = $dateCmd;
        $this->option = $option;
    }
    public function getNomCmd(): string{
        return $this->nomCmd;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function getAdresseCmd(): string{
        return $this->adresseCmd;
    }
    public function getStatus(): string{
        return $this->status;
    }
    public function getDateCmd(): string{
        return $this->dateCmd;
    }
    public function getOption(): string{
        return $this->option;
    }
    



}

?>