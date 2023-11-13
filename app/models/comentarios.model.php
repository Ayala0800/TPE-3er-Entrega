<?php

class ComentariosModel extends Model{

    function getComentarios($input, $query_order, $per_page, $start_index, $sorted_by){
        $limit = intval($per_page);
        $offset = intval($start_index);

        $query = $this->db->prepare("SELECT comentarios.*, cervezas.nombre AS cerveza FROM comentarios JOIN cervezas ON comentarios.id_cerveza = cervezas.id_cerveza WHERE cervezas.nombre LIKE ? ORDER BY {$sorted_by} {$query_order} LIMIT {$limit} OFFSET {$offset}");
        $query->execute(["%$input%"]);
        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    function getComentarioById($id){
        /*$sentence = $this->db->prepare("SELECT comentarios.*, cervezas.nombre AS cerveza
        FROM comentarios
        JOIN cervezas ON comentarios.id_cerveza = cervezas.id_cerveza
        WHERE id_comentario=?");*/
        $query = $this->db->prepare('SELECT comentarios.*, cervezas.nombre AS cerveza
        FROM comentarios
        JOIN cervezas ON comentarios.id_cerveza = cervezas.id_cerveza
        WHERE id_comentario=?');
        $query->execute([$id]);
        $comentario = $query->fetch(PDO::FETCH_OBJ);
        return $comentario;
    }

    function deleteComentario($id_comentario){
        $sentence = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario=?");
        $sentence->execute(array($id_comentario));
        return $sentence->rowCount();
    }

    function addComentario($detalle, $id_cerveza){
        $sentence = $this->db->prepare("INSERT INTO comentarios(detalle,id_cerveza) VALUES(?,?)");
        $sentence->execute(array($detalle, $id_cerveza));
        return $this->db->lastInsertId();
    }

    function updateComentario($detalle, $id_cerveza, $id){
        $sentence = $this->db->prepare('UPDATE comentarios SET detalle = ?, id_cerveza = ? WHERE id_comentario = ?');
        $sentence->execute([$detalle, $id_cerveza, $id]);
    }

}