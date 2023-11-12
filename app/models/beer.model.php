<?php
require_once 'app/models/model.php';
require_once 'config.php';
class BeerModel extends Model{

    //DEVUELVE TODOS LAS CERVEZAS AGREGANDO LA COLUMNA DEL NOMBRE DE LA CATEGORIA A LA QUE PERTENECE
    function getCervezas($order, $field, $filterBy, $filterValue, $limit, $offset){
        $sql = "SELECT cervezas.*, estilos.nombre AS estilo 
        FROM cervezas
        JOIN estilos 
        ON cervezas.id_estilo = estilos.id_estilo";

        switch($filterBy){
            case 'IBU': $sql .= ' WHERE IBU = ' . '\''. $filterValue.'\'';
                break;
            case 'ALC': $sql .= ' WHERE ALC = ' . '\''. $filterValue.'\'';
                break;
            default: $sql .= ' ';
                break;
        }
        switch($order){
            case 'ASC': $sql .= ' ORDER BY ' . $field . ' ASC';
                break;
            case 'DESC': $sql .= ' ORDER BY ' . $field . ' DESC';
                break;
            default: $sql .= ' ORDER BY id_cerveza ASC';
                break;
        }
        if($limit != 'null'){
            $sql .= ' LIMIT ' . $limit;
        }
        if($offset != 'null'){
            $sql .= ' OFFSET ' . $offset;
        }
        $sentence = $this->db->prepare($sql);
        $sentence->execute();
        return $sentencey->fetchAll(PDO::FETCH_OBJ);
    }
   
    //DEVUELVE LA CERVEZA CON EL ID PASADO POR PARAMETRO
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

    //DEVUELVE LAS CERVEZAS PERTENECIENTES A LA CATEGORIA PASADA POR PARAMETRO
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
