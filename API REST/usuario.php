<?php
/**
 * Script para endpoints que manejan la creación y eliminación de usuarios
 */
require_once 'src/response.php';
require_once 'src/database.php'; // Incluimos la clase Database donde se definen los métodos createUser y deleteUser
require_once 'src/classes/login.class.php';

$database = new Database();

// Verificamos la autenticación del usuario
$authenticated = true; 

if (!$authenticated) {
    $response = array(
        'result' => 'error',
        'details' => 'No autorizado'
    );
    Response::result(401, $response);
}

// Verificamos el tipo de petición recibida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si la petición es un POST, se intenta crear un nuevo usuario
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (empty($requestData)) {
        $response = array(
            'result' => 'error',
            'details' => 'Datos de solicitud vacíos'
        );
        Response::result(404, $response);
    }

    // Se intenta crear el usuario
    $userId = $database->createUser($requestData);

    if ($userId) {
        $response = array(
            'result' => 'ok',
            'userId' => $userId,
            'message' => 'Usuario creado correctamente'
        );
        Response::result(200, $response);
    } else {
        $response = array(
            'result' => 'error',
            'details' => 'Error al crear el usuario'
        );
        Response::result(404, $response);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Si la petición es un DELETE, se intenta eliminar un usuario existente
    $userId = isset($_GET['id']) ? $_GET['id'] : null;

    if (empty($userId)) {
        $response = array(
            'result' => 'error',
            'details' => 'ID de usuario no proporcionado'
        );
        Response::result(404, $response);
    }

    // Se intenta eliminar el usuario
    $deleted = $database->deleteUser($userId);

    if ($deleted) {
        $response = array(
            'result' => 'ok',
            'message' => 'Usuario eliminado correctamente'
        );
        Response::result(200, $response);
    } else {
        $response = array(
            'result' => 'error',
            'details' => 'Error al eliminar el usuario'
        );
        Response::result(404, $response);
    }
} else {
    /**
	 * Para cualquier otro tipo de petición se devuelve un mensaje de error 404.
	 */
    $response = array(
        'result' => 'error',
    );
    Response::result(404, $response);
}
?>
