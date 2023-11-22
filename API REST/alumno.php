<?php
/**
 *	Script que se usa en los endpoints para trabajar con registros de la tabla PLAYER
 *	La clase "player.class.php" es la clase del modelo, que representa a un jugador de la tabla
*/
require_once 'src/response.php';
require_once 'src/classes/alumno.class.php';
require_once 'src/classes/login.class.php';

$auth = new Authentication();
$auth->verify();

$user = new Alumno();

/**
 * Se mira el tipo de petición que ha llegado a la API y dependiendo de ello se realiza una u otra accción
 */
switch ($_SERVER['REQUEST_METHOD']) {
	/**
	 * Si se ha recibido un GET se llama al método get() del modelo y se le pasan los parámetros recibidos por GET en la petición
	 */
	case 'GET':
		$params = $_GET;

		$usuarios = $user->get($params);

		$response = array(
			'result' => 'ok',
			'alumnos' => $usuarios
		);

		Response::result(200, $response);

		break;
		
	/**
	 * Para cualquier otro tipo de petición se devuelve un mensaje de error 404.
	 */
	default:
		$response = array(
			'result' => 'error'
		);

		Response::result(404, $response);

		break;
}
?>