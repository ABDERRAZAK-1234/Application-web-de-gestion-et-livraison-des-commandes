<?php 
include "../vendor/autoload.php";
include "../App/Database/DatabaseConnection.php";
use App\Models\Abstractclass\Utilisateur;
use App\Models\Entity\Admin;
use App\Models\Entity\Client;
use App\Models\Entity\Livreur;
use App\Models\BaseModel;

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
// }
$adminData = Admin::find(6
);
if (!$adminData) {
    echo "Admin ma kaynch";
    exit;
}

$admin = new Admin(
    $adminData['nom'],
    $adminData['prenom'],
    $adminData['email'],
    $adminData['password']
);


$admin->set('id', $adminData['id']);

// delete
$admin->delete();

echo "Admin supprimé (soft delete)";


// fetch again to confirm update
// $updated = Admin::find(1);
// var_dump($updated);

?>