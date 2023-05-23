<?php
 header('Content-Type: aplication/json');

 require_once("../config/conexion.php");
 require_once("../models/Categoria.php");

 require_once("../models/Pedido.php");
 require_once("../models/Detallepedido.php");

 $detallepedido = new Detallepedido();

 $body = json_decode(file_get_contents("php://input"), true);

 switch($_GET["op"]){

    case "GetAll":
        $datos=$detallepedido->get_detallepedido();
        $arr = array ("resultado" =>"ok","lista" => $datos);
        echo json_encode($arr);

    break;

    case "Insert":
        $datos=$detalle_pedido->insert_detallepedido($body["codigo_producto"],$body["nombre_producto"],$body["precio_producto"]);
        echo json_encode("Insert Correcto");
        break;

    case "Update":
            $datos=$detalle_pedido->update_detalle_pedido($body["id_detalle"],$body["codigo_producto"],$body["precio_producto"]);
            echo json_encode("Update Correcto");
            break;

    case "Delete":
                $datos=$detalle_pedido->delete_detalle_pedido($body["id_detalle"]);
                echo json_encode("Delete Correcto");
            break;
 }

?>