<?php

class PagesController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Page();
    }

    public function home()
    {
        $this->data['toys_sale'] = $this->model->getListSale();
        $this->data['toys_late'] = $this->model->getListLate();
        $this->data['toys_popular'] = $this->model->getListPopular();

    }
    public function index(){

    }
    public function about(){

    }
    public function delivery(){

    }
    public function contact(){
        if($_POST){
            $data = $_POST;
            $this->model->contact($data);
        }

    }
    public function search(){
        if($_POST){
            $data = $_POST['search'];
            $this->data['toys'] = $this->model->search($data);
            $this->data['toys_late'] = $this->model->getListLate();
        }
    }

    public function admin_contact(){
    $this->data['comment'] = $this->model->getListComment();
    }
}