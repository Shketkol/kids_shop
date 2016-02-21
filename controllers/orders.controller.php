<?php

class OrdersController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Order();
    }

    public function admin_index() {
        $this->data['orders'] = $this->model->getList();
        if($_POST) {
            $status = $_POST['status'];
            $id = $_POST['id'];
            //print_r($_GET); die;
            $this->model->update($id, $status);


        }
        if(isset($_GET['id_order'])) {
            $id = $_GET['id_order'];
            $tovar = $this->model->showTovar($id);
            Session::set('showTovar',$tovar);

            //print_r($this->data['tovar']);die;
        }
    }

    public function admin_show(){
        if(isset($_GET['id_order'])) {
            $id = $_GET['id_order'];
            $tovar = $this->model->showTovar($id);
            Session::set('showTovar',$tovar);

            //print_r($this->data['tovar']);die;
        }
    }

    public function admin_history(){
        $this->data['history'] = $this->model->showHistory();
    }

}