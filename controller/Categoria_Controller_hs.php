<?php
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    $body = json_decode(file_get_contents("php://input"), true);    
        
    switch($_GET["op"]){

        case "GetAll":
          
            $datos=$categoria->get_Categoria();
            $arr = array ("resultado"=>"ok","detalle" => $datos);
            echo json_encode($arr);
            /*
            $datos=$categoria->get_categoria();
            echo json_encode($datos);
            */    
        break;
        case "Insert":
            $datos=$categoria->insert_categoria($body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos=$categoria->update_categoria($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        case "Delete":
            $datos=$categoria->delete_categoria($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;

        case "Pedido":
            $pedido_id=$categoria->insert_pedido(
            $body["cliente"],
            $body["total"]);
            $detalle = $body["detalle"]; // Detalle del Pedido

            if($detalle !=null)
            {
                foreach($detalle as $value)
                {                                    
                    $producto = $value['producto'];                   
                    $total = $value['precio'];                   
                    $pedido_id=$categoria->insert_detalle_pedido($pedido_id,$producto,$total);                                  
                } 
                $arr = array ("resultado"=>"se guardo pedido");
                echo json_encode($arr);                
            }
            else
            {
                $arr = array ("resultado"=>"error");
                echo json_encode($arr);    
            }
     
            break;


    }
?>