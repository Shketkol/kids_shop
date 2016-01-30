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
    public function addProduct($id, $kol)
    {
        $id = (int)$id;
        $kol = (int)$kol;
        if (!in_array($id, $this->products)) {
            array_push($this->products, $id, $kol);
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
