<?php

class Tovar extends Model{

    //ÌÅÒÎÄÛ ÄËß ÎÒÎÁÐÀÆÅÍÈß ÈÃÐÓØÅÊ(ÑÏÈÑÊÎÌ)
    public function getListToy(){
        $sql = "select * from tovary where other = 'toy' ";
        return $this->db->query($sql);
    }

    // ÌÅÒÎÄÛ ÄËß ÎÒÎÁÐÀÆÅÍÈß ÊÎÍÊÐÅÒÍÎÃÎ ÒÎÂÀÐÀ
    public function getByTovar($name){
        $name = $this->db->escape($name);
        $sql = "select * from tovary where name = '{$name}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }
    // ÌÅÒÎÄÛ ÄËß ÎÒÎÁÐÀÆÅÍÈß ÍÀ ÃËÀÂÍÓÞ ÑÒÐÀÍÈÖÓ
    public function getList(){
        $sql = "select * from tovary where 1";
        return $this->db->query($sql);
    }
    public function getLatestTovar(){
        $sql = "select * from tovary where 1 order by time limit 4";
        return $this->db->query($sql);
    }
    //ÌÅÒÎÄÛ ÄËß ÄÎÁÀÂËÅÍÈß ÊÎÌÅÍÒÀÐÈÉ Ê ÊÎÍÊÐÅÒÍÎÌÓ ÒÎÂÀÐÓ
    public function getListComent($name){
        $sql = "select * from coment_tovar where name_tovar = '{$name}'";
        //var_dump($sql); die;
        return $this->db->query($sql);
    }

    public function addComent($data, $params){
        if (!isset($data['name'])||!isset($data['text'])){
            return false;
        }
        $name = $this->db->escape($data['name']);
        $text = $this->db->escape($data['text']);
        $time = date("Y.m.d G:i:s", time());
        $name_tovar = $params;
        //echo $time;die;
        $sql = "insert into coment_tovar
                set name = '{$name}',
                text = '{$text}',
                time = '{$time}',
                name_tovar = '{$name_tovar}'
                ";
        return $this->db->query($sql);
    }

    // ÌÅÒÎÄÛ ÄËß ÀÄÌÈÍÀ

    /*public function addTovar($data)
    {
        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $sql = "insert into tovary
                set name = '{$name}',
                description = '{$description}',
                price = '{$price}'
                ";
        return $this->db->query($sql);
    }*/
    public function delete($id){
        $id = (int)$id;
        $sql = "delete from tovary where id = {$id}";
        return $this->db->query($sql);
    }
    public function save($data, $id = null){
        if ( !isset($data['name']) || !isset($data['description']) || !isset($data['price']) ){
            return false;
        }

        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);

        if ( !$id ){ // Add new record
            $sql = "insert into tovary
                set name = '{$name}',
                description = '{$description}',
                price = '{$price}'
                ";
        } else { // Update existing record
            $sql = "
                update  tovary
                set name = '{$name}',
                description = '{$description}',
                price = '{$price}'
                where id = {$id}
            ";
        }

        return $this->db->query($sql);
    }
    public function getListComentTovar(){
        $sql = "select * from coment_tovar where 1";
        return $this->db->query($sql);

    }
    // ÌÅÒÎÄÛ ÑÎÐÒÈÐÎÂÊÈ

        // ÑÎÐÒÈÐÎÂÊÀ ÏÎ ÖÅÍÅ
        public function getSortPrise($action){
            $sql = "select * from tovary where other = '{$action}' order by price";
            return $this->db->query($sql);
        }

        public function getSortName($name){
            $sql = "select * from tovary where other = '{$name}' order by name";
            return $this->db->query($sql);
        }
}