<?php
require_once 'config.php';
class UserModel extends Model{

/*
    function getUserByName($user){
        $sentence = $this->db->prepare("SELECT * FROM usuarios WHERE nombre=?");
        $sentence->execute(array($user));
        $user = $sentence->fetch(PDO::FETCH_OBJ);
        return $user;
    }*/

    public function getUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}