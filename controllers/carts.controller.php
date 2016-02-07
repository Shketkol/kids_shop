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
            $_SESSION['tovar'] = $this->model->addProduct($id);
            Router::redirect('/tovary/view/' . $name);
        } elseif ($action == 'delete') {
            $id = (int)$_GET['id'];
            //var_dump($id);  die;
            $_SESSION['tovar'] = $this->model->deleteProduct($id);
            Router::redirect('/carts/index');
            //header('Location: cart.php');
        } elseif ($action == 'clear') {
            $_SESSION['tovar'] = $this->model->clear();
            Router::redirect('/carts/index');
        } else {
            if ($this->model->isEmpty()) {
            } else {
                $id_user = $_SESSION['id'];
                $this->data['user'] = $this->model->getUser($id_user);
                $id_sql = $this->model->getProducts();
                //echo "<pre>";
                //var_dump( $id_sql); die;
                // $this->data['tovar'] = $this->model->getProdList($id_sql);
                $this->data['tovar'] = $this->model->getProdList($id_sql);
                //echo "<pre>";
                //var_dump($this->data['tovar']); die;
            }
        }
        $kol = null;
        $id_tovar = null;
        if ($_GET) {
            $kol = (int)$_GET['kol'];
            $id_tovar = (int)$_GET['id_tovar'];
        }
        if(isset($this->data['tovar'])) {
            if (isset($_SESSION['tovar'])) {
                $this->data['tovar'] = Session::get('tovar');

            } else {
                foreach ($this->data['tovar'] as $key => $value) {
                    $this->data['tovar'][$key]['kol'] = 1;
                }
                Session::set('tovar', $this->data['tovar']);
            }

            foreach ($this->data['tovar'] as $key => $value) {
                if ($value['id'] == $id_tovar) {
                    $this->data['tovar'][$key]['kol'] = $kol;
                }
            }
            Session::set('tovar', $this->data['tovar']);
        }

       // echo "<pre>";
        //print_r($this->data['tovar']); die;


        /*if (isset($_SESSION['tovar'])) {
            $this->data['tovar'] = Session::get('tovar');

        } else {
                foreach ($this->data['tovar'] as $key=>$value) {
                $this->data['tovar'][$key]['kol'] = 1;
            }

        }
        Session::set('tovar', $this->data['tovar']);
        if ($_GET) {
            //Session::set('tovar',$this->data['tovar']);
            $kol = (int)$_GET['kol'];
            $id_tovar = (int)$_GET['id_tovar'];

            foreach ($this->data['tovar'] as $key => $value) {
                if ($value['id'] == $id_tovar) {
                    $this->data['tovar'][$key]['kol'] = $kol;
                }
            }
            Session::set('tovar', $this->data['tovar']);

        }*/


    }

    public function order()
    {
        $id_user = $_SESSION['id'];
        $price = null;
        foreach ($_SESSION['tovar'] as $value) {
            $price = $price + $value['price'] * $value['kol'];
        }
        $this->model->addIdOrder($id_user, $price, $_SESSION['tovar']);
        $user_id = $this->model->showOrderId($id_user);
        $id_order = null;
        foreach ($user_id as $value) {
            $id_order = (int)array_shift($value);
        }
        $id_tovar = array();
        foreach ($_SESSION['tovar'] as $value) {
            array_push($id_tovar, (int)$value['id']);
        }
        $this->model->addOrder($id_order, $id_tovar);
        $this->model->clear();
    }

}

