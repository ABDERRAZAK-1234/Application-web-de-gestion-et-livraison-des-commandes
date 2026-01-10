<?php
session_start();
require_once "../vendor/autoload.php";

use App\Services\AuthService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $authService = new AuthService();

    try {
        $user = $authService->signup($_POST);

        $_SESSION['user'] = [
            'email' => $_POST['email'],
            'role' => $_POST['role']
        ];

        header("Location: ../views/dashboard-" . $_POST['role'] . ".php");
        exit;

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
