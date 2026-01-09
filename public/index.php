<?php 
include "../vendor/autoload.php";
// include "../App/Database/DatabaseConnection.php";
use App\Database\DatabaseConnection;
use App\Models\Abstractclass\Utilisateur;
use App\Models\Entity\Admin;
use App\Models\Entity\Client;
use App\Models\Entity\Livreur;
use App\Models\BaseModel;
use App\Models\Entity\Offre;
use App\Enum\Vhecule;

// $admin = new Admin("sertati","mouaad","mouad@example.com","p@ssword2@@4");
// $client = new Client("Oughlane","Mohammed","Mohamed@gmail.com","p@ssword2@@4");
// $livreur = new Livreur("Oumsoud","Said","2024@gmail.com","p@ssword24");

// $admin = new Admin($data);



// if ($adminData) {

//     $admin = new Admin(
//         $adminData['nom'],
//         $adminData['prenom'],
//         $adminData['email'],
//         $adminData['password']
//     );

//     $admin->set('id', $adminData['id']);
//     $admin->set('prenom', 'Mouloud');
//     $admin->set('nom', 'Aamaich');

//     // $admin->save();
// // }

// $livreur = new Livreur(
//     "Oumsoud",
//     "Said",
//     "said@gmail.com",
//     "123456"
// );

// $offre = new Offre(
//     120,
//     '2 heur',
//     Vhecule::Moto,
//     'Livraison rapide',
//     8,
// );

// $offre->save(); 

// echo $offre->getLivreur()->getNom();
// echo "<span> </span>";
// echo $offre->getLivreur()->getPrenom();

$adminData = Admin::find(2);
// echo $adminData;
print_r($adminData);
// fetch again to confirm update
// $updated = Admin::find(1);
// var_dump($updated);

?>