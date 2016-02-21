<?php
class PostsController extends Controller{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Post();
    }

    public function index(){
        $this->data['posts'] = $this->model->getList();
    }
    public function view(){
        $params = App::getRouter()->getParams();
        $this->data['posts'] = $this->model->getPost($params);
    }
    public function admin_index(){
        $this->data['posts'] = $this->model->getListPost();
    }
    public function admin_add(){
        if($_POST){
            $posts = $_POST;
            $this->model->addNewPost($posts);
            Router::redirect('/admin/posts/index');
        }

    }
}