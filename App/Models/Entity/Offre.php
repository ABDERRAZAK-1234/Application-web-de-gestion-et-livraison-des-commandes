<?php 
namespace App\Models\Entity;
use App\Enum\Vhecule;

class Offre
{
    protected string $prix;
    protected string $quantite;
    protected Vhecule $vhecule;
    public function __construct()
    {
        
    }
}

?>