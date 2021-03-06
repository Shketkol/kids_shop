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
        $category = array_shift(App::getRouter()->getParams());
        $method = next(App::getRouter()->getParams());
        //print_r($method); die;
        $this->data['toys'] = $this->model->getList($category);
        $this->data['latest tovar']= $this->model->getLatestTovar();
        switch ($method) {
            case 'price0-9':
                $this->data['toys'] = $this->model->getSortPriceABC($category);break;
            case 'price9-0':
                $this->data['toys'] = $this->model->getSortPriceDESC($category);break;
            case 'boy':
                $this->data['toys'] = $this->model->getSortBOY($category);break;
            case 'girl':
                $this->data['toys'] = $this->model->getSortGIRL($category);break;
            case 'year1':
                $this->data['toys'] = $this->model->getSortYear1($category);break;
            case 'year1-2':
                $this->data['toys'] = $this->model->getSortYear1and2($category);break;
            case 'year2-3':
                $this->data['toys'] = $this->model->getSortYear2and3($category);break;
            case 'year3-5':
                $this->data['toys'] = $this->model->getSortYear3and5($category);break;
            case 'year5-7':
                $this->data['toys'] = $this->model->getSortYear5and7($category);break;
            case 'year7-11':
                $this->data['toys'] = $this->model->getSortYear7and11($category);break;
            case 'year11-16':
                $this->data['toys'] = $this->model->getSortYear11and16($category);break;
            case 'year16':
                $this->data['toys'] = $this->model->getSortYear16($category);
        }

    }

    //������ ��� ������

    public function admin_index()
    {
        $this->data['toys'] = $this->model->getListAdmin();
        $this->data['category'] = $this->model->getCategory();
        //print_r($this->data['category']); die;



        if ($_POST) {
            $result = $this->model->save($_POST);
            Router::redirect('/admin/tovary/index');
        }


    }

    public function admin_category(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = (int)$_GET['id'];
            $category = $this->model->getType($id);
            echo "<select>";
            foreach ($category as $value) {
                echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
            }
            echo "</select>";

        }
    }

function admin_edit(){
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
