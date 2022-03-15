<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
      
        
        $this->view->users = Users::find();
        // return '<h1>Hello World!</h1>';
    }

    public function registerAction(){

        // $robots = $connection->fetchAll(
        //     "SELECT * FROM users",
        //     \Phalcon\Db::FETCH_ASSOC
        // );   
        // print_r($robots); 
    //  print_r($this->request->getPost());
    //  die();
        $res = $this->request->getPost() ;
         
   }
}