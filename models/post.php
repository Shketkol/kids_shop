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


    public function getListPost(){
        $sql = "select *
                from posts WHERE 1";
        return $this->db->query($sql);
    }
    public function addNewPost($data)
    {
        $name = $this->db->escape($data['name']);
        $desc = $this->db->escape($data['desc']);
        $body = $this->db->escape($data['body']);
        $url_img = $this->db->escape($data['url_img']);
        $time = date("Y.m.d G:i:s", time());
        $sql = "insert into posts
                set name = '{$name}',
                `desc`= '{$desc}',
                body = '{$body}',
                url_img = '{$url_img}',
                date = '{$time}'
                ";
        return $this->db->query($sql);
    }
}