<?php

class CartsController extends Controller
{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Cart();
    }


    public function index(){
        //var_dump($_GET['name']);  die;
      //print_r($_COOKIE['kol']); die;
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
            if ($action == 'add') {
                $name = $_GET['name'];
                $id =(int) $_GET['id'];
                $this->model->addProduct($id);
                //var_dump($kol);  die;
                Router::redirect('/tovary/view/'.$name);
            } elseif ($action == 'delete') {
                $id =(int)$_GET['id'];
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
                    $id_sql = $this->model->getProducts();
                    $this->data['tovar'] = $this->model->getProdList($id_sql);
                }
            }
        $this->data['tovar']['kol'] = 1;
        //var_dump($_GET);die;
        if($_GET){
            //var_dump($_GET['id_tov']);die;
            $kol =(int) $_GET['kol'];
            //$id = (int) $_GET['id_tovar'];
            //var_dump($id);die;
            $tovar['']['kol'] = $kol;
            //$tovar['']['id_tovar'] = $id;
            $this->data['tovar']['kol'] = $kol;
            //$this->data['tovar']['id_tovar'] = $id;
            //echo "<pre>";
            //var_dump( $this->data['tovar']);  die;
        }
        /*if($_GET){
            $kol =(int) $_GET['kol'];
            $id = (int) $_GET['id_tovar'];
        }*/

        }
        //Router::redirect('/tovary/view/'.$id);
        //exit;
    }

