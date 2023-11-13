<?php
require_once 'app/models/model.php';
require_once 'config.php';
class BeerModel extends Model{

    public function getCervezas($input, $query_order, $per_page, $start_index, $sorted_by)
    {
        $limit = intval($per_page);
        $offset = intval($start_index);

        $query = $this->db->prepare("SELECT Cervezas.*, estilos.nombre AS estilo FROM cervezas JOIN estilos ON cervezas.id_estilo = estilos.id_estilo WHERE cervezas.nombre LIKE ? ORDER BY {$sorted_by} {$query_order} LIMIT {$limit} OFFSET {$offset}");
        $query->execute(["%$input%"]);
        $cervezas = $query->fetchAll(PDO::FETCH_OBJ);
        return $cervezas;
    }

    public function getCervezaById($id)
    {
        $query = $this->db->prepare('SELECT cervezas.*, estilos.nombre AS estilo
        FROM cervezas
        JOIN estilos ON cervezas.id_estilo = estilos.id_estilo
        WHERE id_cerveza=?');
        $query->execute([$id]);
        $cerveza = $query->fetch(PDO::FETCH_OBJ);
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

    //ELIMINA LA CERVEZA JUNTO CON LOS COMENTARIOS CORRESPONDIENTES, POR DECISIÓN LA CLAVE FORÁNEA ESTA CONFIGURADA CON "ON DELETE CASCADE"
    function deleteCervezaFromDB($id){
        $sentence = $this->db->prepare("DELETE FROM `cervezas` WHERE id_cerveza=?");
        $sentence->execute([$id]);
    }
}
