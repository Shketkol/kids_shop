<?php

class Order extends Model {

    public function getList(){
        $sql = "select o.id_order,
	            o.`status`,
                o.`time`,
                u.`name`,
                o.price
                from shop.order_id o
                join users u on o.id_user = u.id
                ";
        return $this->db->query($sql);
    }
}