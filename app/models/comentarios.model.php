<?php

class ComentariosModel extends Model{

    function getComentarios($parametros = []){
        $sort = isset($parametros['sort']) ? $parametros['sort'] : 'id_comentario'; //valor x default
        $order = isset($parametros['order']) ? strtoupper($parametros['order']) : 'ASC'; //valor x default

        $validColumns = ['id_comentario', 'descripcion', 'id_cerveza'];
        if(!in_array($sort, $validColumns)){
            $sort = 'id_comentario';
        }

        $sentence = $this->db->prepare(
            "SELECT comentarios.*, cervezas.nombre AS cerveza
            FROM comentarios
            JOIN cervezas ON comentarios.id_cerveza = cervezas.id_cerveza ORDER BY $sort $order");
        $sentence->execute();
        $comentarios = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    function getComentario($id_comentario){
        $sentence = $this->db->prepare(
            "SELECT comentarios.*, cervezas.nombre AS cerveza
            FROM comentarios
            JOIN cervezas ON comentarios.id_cerveza = cerveza.id_cerveza
            WHERE id_comentario=?");
        $sentence->execute(array($id_comentario));
        $comentario = $sentence->fetch(PDO::FETCH_OBJ);
        return $comentario;
    }

    function deleteComentario($id_comentario){
        $sentence = $this->db->prepare("DELETE FROM `comentarios` WHERE id_comentario=?");
        $sentence->execute([$id_comentario]);
    }

    function addComentario($descripcion, $id_cerveza){
        $sentence = $this->db->prepare("INSERT INTO comentarios(descripcion,id_cerveza) VALUES(?,?)");
        $sentence->execute([$descripcion, $id_cerveza]);
        return $this->db->lastInsertId();
    }

}
