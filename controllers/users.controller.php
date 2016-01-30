<?php

class UsersController extends Controller
{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function register()
    {
        if ($_POST) {
            $result = $this->model->register($_POST);
            if ($result) {
                $user = $this->model->getById($result);
                Session::set('id', $user['id']);
                Session::set('name', $user['name']);
                Session::set('l_name', $user['l_name']);
                Session::set('role', $user['role']);
                Router::redirect('/pages/home');
            } else {
                die('ошибка');
            }
        }
    }

    public function login()
    {
        if ($_POST && isset($_POST['name']) && isset($_POST['l_name']) && isset($_POST['password'])) {
            $user = $this->model->getByName($_POST['name'], $_POST['l_name']);
            $hash = md5(Config::get('salt') . $_POST['password']);
            if ($user && $hash == $user['password']) {
                Session::set('id', $user['id']);
                Session::set('name', $user['name']);
                Session::set('l_name', $user['l_name']);
                Session::set('role', $user['role']);
            }
            Router::redirect('/pages/home');
        }
    }

    public function admin_logout()
    {
        Session::destroy();
        Router::redirect('/ad_style.css/');
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect('/pages/home');
    }


    public function profile()
    {
        $user = $_SESSION['login'];
        $this->data['users'] = $this->model->profileList($user);
    }

    public function edit()
    {
        if ($_POST) {
            $id = $_POST['id'];
            $this->data['user'] = $this->model->profileEdit($_POST, $id);
            /*if ($result) {
                Session::setFlash('Page was saved.');
            } else {
                Session::setFlash('Error.');
            }
            Router::redirect('/users/profile');*/
        }


    }

    public function listmen(){
        $user = $_SESSION['department'];
        $this->data['users'] = $this->model->getList($user);
    }


}