<?php
    class Categoria extends Conectar{
        
        public function get_Categoria()
        {
            $conectar= parent::conexion();          
            $sql="SELECT * FROM Categoria where est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }  
        public function insert_categoria($cat_nom,$cat_obs){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO Categoria(cat_nom,cat_obs,est) VALUES (?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_obs);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_categoria($cat_id,$cat_nom,$cat_obs){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE Categoria set
                cat_nom = ?,
                cat_obs = ?
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_obs);
            $sql->bindValue(3, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
 
        public function delete_categoria($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE Categoria set
                est = '0'
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_pedido($cliente,$total){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO pedido(cliente,total) VALUES (?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cliente);
            $sql->bindValue(2, $total);               
            $sql->execute();
            $id_pedido = $conectar->lastInsertId();   
            return $id_pedido;
        }
        public function insert_detalle_pedido($pedido_id,$producto,$total){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO detalle_pedido(pedido_id,producto,precio) VALUES (?,?,?); ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pedido_id);
            $sql->bindValue(2, $producto);    
            $sql->bindValue(3, $total);            
            $sql->execute();
            return $pedido_id;
             
        }
    }
?>