<?php
require_once 'app/models/model.php';
require_once 'config.php';
class BeerModel extends Model{

    //DEVUELVE TODOS LOS cervezas AGREGANDO LA COLUMNA DEL NOMBRE DE LA CATEGORIA A LA QUE PERTENECE
    function getCervezas($parametros = []){

        $sort = isset($parametros['sort']) ? $parametros['sort'] : 'id_cerveza';
        $order = isset($parametros['order']) ? strtoupper($parametros['order']) : 'ASC';
    
        $validColumns = ['id_cerveza', 'nombre', 'IBU', 'ALC', 'id_estilo', 'stock', 'estilo'];
        if(!in_array($sort, $validColumns)){
            $sort = 'id_cerveza';
        }

        $sentence = $this->db->prepare(
            "SELECT cervezas.*, estilos.nombre AS estilo
            FROM cervezas
            JOIN estilos ON cervezas.id_estilo = estilos.id_estilo ORDER BY $sort $order");
        $sentence->execute();
        $cervezas = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }

   
    //DEVUELVE EL PORDUCTO CON EL ID PASADO POR PARAMETRO
    function getCerveza($id_cerveza){
        $sentence = $this->db->prepare(
            "SELECT cervezas.*, estilos.nombre AS estilo
            FROM cervezas
            JOIN estilos ON cervezas.id_estilo = estilos.id_estilo
            WHERE id_cerveza=?");
        $sentence->execute(array($id_cerveza));
        $cerveza = $sentence->fetch(PDO::FETCH_OBJ);
        return $cerveza;
    }

    //DEVUELVE LOS cervezaS PERTENECIENTES A LA CATEGORIA PASADA POR PARAMETRO
    function getCervezasEstilo($id_estilo){
        $sentence = $this->db->prepare(
            "SELECT cervezas.*, estilos.nombre AS estilo
            FROM cervezas
            JOIN estilos ON cervezas.id_estilo = estilos.id_estilo
            WHERE estilos.id_estilo=?");
        $sentence->execute(array($id_estilo));
        $cervezas = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }

    //AÑADE UNA CERVEZA A LA DB
    function addCervezaToDB($nombre, $ibu, $alc, $id_estilo, $stock, $descripcion){
        $sentence = $this->db->prepare("INSERT INTO cervezas(nombre, IBU, ALC, id_estilo, stock, descripcion) VALUES(?,?,?,?,?,?)");
        $sentence->execute([$nombre, $ibu, $alc, $id_estilo, $stock, $descripcion]);
        return $this->db-> lastInsertId();
    }

    //ACTUALIZA LOS DATOS DE UNA CERVEZA
    function updateCerveza($nombre, $ibu, $alc, $id_estilo, $stock, $descripcion, $id){
        $query = $this->db->prepare("UPDATE cervezas SET nombre = ?, IBU = ?, ALC = ?, id_estilo = ?, stock = ?, descripcion = ? WHERE id_cerveza= ? ");
        $query->execute([$nombre, $ibu, $alc, $id_estilo, $stock, $descripcion, $id]);
    }

    //ELIMINA una cerveza segun id
    function deleteCervezaFromDB($id){
        $sentence = $this->db->prepare("DELETE FROM `cervezas` WHERE id_cerveza=?");
        $sentence->execute([$id]);
    }
}