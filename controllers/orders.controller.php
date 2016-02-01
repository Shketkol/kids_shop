<?php

class OrdersController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Order();
    }

    public function admin_index() {
        $this->data['orders'] = $this->model->getList();

    }

}