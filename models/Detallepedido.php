<?php

 class detallepedido extends Conectar{
    public function get_detallepedido()
    {
        $conectar= parent::conexion();       
        $sql="SELECT * FROM detalle_pedido ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function insert_detallepedido($id_pedido,$codigo_producto,$nombre_producto,$precio_producto)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO detalle_pedido(codigo_producto,nombre_producto,precio_producto) VALUES (?,?,? );";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$codigo_producto);
        $sql->bindValue(2,$nombre_producto);
        $sql->bindValue(3,$precio_producto);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 
 
    public function update_Detalle_pedido($codigo_producto,$nombre_producto,$precio_producto)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE detalle_pedido set codigo_producto =?, nombre_producto = ?,precio_producto = ? where id_detalle = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$codigo_producto);
        $sql->bindValue(2,$nombre_producto);
        $sql->bindValue(3,$precio_producto);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function delete_Detalle_pedido($id_detalle)
    {
        $conectar= parent::conexion();
        $sql="DELETE FROM detalle_pedido WHERE id_detalle = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_detalle);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 

 }

?>