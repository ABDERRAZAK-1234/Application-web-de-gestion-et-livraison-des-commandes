<?php
session_start();
require_once "../vendor/autoload.php";

use App\Services\AuthService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $authService = new AuthService();

    try {
        $user = $authService->login($_POST);

        $_SESSION['user'] = [
            'id'    => $user['id'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ];

        header("Location: ../views/dashboard-" . $user['role'] . ".php");
        exit;

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
