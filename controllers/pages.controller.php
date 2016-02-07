<?php

class PagesController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Page();
    }

    public function home()
    {
        $this->data['toys'] = $this->model->getList();
    }

    public function admin_index(){

    }
}