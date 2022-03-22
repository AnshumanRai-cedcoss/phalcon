<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $this->view->blogs = Blogs::find();
        // return '<h1>Hello World!</h1>';
    }
    public function moreDetailsAction()
    {
       
        $data = $this->request->getPost();
        $res = Blogs::findFirst(
            [
             'columns'    => '*',
             'conditions' => 'blog_id = ?1 ',
             'bind'       => [
                 1 => $data["id"]
             ]
            ]
        );
        $this->view->blogs = $res;
    }

    public function editAction()
    {
        
        $res = Blogs::findFirst(
            [
             'columns'    => '*',
             'conditions' => 'blog_id = ?1 ',
             'bind'       => [
                 1 => $_POST["id"]
             ]
            ]
        );
        $this->view->blogs = $res;
    }

    public function deleteAction()
    {
        // echo $_POST["delId"];
        // die();
        $res = Blogs::find("blog_id IN (".$_POST["delId"].")");
        $res->delete();

        header("location:http://localhost:8080/home");
    }


    public function updateAction()
    {
        echo "<pre>";
 print_r($_POST);
 echo "</pre>";
        $res = Blogs::findFirst(
            [
             'columns'    => '*',
             'conditions' => 'blog_id = ?1 ',
             'bind'       => [
                 1 => $_POST["blogId"]
             ]
            ]
        );
        // echo "<pre>";
        // print_r($res);
        // echo "</pre>";
        $img = $_FILES['c_image']['name'];
        $c_image_temp = $_FILES['c_image']['tmp_name'];
        $oldImg = $res->img;
        $res->title = $_POST["pname"];
        $res->text = $_POST["blogText"];
        if ($img != "")
            {
            move_uploaded_file($c_image_temp, "../public/images/$img")   ;
            unlink("../public/images/$oldImg");
            $res->img = $img;
            }
        $res->save(); 
       header("location:http://localhost:8080/home");
    }
}