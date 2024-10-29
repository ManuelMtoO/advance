<?php 
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="archivo.pdf"');
session_start(); 

if(isset($_SESSION['xcia']) && $_SESSION['xcia']){
    $xcia = $_SESSION['xcia'];
    define('CIA',$xcia);
}

//print_r("888".$_SESSION['xcia']); 


require_once('../lib/dbdbf.class.php');
require_once('../modelPdf/m_visitas.php');
// Incluir el archivo de conexión
//include '../connectDB/connect.php'; 

function updateReg($dba,$idReg){
    $table="reg_cli_event";
    $sql = "UPDATE $table SET enviado=1 WHERE id=$idReg
            ";
   $stmt = $dba->prepare($sql);
    
   if ($stmt->execute()) {
       //$ult_id = $dba->getLastInsertId();
       echo json_encode(['status' => 'success', 'message' => 'Registro actualizado']);
   } else {
       echo json_encode(['status' => 'error', 'message' => 'Error mysql: ' . $stmt->error]);
   }
}

function getData($dba) {
    $sql = "SELECT a.id,a.razon_social 'Razón Social', a.ruc 'RUC', a.contacto 'Nombre', a.nro_contacto 'Telefono', a.correo 'Correo', a.tip_even, a.coment, 
                b.nomven 'Vendedor', b.celular 'Celular', b.correo 'Correo Vendedor', b.cia 'Empresa'
            FROM reg_cli_event a
            INNER JOIN vendedores b ON a.vendedor=b.cod
            WHERE a.enviado IS NULL OR a.enviado='' OR a.enviado=0 
            ";
            
    $rpt = $dba->rptArray($sql);
    //echo '<pre>';print_r($rpt);echo '</pre>';die;
    if($rpt != null){
        //header('Content-Type: application/json');
        //$return=json_encode($return); 
        return $rpt;
    }else{
        echo "no hay registros"; die;
    }
}

function reg_cli($dba) {
    $razon_social = $_POST['rs'];
    $ruc = $_POST['ruc'];
    $contacto = $_POST['nombre'];
    $nro_contacto = $_POST['telefono'];
    $correo = $_POST['correo'];
    $cia = $_POST['cia'];
    $tip_even = $_POST['tip_even'];
    $vendedor = $_POST['cod_ven'];
    $coment = $_POST['coment'];
    // Consulta para insertar los datos
    $sql = "INSERT INTO reg_cli_event (razon_social,ruc,contacto,nro_contacto,correo,vendedor,cia,tip_even,fecha,coment) 
            VALUES ('$razon_social','$ruc','$contacto','$nro_contacto','$correo','$vendedor','$cia','$tip_even',NOW(),'$coment')";
    //echo '<pre>';print_r($sql);echo '</pre>';die;
    $stmt = $dba->prepare($sql);
    
    if ($stmt->execute()) {
        $ult_id = $dba->getLastInsertId();
        echo json_encode(['status' => 'success', 'message' => 'Visita registrada exitosamente', 'ult_id' => $ult_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar la visita: ' . $stmt->error]);
    }

    $stmt->close();
}
function reg_visit($dba) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $direccion = str_replace(",","-",$_POST['direccion']);
    $provincia = str_replace(",","-",$_POST['provincia']);
    $distrito = str_replace(",","-",$_POST['distrito']);
    $observacion = $_POST['observacion'];
    $contacto = $_POST['contacto'];
    $nro_contacto = $_POST['nro_contacto'];
    $cia = $_POST['cia'];
    $vendedor = $_POST['vendedor'];
    $ruc = $_POST['ruc_cli'];
    $motivo = $_POST['motivo'];

    // Consulta para insertar los datos
    $sql = "INSERT INTO visitas (ruc,fec_reg,fec_visit,hora_visit,nomper,direccion,provincia,distrito,descrip,contacto,nroconta,cia,vendedor,motivo) 
            VALUES ('$ruc','$fecha','$fecha','$hora','$nombre_cliente','$direccion','$provincia','$distrito','$observacion','$contacto',$nro_contacto,'$cia','$vendedor','$motivo')";
    
    $stmt = $dba->prepare($sql);
    
    if ($stmt->execute()) {
        $ult_id = $dba->getLastInsertId();
        echo json_encode(['status' => 'success', 'message' => 'Visita registrada exitosamente', 'ult_id' => $ult_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar la visita: ' . $stmt->error]);
    }

    $stmt->close();
}

function get_data_id($ult_id, $dba) {
    $sql = "SELECT a.ruc,a.nomper,b.nomven 'vendedor',c.motivo,a.fec_visit,a.hora_visit,a.distrito,a.direccion,a.contacto,a.descrip,a.cia 
            FROM visitas a
            INNER JOIN vendedores b ON a.vendedor=b.cod AND a.cia=b.cia
            INNER JOIN motivo_vis c ON a.motivo=c.id AND a.cia=c.cia
            WHERE a.id='$ult_id'";
    $rpt = $dba->rptArray($sql);
    //echo '<pre>';print_r($rpt);echo '</pre>';die;
    if ($rpt) {
        $pdf = new modelPdf();
        $pdfContent = $pdf->visit($rpt);

        // Enviar el PDF al cliente
        //header('Content-Type: application/pdf');
        //header('Content-Disposition: attachment; filename="visita_'.$rpt[0]['nomper'].'_'.$rpt[0]['fec_reg'].'.pdf"');
        echo $pdfContent;
    }
    //$dba->close();
}

function getCli($term) {
    //print_r(333);
    
    $db = new Db();
    $tabla = 'PRO200';
    $term = strtoupper($term);
    $sql = "select Ruc_prv,Raz_prv ";
    $sql .= "from ".$tabla." WHERE Raz_prv LIKE '%$term%'";
    //print_r($sql);die;
    $return = $db->exe_sql($sql,4);
    if($return != null){
        header('Content-Type: application/json');
        $return=json_encode($return); 
        return $return;
    }else{
        echo 'no hay';
    }
}
function getProvincia() {
    
    $db = new Db();
    $tabla = 'Ubigeo';
    //$term = strtoupper($term);
    $sql = "select Nombprov ";
    $sql .= "from ".$tabla." GROUP BY Nombprov";
    $return = $db->exe_sql($sql,4);
    if($return != null){
        foreach ($return as $key) {
            foreach ($key as $val) {
                $value[]= trim($val);
            }
        }
        //echo '<pre>';print_r($value);echo '</pre>';die;
        $xreturn=json_encode($value); 
        print_r($xreturn);
        return $xreturn;
    }else{
        echo 'no hay';
    }
}
function getDist($prov) {
    
    $db = new Db();
    $tabla = 'Ubigeo';
    $sql = "select Nombdist ";
    $sql .= "from ".$tabla." where Nombprov='$prov' GROUP BY Nombdist";
    $return = $db->exe_sql($sql,4);
    if($return != null){
        foreach ($return as $key) {
            foreach ($key as $val) {
                $value[]= trim($val);
            }
        }
        //echo '<pre>';print_r($value);echo '</pre>';die;
        $xreturn=json_encode($value); 
        print_r($xreturn);
        return $return;
    }else{
        echo 'no hay';
    }
}
function getVendedor($dba) {
    $db = new Db();
    $tabla = 'Fp200';
    $sql = "select Cod_usu,Usuario,Correo,Celular,Cargo ";
    $sql .= "from ".$tabla." where Usercomun!='1' ";
    $sql .= 'and Vendedor=.T. and Noactive!=.T.';
    //print_r($sql);die;
    $return = $db->exe_sql($sql,4);
    if($return != null){
        update_table('vendedores',$return,$dba);
        header('Content-Type: application/json');
        
        $return=json_encode($return); 
        
        //$return=str_replace(' ', '', $return); 
        //echo '<pre>';print_r($return);echo '</pre>';die;
        return $return;
    }else{
        echo 'no hay';
    }
}
function update_table($table_name,$array,$dba) {
    $cia = $_SESSION['xcia'];
    //print_r($cia);die;
    $sql = "DELETE FROM $table_name WHERE cia='$cia'";
    $stmt = $dba->prepare($sql);
    if ($stmt->execute()) {
        foreach ($array as $key => $val) {
            $cod_usu=$val['cod_usu'];
            $usuario=$val['usuario'];
            $correo=$val['correo'];
            $celular=str_replace(' ','',$val['celular']);
            $cargo=$val['cargo'];
            $sql = "INSERT INTO $table_name (cod,nomven,correo,celular,cargo,cia) 
                    VALUES ('$cod_usu','$usuario','$correo','$celular','$cargo','$cia')";

            $stmt = $dba->prepare($sql);
            $stmt->execute();
                
        }
        
    } else {
        
    }
}
function getMotivo($dba) {
    $cia = $_SESSION['xcia'];
    try {
        $dba = new Database();
        $sql = "SELECT * FROM motivo_vis WHERE cia='$cia'";
    
        // Ejecutar la consulta y obtener todos los resultados
        $rpt = $dba->rptArray($sql);
        // Convertir los resultados a UTF-8
        array_walk_recursive($rpt, function(&$item, $key) {
            if (is_string($item)) {
                $item = utf8_encode($item);
            }
        });
        //header('Content-Type: application/json');
        if ($rpt) {
            echo json_encode(['status' => 'success', 'data' => $rpt]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se encontraron resultados']);
        }
        //$dba->__destruct();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    
}
?>
