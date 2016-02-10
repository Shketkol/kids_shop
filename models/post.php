<?php
class Post extends Model {
    public function getList(){
        $sql = "select * from posts where 1 ";
        return $this->db->query($sql);
    }
    public function getPost($data){
        $name = array_shift($data);
        $sql = "select * from posts where name = '{$name}' ";
        return $this->db->query($sql);
    }
}