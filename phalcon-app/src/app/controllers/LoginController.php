<?php
session_start();
use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
      

    }

    public function verifyAction()
    {
      $data = $this->request->getPost();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";
      // echo "on Admin dashboard";
      // die();
      $res = Users::findFirst(
       [
           'columns'    => '*',
           'conditions' => 'email = ?1 AND password = ?2',
           'bind'       => [
               1 => $data["email"],
               2 => $data["password"],
           ]
       ]
   );
      if(gettype($res) != "NULL")
      {
      // $this->view->users = $res ;
       $_SESSION["user"] = array(
        "id" => $res->id,
        "name" => $res->name,
        "email" => $res->email,
        "role" => $res->role,
      );
    
      $this->response->redirect('admin/dashboard');
      } else {
        return "Incorrect email or password";
      }
    }
   public function signOutAction()
   { 

   }
}