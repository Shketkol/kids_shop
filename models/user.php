<?php

class User extends Model {

    public function getById($id){
        $id =(int)$id;
        $sql = "select * from users where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0]) ){
            return $result[0];
        }
        return false;
    }

    public function getByName($name, $l_name){
        $name = $this->db->escape($name);
        $l_name = $this->db->escape($l_name);
        $sql = "select * from users where name = '{$name}' and l_name = '{$l_name}'limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0]) ){
            return $result[0];
        }
        return false;
    }

    public function register($data)
    {
        if (!isset($data['name']) || !isset($data['l_name']) || !isset($data['password'])) {
            return false;
        }
        $name = $this->db->escape($data['name']);
        $l_name = $this->db->escape($data['l_name']);
        $mail = $this->db->escape($data['mail']);
        $phone = $this->db->escape($data['phone']);
        $region = $this->db->escape($data['region']);
        $region1 = $this->db->escape($data['region1']);
        $town = $this->db->escape($data['town']);
        $street = $this->db->escape($data['street']);
        $house = $this->db->escape($data['house']);
        $flat = $this->db->escape($data['flat']);

        if ($this->getByName($name, $l_name)) {
            return false;
        }

        $password = $data['password'];
        $hash = md5(Config::get('salt') . $password);

        $sql = "insert into users
                set name = '{$name}',
                l_name = '{$l_name}',
                mail = '{$mail}',
                phone = '{$phone}',
                region = '{$region}',
                region1 = '{$region1}',
                town = '{$town}',
                street = '{$street}',
                house = '{$house}',
                flat = '{$flat}',
                password = '{$hash}',
                role = 'user'
                ";
//echo $sql; die;
        if ($this->db->query($sql)) {
            return $this->db->insertId();
        }
        return false;
    }

        public function getListPost(){
            $sql = "select * from posts where 1 limit 6";
            return $this->db->query($sql);
        }


    // ÌÅÒÎÄ² ÄËß ÀÄÌÈÍÀ

    public function getListUser(){
        $sql = "select * from users where 1";
       return $this->db->query($sql);
    }

}