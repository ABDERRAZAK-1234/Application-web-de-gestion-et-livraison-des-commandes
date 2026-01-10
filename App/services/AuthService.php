<?php

namespace App\Services;

use App\Models\Entity\Client;
use App\Models\Entity\Livreur;
use App\Models\Abstractclass\Utilisateur;
use App\Models\User;
use Exception;
use App\Database\DatabaseConnection;
use PDO;
// use PDOException;

class AuthService
{
    public function signup(array $data)
    {
        // validation 
        if ($data['password'] !== $data['confirmPassword']) {
            throw new Exception("Les mots de passe ne correspondent pas");
        }

        if (strlen($data['password']) < 6) {
            throw new Exception("Mot de passe court");
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // creation depon role
        switch ($data['role']) {
            case 'client':
                $user = new Client(
                    $data['nom'],
                    $data['prenom'],
                    $data['email'],
                    $hashedPassword
                );
                break;

            case 'livreur':
                $user = new Livreur(
                    $data['nom'],
                    $data['prenom'],
                    $data['email'],
                    $hashedPassword
                );
                break;

            default:
                throw new Exception("Rôle invalide");
        }

        // fn save
        $user->save();

        return $user;
    }
    // login
    public function login(array $data): array
{
    if (empty($data['email']) || empty($data['password'])) {
        throw new Exception("Champs requis manquants");
    }

    $user = User::findByEmail($data['email']);

    if (!$user) {
        throw new Exception("Email ou mot de passe incorrect");
    }

    if (!password_verify($data['password'], $user['password'])) {
        throw new Exception("Email ou mot de passe incorrect");
    }

    return $user;
}


}
