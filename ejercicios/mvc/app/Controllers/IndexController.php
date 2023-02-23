<?php
namespace App\Controller;

class IndexController extends BaseController
{
    public function IndexAction()
    {
        $data = array('message'=>'Hola mundo');
        $this->renderHTML('../views/indexView.php',$data) ;
    }
}
?>
