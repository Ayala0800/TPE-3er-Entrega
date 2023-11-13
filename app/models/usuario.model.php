<?php
require_once 'config.php';
require_once 'app/models/model.php';

class UserModel extends Model{

    public function getUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}