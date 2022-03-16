<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
      
        
        // $this->view->users = Users::find();
        // return '<h1>Hello World!</h1>';
    }

    public function registerAction(){ 
      $data = $this->request->getPost();
           $res = Users::find();
        //    echo "Helo";
           foreach ($res as $k => $v) {
              if($v->email == $data["email"] && $v->password == $data["password"])
              {
                  
                header("location:success");
              }
           }
        // $res = $this->request->getPost() ;
        return "Incorrect email or password";
   }
   public function successAction()
   {
    $this->view->users = Users::find();
   }
}