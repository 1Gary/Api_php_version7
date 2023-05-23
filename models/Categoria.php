<?php

 class Categoria extends Conectar{

    public function get_Categoria()
    {
        $conectar= parent::conexion();
        $sql="SELECT * FROM categoria where est=1";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 

    public function insert_Categoria($cat_nom,$cat_obs)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO categoria(cat_nom,cat_obs,est) VALUES (?,?,'1');";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$cat_nom);
        $sql->bindValue(2,$cat_obs);
        $sql->execute();
        die();
        /*return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);*/

        
    }

    public function get_cat_x_id($idcat)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM categoria where cat_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idcat);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 
 
    public function update_Categoria($cat_id,$cat_nom,$cat_obs)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE categoria set cat_nom =?, cat_obs = ? where cat_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$cat_nom);
        $sql->bindValue(2,$cat_obs);
        $sql->bindValue(3,$cat_id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 

    public function delete_Categoria($cat_id)
    {
        $conectar= parent::conexion();
        $sql="DELETE FROM categoria WHERE cat_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$cat_id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
 

 }

?>