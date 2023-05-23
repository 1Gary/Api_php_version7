<?php

 class Pedido extends Conectar{
    public function get_pedido()
    {
        $conectar= parent::conexion();
        $sql="SELECT * FROM pedido ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pedido_total()
    {
        $conectar= parent::conexion();
        $sql="SELECT p.id_pedido,p.nombre_cliente,p.monto_total,d.id_detalle,d.codigo_producto,d.nombre_producto, d.precio_producto, e.id_entrega,e.fecha,e.monto FROM pedido as p INNER JOIN detalle_pedido as d on p.id_pedido=d.id_pedido INNER JOIN entrega as e on p.id_pedido=e.id_pedido  ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /*public function get_pedido_id()
    {
        $conectar= parent::conexion();
        $sql="SELECT p.id_pedido,p.nombre_cliente,p.monto_total,d.id_detalle,d.codigo_producto,d.nombre_producto, d.precio_producto, e.id_entrega,e.fecha,e.monto FROM pedido as p INNER JOIN detalle_pedido as d on p.id_pedido=d.id_pedido INNER JOIN entrega as e on p.id_pedido=e.id_pedido WHERE p.id_pedido=24  ";
    
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function get_pedido_id($id_pedido)
    {
        $conectar= parent::conexion();
        $sql="SELECT * FROM pedido WHERE id_pedido=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_pedido);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pedido_id_detalle($id_pedido)
    {
        $conectar= parent::conexion();
        $sql="SELECT * FROM detalle_pedido WHERE id_pedido=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_pedido);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pedido_id_entrega($id_pedido)
    {
        $conectar= parent::conexion();
        $sql="SELECT * FROM entrega WHERE id_pedido=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_pedido);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


 
   public function insert_pedido($nombre_cliente,$monto_total)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO pedido(nombre_cliente,monto_total) VALUES (?,? );";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombre_cliente);
        $sql->bindValue(2,$monto_total);
        $sql->execute();
        $id_pedido = $conectar->lastInsertId();   
        return $id_pedido;
       // return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_detalle_pedido($codigo_producto,$nombre_producto,$precio_producto,$id_pedido){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO detalle_pedido(codigo_producto,nombre_producto,precio_producto,id_pedido) VALUES (?,?,?,?); ";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $codigo_producto);    
        $sql->bindValue(2, $nombre_producto);     
        $sql->bindValue(3, $precio_producto);   
        $sql->bindValue(4, $id_pedido);       
        $sql->execute();
        return $id_pedido;
         
    }

    public function insert_fecha($fecha, $id_pedido,$monto){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO entrega(fecha, id_pedido, monto) VALUES (?,?,?); ";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $fecha);    
        $sql->bindValue(2, $id_pedido); 
        $sql->bindValue(3, $monto); 
        $sql->execute();
        return $id_pedido;
         
    }

    /*public function update_Pedido($id_pedido,$nombre_cliente,$monto_total)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE pedido set nombre_cliente =?, monto_total = ? where id_pedido = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$nombre_cliente);
        $sql->bindValue(2,$monto_total);
        $sql->bindValue(3,$id_pedido);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function delete_Pedido($id_pedido)
    {
        $conectar= parent::conexion();
        $sql="DELETE FROM pedido WHERE id_pedido = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_pedido);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }*/


    /*SELECT p.id_pedido,p.nombre_cliente,p.monto_total,d.id_detalle,d.codigo_producto,d.nombre_producto, d.precio_producto, e.id_entrega,e.fecha,e.monto FROM pedido as p INNER JOIN detalle_pedido as d on p.id_pedido=d.id_pedido INNER JOIN entrega as e on p.id_pedido=e.id_pedido WHERE p.id_pedido=24;*/

 

 }

?>