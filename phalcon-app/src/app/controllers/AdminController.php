<?php
session_start();
use Phalcon\Mvc\Controller;


class AdminController extends Controller
{
            public function indexAction()
            {

            }

            public function yourBlogAction()
            {
             
                
                $res = Blogs::find("id IN (".$_SESSION["user"]["id"].")"  );
                $this->view->blogs = $res;
                
                
            }

            public function dashboardAction()
            {
            }


            public function allUsersAction()
            {
            $this->view->users = Users::find();
            }


            public function homeAction()
            {
                $this->response->redirect('home');
            }
            
            public function deleteAction()
            {
                if (isset($_POST["delete"])) {
                    $id = $_POST["deleteId"];
                    $res = Users::find("id IN (".$id.")");
                    $res->delete();
                   header("location:http://localhost:8080/admin/allUsers");
                }
            }

            public function chStatusAction()
            {
            // die($_POST["status"]);
            $res = Users::findFirst(
                [
                 'columns'    => '*',
                 'conditions' => 'id = ?1 ',
                 'bind'       => [
                     1 => $_POST["id"]
                 ]
                ]
            );
            // echo "<pre>";
            // print_r($res);
            // echo "</pre>";
            if ($_POST["status"] == "approved") {
            $res->status = "pending";
            } else {
                $res->status = "approved";
            }
           
            $res->save();
           header("location:http://localhost:8080/admin/allUsers");
            }

            public function newBlogAction()
            {
//                echo "<pre>";
//  print_r($_POST);
//                echo "<pre>";
//                die();

                $blog = new Blogs();

               if (isset($_POST["addButton"])) {
                 
                    $blog->id =$_SESSION["user"]["id"];
                    $blog->title = $_POST["pname"];
                    $blog->text = $_POST["blogText"];
                    $blog->img = $_FILES["c_image"]["name"];
                    $blog->save();
                    header("location:http://localhost:8080/home");
               }
              
            }
}