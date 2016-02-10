<?php

class OrdersController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Order();
    }

    public function admin_index() {
        $this->data['orders'] = $this->model->getList();
        if($_GET) {
            $status = $_GET['status'];
            $id = $_GET['id'];
            //print_r($_GET); die;
            $this->model->update($id, $status);


        }
        if($_POST) {
            $id = $_POST['id'];
            $tovar = $this->model->showTovar($id);
            Session::set('showTovar',$tovar);
            //print_r($this->data['tovar']);die;
        }




    }

    public function admin_history(){
        $this->data['history'] = $this->model->showHistory();
    }

}