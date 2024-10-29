<?php 
// Incluir el archivo de conexión
include '../connectDB/connect.php';
// Incluir el archivo de funciones
include '../model/model.php';
//include '../connectDB/connect.php';
// Crear instancia de la base de datos
$db = new Database();
// Obtener la acción desde la solicitud
$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : ''; 
//$cia = isset($_GET['cia']) ? $_GET['cia'] : '';


switch ($accion) {
    case 'reg_visit':
        $return=reg_visit($db);
        //echo $return;
        break;
    case 'reg_cli':
        $return=reg_cli($db);
        //echo $return;
        break;
    case 'getCli':
        $term = $_GET['term'];
        $return=getCli($term);
        //echo $return;
        echo $return;
        break;
    case 'getProvincia':
        //$term = $_GET['term'];
        $return=getProvincia();
        //echo $return;
        break;
    case 'getDist':
        $prov = $_GET['prov'];
        $return=getDist($prov);
        //echo $return;
        break;
    case 'getVendedor':
        //$cia = $_GET['cia'];
        //print_r($cia);die;
        $return=getVendedor($db);
        echo $return;
        break;
    case 'getMotivo':
        //$cia = $_GET['cia'];
        //print_r($cia);die;
        $return=getMotivo($db);
        echo $return;
        break;
    case 'gen_pdf':
        $ult_id = $_GET['ult_id'];
        //print_r($ult_id);die;
        $return=get_data_id($ult_id, $db);
        echo $return;
        break;
    case 'getCia':
        //print_r($ult_id);die;
        $return=getCia($db);
        echo $return;
        break;
    case 'regUser':
        //print_r($ult_id);die;
        $return=regUser($db);
        echo $return;
        break;
    case 'validlogin':
        //print_r($ult_id);die;
        $return=validlogin($db);
        echo $return;
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        break;
}
//$db->__destruct();

// Otra función de ejemplo
function otraFuncion($conn) {
    $campo1 = $_POST['campo1'];
    // Procesa los datos de otra función aquí

    echo json_encode(['status' => 'success', 'message' => 'Otra función ejecutada exitosamente']);
}
?>
