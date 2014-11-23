<?php
error_reporting(E_ALL);
// Primero incluimos el archivo de configuraci�n
include('conf.php');

/** Verificamos que se haya escogido un modulo, sino
* tomamos el valor por defecto de la configuraci�n.
*/
session_start();
if(isset($_GET['m'])){
	if($_GET['m']=="logout"){
		unset($_SESSION['id_user'], $_SESSION['id_rol'], $_SESSION['id_admin'], $_SESSION['nombre'], $_SESSION['apellido']);
		session_destroy();
	}
}

if (!empty($_GET['m']) && isset($_SESSION['id_user'])){
	$modulo = $_GET['m'];
}elseif(isset($_SESSION['id_user'])){
	$modulo = MODULO_DEFECTO;
}else{
	$modulo = "login";
}

/** Tambi�n debemos verificar que el valor que nos 
* pasaron, corresponde a un modulo que existe, caso
* contrario, cargamos el modulo por defecto
*/
if (empty($conf[$modulo]))
		$modulo = MODULO_DEFECTO;

/** Ahora determinamos que archivo de Layout tendr�
* este m�dulo, si no tiene ninguno asignado, utilizamos
* el que viene por defecto
*/
if (empty($conf[$modulo]['layout']))
		$conf[$modulo]['layout'] = LAYOUT_DEFECTO;
		
/** Aqui podemos colocar todos los comandos necesarios para
* realizar las tareas que se deben repetir en cada recarga
* del index.php - En el ejemplo, conexi�n a la base de datos.
* 
* include('clases/class.DB.php');
* $db = new DB();
* $db->conectar();
*/

/** Finalmente, cargamos el archivo de Layout que a su vez, se
* encargar� de incluir al m�dulo propiamente dicho. si el archivo
* no existiera, cargamos directamente el m�dulo. Tambi�n es un
* buen lugar para incluir Headers y Footers comunes.
*/
$path_layout = LAYOUT_PATH.'/'.$conf[$modulo]['layout'];
$path_modulo = MODULO_PATH.'/'.$conf[$modulo]['archivo'];

if (file_exists($path_layout))
	include( $path_layout );
else
	if (file_exists( $path_modulo ))
	    include( $path_modulo );
	else
		die('Error al cargar el m�dulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
?>