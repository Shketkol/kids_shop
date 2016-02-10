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
                WHERE o.`status` = 'new'
                order by o.`time` DESC
                ";
        return $this->db->query($sql);
    }
    public function update($id, $status){
        $sql = "update  order_id
                set status = '{$status}'
                where id_order = {$id}
                ";
        return $this->db->query($sql);
    }
    public function showTovar($id_order){
        $sql = "select t.`article`,
                   t.`url_img`,
                   t.`name`,
                   t.`price`,
                   o.count
            from shop.tovary t
            join orders o on t.id = o.id_tovar
            where o.id_orders = '{$id_order}'
        ";
        return $this->db->query($sql);
    }
    public function showHistory(){
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