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
                order by o.`time` DESC
                ";
        return $this->db->query($sql);
    }
}