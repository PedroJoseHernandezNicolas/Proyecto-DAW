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

// Obtener el método de la solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Manejar las diferentes operaciones según el método de la solicitud
switch ($method) {
    case 'POST':
        // Crear un nuevo usuario
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData)) {
            // Los datos de la solicitud están vacíos
            $response = array(
                'result' => 'error',
                'details' => 'Datos de solicitud vacíos'
            );
            Response::result(400, $response);
        }

        // Intentar crear el usuario
        $userId = $database->createUser($requestData);

        if ($userId) {
            // Usuario creado con éxito
            $response = array(
                'result' => 'ok',
                'userId' => $userId,
                'message' => 'Usuario creado correctamente'
            );
            Response::result(201, $response);
        } else {
            // Error al crear el usuario
            $response = array(
                'result' => 'error',
                'details' => 'Error al crear el usuario'
            );
            Response::result(500, $response);
        }
        break;

    case 'DELETE':
        // Eliminar un usuario existente
        $userId = isset($_GET['id']) ? $_GET['id'] : null;

        if (empty($userId)) {
            // No se proporcionó el ID de usuario
            $response = array(
                'result' => 'error',
                'details' => 'ID de usuario no proporcionado'
            );
            Response::result(400, $response);
        }

        // Intentar eliminar el usuario
        $deleted = $database->deleteUser($userId);

        if ($deleted) {
            // Usuario eliminado con éxito
            $response = array(
                'result' => 'ok',
                'message' => 'Usuario eliminado correctamente'
            );
            Response::result(200, $response);
        } else {
            // Error al eliminar el usuario
            $response = array(
                'result' => 'error',
                'details' => 'Error al eliminar el usuario'
            );
            Response::result(500, $response);
        }
        break;

    default:
        // Método no permitido
        $response = array(
            'result' => 'error',
            'details' => 'Método no permitido'
        );
        Response::result(405, $response);
        break;
}
?>
