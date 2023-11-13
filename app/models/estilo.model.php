<?php
require_once 'app/models/model.php';
require_once 'config.php';
class EstiloModel extends Model{

    function getEstilos(){
        $sentence = $this->db->prepare("SELECT * FROM estilos");
        $sentence->execute();
        $estilos = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $estilos;
    }

    function getEstilo($id_estilo){
        $sentence = $this->db->prepare( "SELECT * FROM estilos WHERE id_estilo=?");
        $sentence->execute(array($id_estilo));
        $estilo = $sentence->fetch(PDO::FETCH_OBJ);
        return $estilo;
    }

    function addEstilo($nombre){
        $sentence = $this->db->prepare("INSERT INTO estilos(nombre) VALUES (?)");
        $sentence->execute(array($nombre));
        return $this->db->lastInsertId();
    }

    function updateEstilo($nombre, $id){
        $sentence = $this->db->prepare("UPDATE estilos SET nombre = ? WHERE id_estilo = ?");
        $sentence->execute([$nombre, $id]);
    }

    //ELIMINA EL ESTILO DE CERVEZA JUNTO CON LA/LAS CERVEZA/S CORRESPONDIENTES, POR DECISIÓN LA CLAVE FORÁNEA ESTA CONFIGURADA CON "ON DELETE CASCADE"
    function deleteEstilo($id){
        $sentence = $this->db->prepare("DELETE FROM estilos WHERE id_estilo = ?");
        $sentence->execute([$id]);
    }

}
