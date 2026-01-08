<?php 
namespace App\Models\Entity;

use App\Enum\Vhecule;
use App\Models\BaseModel;

class Offre extends BaseModel
{
    protected string $table = 'offres';

    protected float $prix;
    protected string $duree;
    protected Vhecule $vhecule;
    protected string $message;
    protected Livreur $livreur; 

    public function __construct(
        float $prix,
        string $duree,
        Vhecule $vhecule,
        string $message,
        Livreur $livreur
    ) {
        $this->livreur = $livreur;

        parent::__construct([
            'prix' => $prix,
            'duree' => $duree,
            'vhecule' => $vhecule->value,
            'message' => $message,
        ]);
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getDuree(): string
    {
        return $this->duree;
    }

    public function getVhecule(): Vhecule
    {
        return $this->vhecule;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLivreur(): Livreur
    {
        return $this->livreur;
    }
}
