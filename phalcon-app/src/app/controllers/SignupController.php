<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller{

    public function IndexAction(){

    }
    
    public function testAction(){
       header('location:login/index');
    }

    public function registerAction(){

        $user = new Users();
        // print_r($this->request->getPost());
        $res = $this->request->getPost() ;
         if($res["password"] != $res["rpass"])
         {
            return "Password not matched";
         }
         else 
         {
        $user->assign(
            $this->request->getPost(), 
            [
                'name',
                'firstname',
                'lastname',
                'email',
                'password',
                'role',
                'status'
            ]
        );
    }

        $success = $user->save();

        $this->view->success = $success;

        if($success){
            $this->view->message = "Register succesfully";
        }else{
            $this->view->message = "Not Register succesfully due to following reason: <br>".implode("<br>", $user->getMessages());
        }
    }
}