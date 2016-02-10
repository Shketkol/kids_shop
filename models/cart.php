<?php

class Cart extends Model{

    private $products;
    //private $kol;

        public function getProdList($id_sql){
          $id_sql = implode(',', $id_sql);
          //var_dump($id_sql); die;
        $sql = "select * from tovary where id in ({$id_sql})";
        return $this->db->query($sql);
    }

    public function getUser($id_user){
        $sql = "select * from users where id = '{$id_user}'";
        return $this->db->query($sql);
    }
    public function addIdOrder($id_user, $price, $data){
        $price = null;
        foreach ($data as $value){
            $price = $price + ($value['price'] * $value['kol']);
        }
        $time = date("Y.m.d G:i:s", time());
        $sql = "insert into order_id
                set id_user = '{$id_user}',
                time = '{$time}',
                `price` = '{$price}',
                status = 'new'
                ";
        return $this->db->query($sql);
    }
    public function showOrderId($id_user){
        $sql = "select * from order_id where id_user = '{$id_user}' order by time desc limit 1";
        return $this->db->query($sql);
    }
    public function addOrder($id_order, $data){
        foreach ($data as $key=>$value){
            $sql = "insert into orders
                set id_orders = '{$id_order}',
                id_tovar = '{$value['id']}',
                `count` = '{$value['kol']}'
                ";
        $this->db->query($sql);
        }
    }
   /**
     *  Constructor
     */
    function __construct()
    {

        parent::__construct();
        $this->products = Cookie::get('tovary') == null ?
            array()
            :
            unserialize(Cookie::get('tovary'));

        /*$this->kol = Cookie::get('kol') == null ?
            array()
            :
            unserialize(Cookie::get('kol'));*/
    }


    /**
     * products getter
     *
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }


    /**
     * adding product
     *
     * @param $id
     */
    public function addProduct($id)
    {

        $id = (int)$id;
        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }
        Cookie::set('tovary', serialize($this->products));
        //echo "<pre>";
        //print_r(unserialize($_COOKIE['tovary'])); die;
        //Cookie::set('kol',serialize($this->kol));
    }


    /**
     * deleting product
     *
     * @param $id
     */
    public function deleteProduct($id)
    {
        $id = (int)$id;

        $key = array_search($id, $this->products);
        if ($key !== false){
            unset($this->products[$key]);
        }

        Cookie::set('tovary', serialize($this->products));
    }


    /**
     *  clear cart
     */
    public function clear()
    {
        Cookie::delete('tovary');
    }



    /**
     * check if empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->products;
    }

}
