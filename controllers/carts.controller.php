<?php

class CartsController extends Controller
{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Cart();
    }


    public function index()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        if ($action == 'add') {
            $name = $_GET['name'];
            $id = (int)$_GET['id'];
            $this->model->addProduct($id);
            Router::redirect('/tovary/view/' . $name);
        } elseif ($action == 'delete') {
            $id = (int)$_GET['id'];
            //var_dump($id);  die;
            $this->model->deleteProduct($id);
            Router::redirect('/carts/index');
            //header('Location: cart.php');
        } elseif ($action == 'clear') {
            $this->model->clear();
            Router::redirect('/carts/index');
        } else {
            if ($this->model->isEmpty()) {
            } else {
                $id_user = $_SESSION['id'];
                $this->data['user'] = $this->model->getUser($id_user);
                $id_sql = $this->model->getProducts();
               // $this->data['tovar'] = $this->model->getProdList($id_sql);
                $tovar = $this->model->getProdList($id_sql);
                //echo "<pre>";
                //var_dump($tovar);  die;
            }
        }
        //$this->data['tovar']['kol'] = 1;
       ///var_dump($_GET);die;
        /*$tovar = array();
        $tovar1 = array();
        $kol =(int) $_GET['kol'];
        $id = (int) $_GET['id_tovar'];
        $tovar1['kol'] = $kol;
        $tovar1['id_tovar'] = $id;
        array_push($tovar,$tovar1);
        var_dump($tovar);die;
        array_push($this->data['tovar'],$tovar);*/
        /*if($_GET){
             //var_dump($_GET['id_tov']);die;
             $kol =(int) $_GET['kol'];
             $id = (int) $_GET['id_tovar'];
             //var_dump($id);die;
             $tovar['']['kol'] = $kol;
             $tovar['']['id_tovar'] = $id;
            array_push($this->data['tovar'],$tovar);
             //$this->data['tovar']['kol'] = $kol;
             //$this->data['tovar']['id_tovar'] = $id;
             echo "<pre>";
             var_dump( $this->data['tovar']);  die;
         }*/
        //echo "<pre>";
        //var_dump( $this->data['tovar']);  die;
        $key = array();
        foreach ($tovar as $value) {
            $value['kol'] = 1;
            array_push($key, $value);
        }
        $tovar = array();
        $this->data['tovar'] = array_merge($tovar, $key);
        $tovar1 = array();

        if ($_GET) {
            $kol = (int)$_GET['kol'];
            $id_tovar = (int)$_GET['id_tovar'];

            foreach ($this->data['tovar'] as $key=>$value ) {
                if($value['id']==$id_tovar){
                    $this->data['tovar'][$key]['kol']=$kol;
                }
            }


            /*foreach ($this->data['tovar'] as $value) {
               if($value['id'] == $id_tovar) {
                    $value['kol'] = $kol;
                    array_push($tovar1,$value);
                   } elseif($value['id'] != $id_tovar) {
                   array_push($tovar1,$value);
               }
            }*/
            //$this->data['tovar'] = array();
            //$this->data['tovar'] = array_merge($this->data['tovar'],$tovar1);
            echo "<pre>";
            var_dump($this->data['tovar']);  die;
        }
        Session::set('tovar',$this->data['tovar']);
        }

        public function order(){
            $id_user = $_SESSION['id'];
            $price = null;
            foreach ($_SESSION['tovar'] as $value){
                $price = $price + $value['price'] * $value['kol'];
            }
            $this->model->addIdOrder($id_user, $price);
            $user_id = $this->model->showOrderId($id_user);
            $id_order = null;
            foreach ($user_id as $value) {
                $id_order = (int) array_shift($value);
            }
            $id_tovar = array();
            foreach ($_SESSION['tovar'] as $value ) {
                array_push($id_tovar,(int)$value['id']);
            }
            $this->model->addOrder($id_order, $id_tovar);
            $this->model->clear();
            //echo "<pre>";
            //var_dump($id_order);  die;
            //$tovar = array();
            //array_push($tovar,$_POST);
            //array_push($tovar,$_SESSION['tovar']);

        }


        //Router::redirect('/tovary/view/'.$id);
        //exit;
    }

