 <?php

class TovaryController extends Controller
{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Tovar();
    }

    public function view()
    {
        $params = App::getRouter()->getParams();
        if (!isset($params[0])) {
            //die('Wrong ID');
        }
        $name = strtolower($params[0]);

        $this->data['tovar'] = $this->model->getByTovar($name);

        $this->data['latest tovar']= $this->model->getLatestTovar();

        $this->data['coment'] = $this->model->getListComent($params[0]);
        if ($_POST) {
            $result = $this->model->addComent($_POST, $params[0]);
            Router::redirect('/tovary/view/' . $name);
        }
    }

    /*public function index()  {
        Router::redirect('/tovary/toy');
        exit;

    }*/

    public function toy()
    {
        $action = App::getRouter()->getAction();
        //echo $action; die;
        $params = array_shift(App::getRouter()->getParams());
        //var_dump($params); die;
        $method = null;
        $this->data['toys'] = $this->model->getListToy();
        $this->data['latest tovar']= $this->model->getLatestTovar();
        foreach (App::getRouter()->getParams() as $method_sort) {
            $method = $method_sort;
        }
        if ($method == 'price') {
            $this->data['toys'] = $this->model->getSortPrise($params);
        } else if ($method == 'name') {
            $this->data['toys'] = $this->model->getSortName($params);
        }
    }

    //������ ��� ������

    public function admin_index()
    {
        $this->data['toys'] = $this->model->getList();

    }
        public function admin_add()
    {
        if ($_POST) {
            $result = $this->model->save($_POST);
            Router::redirect('/admin/tovary/index');
        }
    }
    public function admin_edit(){
        if ( $_POST ){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ( $result ){
                Session::setFlash('����� ��� ��������');
            } else {
                Session::setFlash('������');
            }
            Router::redirect('/admin/tovary/index');
        }

    }

    public function admin_delete(){

        if ( isset($this->params[0]) ){

            $result = $this->model->delete($this->params[0]);

            if ( $result ){
                Session::setFlash('Page was deleted.');
            } else {
                Session::setFlash('Error.');
            }
        }
       Router::redirect('/admin/tovary/index');
    }

    public function admin_comentTovar(){
    $this->data['comentTovar'] = $this->model->getListComentTovar();
    }
}
