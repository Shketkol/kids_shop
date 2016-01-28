<?php

class Page extends Model{

    public function getList(){
        $sql = "select * from tovary where 1 ";
        return $this->db->query($sql);
    }
}