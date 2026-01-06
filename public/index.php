<?php 
include "../vendor/autoload.php";
include "../App/Database/DatabaseConnection.php";
include "../App/Models/Abstractclass/Utilisateur.php";
// include "../App/Models/BaseModel.php";
// include "../App/Models/Entity/Admin.php";
use App\Models\Entity\Admin;

$admin = new Admin("Ali", "Benali", "ali@example.com", "123456", "ADMIN");

// var_dump($admin);


?>