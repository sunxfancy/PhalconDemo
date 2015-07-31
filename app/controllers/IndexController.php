<?php

class IndexController extends ControllerBase
{
	public function initialize()
	{
		parent::initialize();
		Phalcon\Tag::setTitle('主页');
			$this->view->setTemplateAfter('base');
	}

	public function indexAction() {

	}

	public function demoAction() {
		$this->view->setVar('text', '哇哈哈呵呵呵');
	}

	public function loginAction()
	{
		$username = $this->request->getPost('username', 'string');
		$password = $this->request->getPost('password', 'string');
		$user = User::findFirst(array(
			"conditions" => "username = ?1",
			"bind" => array(1 => $username)
		));
		if ($user) {
			if ($user->password == $password) {
				$this->view->setVar('username', $user->username);
				$this->view->setVar('name', $user->name);
				$this->view->setVar('email', $user->email);
				$this->view->setVar('text', false);
			}
		} else {
			$this->view->setVar('text', '用户不存在');
		}
	}

	public function logoutAction()
	{
		
	}

	public function signupAction()
	{
		$user = new User();
		$user->username = $this->request->getPost('username', 'string');
		$user->password = $this->request->getPost('password', 'string');
		$user->name = $this->request->getPost('name', 'string');
		$user->email = $this->request->getPost('email', 'email');
		if (!$user->save()){
			foreach ($user->getMessages() as $message){
				echo $message;
			}
		}
		$this->view->setVar('text', '注册成功');
	}

	public function jqgridAction()
	{
		$this->view->setTemplateAfter('ace');
	}

	public function listAction()
	{
        $builder = $this->modelsManager->createBuilder()
                                       ->from('User');
        $sidx = $this->request->getQuery('sidx','string');
        $sord = $this->request->getQuery('sord','string');
        if ($sidx != null)
            $sort = $sidx;
        else
            $sort = 'id';
        if ($sord != null)
            $sort = $sort.' '.$sord;
        $builder = $builder->orderBy($sort);
        $this->datareturnforuser($builder);
	}

	public function updateAction()
	{
		$oper = $this->request->getPost('oper', 'string');
        if ($oper == 'edit') {
            $id = $this->request->getPost('id', 'int');
            $manager = User::findFirst($id);
            $manager->username = $this->request->getPost('username', 'string');
            $manager->password = $this->request->getPost('password', 'string');
            $manager->name = $this->request->getPost('name', 'string');
            $manager->email = $this->request->getPost('email', 'email');
            if (!$manager->save()) {
                foreach ($manager->getMessages() as $message) {
                    echo $message;
                }
            }
        }
        if ($oper == 'del') {
            $id = $this->request->getPost('id', 'int');
            $manager = Manager::findFirst($id);
            if (!$manager->delete()) {
                foreach ($manager->getMessages() as $message) {
                    echo $message;
                }
            }
        }
	}

	public function datareturnforuser($builder)
    {
        $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
        $limit = $this->request->getQuery('rows', 'int');
        $page = $this->request->getQuery('page', 'int');
        if (is_null($limit)) $limit = 10;
        if (is_null($page)) $page = 1;
        $paginator = new Phalcon\Paginator\Adapter\QueryBuilder(array("builder" => $builder,
                                                                      "limit" => $limit,
                                                                      "page" => $page));
        $page = $paginator->getPaginate();
        //print_r($page->items);
        $ans = array();
        $ans['total'] = $page->total_pages;
        $ans['page'] = $page->current;
        $ans['records'] = $page->total_items;
        foreach ($page->items as $key => $item)
        {
            $item->password = '***';
            $ans['rows'][$key] = $item;
        }
        echo json_encode($ans);
        $this->view->disable();
    }

}

