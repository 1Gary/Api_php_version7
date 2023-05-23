<?php
 header('Content-Type: aplication/json');
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Headers: *");
 
 
 require_once("../config/conexion.php");
 require_once("../models/Categoria.php");
 $categoria = new Categoria();

 $body = json_decode(file_get_contents("php://input"), true);



 switch($_GET["op"]){

    case "GetAll":
        $datos=$categoria->get_Categoria();
        echo json_encode($datos);

    break;
    case "GetxId":
        $datos2=$categoria->get_cat_x_id($body["cat_id"]);
        echo json_encode($datos2);

    break;

    case "Insert":
        if (empty($body)) {
            return [];
        }else{
          $datos=$categoria->insert_categoria($body["cat_nom"],$body["cat_obs"]);
          echo json_encode("Insert Correcto");
        }
        break;

    case "Update":
            $datos=$categoria->update_categoria($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Update Correcto");
            break;

    case "Delete":
                $datos=$categoria->delete_categoria($body["cat_id"]);
                echo json_encode("Delete Correcto");
            break;
 }

?>