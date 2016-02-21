<?php

class Page extends Model{
    public function contact($data){
        $name = $this->db->escape($data['name']);
        $mail = $this->db->escape($data['mail']);
        $text = $this->db->escape($data['text']);
        $time = date("Y.m.d G:i:s", time());
        $sql = "insert into contact
                set name = '{$name}',
                mail = '{$mail}',
                text = '{$text}',
                time = '{$time}'
                ";
        return $this->db->query($sql);

    }
    public function getListSale(){
        $sql = "select * from tovary where sale = 1 ";
        return $this->db->query($sql);
    }
    public function getListLate(){
        $sql = "select * from tovary where 1 ORDER by `time`";
        return $this->db->query($sql);
    }
    public function getListPopular(){
        $sql = "select t.id,
                t.name,
                t.url_img,
                t.price,
                count(o.id_tovar)
            from shop.tovary = t
            join shop.orders = o on t.id = o.id_tovar
            group by t.id
            order by 5 desc";
        return $this->db->query($sql);
    }
    public function search($data){
        //print_r($data); die;
        $sql = "select id,
                name,
                url_img,
                price
            from tovary
            where name LIKE '%{$data}%'";
        return $this->db->query($sql);
    }
    public function getListComment(){
        $sql = "select *
            from contact
            where 1 ";
        return $this->db->query($sql);
    }
}