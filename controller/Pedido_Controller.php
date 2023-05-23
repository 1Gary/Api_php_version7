<?php
 header('Content-Type: aplication/json');

 require_once("../config/conexion.php");
 require_once("../models/Categoria.php");

 require_once("../models/Pedido.php");

 $pedido = new Pedido();

 $body = json_decode(file_get_contents("php://input"), true);

 switch($_GET["op"]){

    case "GetAll":
        $datos=$pedido->get_pedido();
        $arr = array ("resultado" =>"ok","lista" => $datos);
        echo json_encode($arr);

    break;


    case "GetPedidos":
        $datos=$pedido->get_pedido_total();
        $arr = array ("resultado" =>"ok","lista" => $datos);     
        echo json_encode($arr);
        
    break;

    case "GetPedidosTodos":
       
       $pedidos = $pedido->get_pedido();   
       foreach($pedidos as $value)
       {
        $detalle = $pedido->get_pedido_id_detalle($value["id_pedido"]);
        $entrega = $pedido->get_pedido_id_entrega($value["id_pedido"]);
        
            $arr[] = [
                "pedido" => $value["id_pedido"],
                "cliente" => $value["nombre_cliente"],
                "total" => $value["monto_total"],
                "detalle" => $detalle,
                "entrega" =>$entrega
            
            ];
       
       }
       
     echo json_encode($arr);
     
    break;
  
        case "Pedido":
            $pedido_id=$pedido->insert_pedido(
            $body["nombre_cliente"],
            $body["monto_total"]);
            $detalle = $body["detalle"]; // Detalle del Pedido
            $fecha_entrega = $body["fechaentrega"]; 

            if($detalle !=null )  
            {
                foreach($detalle as $value)
                {                                    
                    $codigo_producto = $value['codigo_producto'];                   
                    $nombre_producto = $value['nombre_producto'];         
                    $precio_producto =$value['precio_producto']; 
                    $pedido_id=$pedido->insert_detalle_pedido($codigo_producto,$nombre_producto,$precio_producto,$pedido_id);                                  
                } 
                $arr = array ("resultado"=>"se guardo pedido");
                echo json_encode($arr);                
            }
            else
            {
                $arr = array ("resultado"=>"error");
                echo json_encode($arr);    
            }
     
            if($fecha_entrega !=null)
            {
                foreach($fecha_entrega as $entrega)
                {                                    
                    $fecha = $entrega['fecha'];                
                    $monto = $entrega['monto'];       
                    $pedido_id=$pedido->insert_fecha($fecha,$pedido_id,$monto);                                  
                } 
                $arr = array ("resultado"=>"se guardo la fecha");
                echo json_encode($arr);                
            }
            else
            {
                $arr = array ("resultado"=>"error al guadar fecha");
                echo json_encode($arr);    
            }
     
            break;  



    case "Update":
            $datos=$pedido->update_pedido($body["id_pedido"],$body["nombre_cliente"],$body["monto_total"]);
            echo json_encode("Update Correcto");
            break;

    case "Delete":
                $datos=$pedido->delete_pedido($body["id_pedido"]);
                echo json_encode("Delete Correcto");
            break;
 }

?>