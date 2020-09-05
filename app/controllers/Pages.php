<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Page');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();
        $this->view('pages/index', ['title' => 'test myself', 'posts' => $posts]);
    }

    //这个方法是用call_user_func_array调用的，传递了相关数组做参数，他们的位置是对应的，所以会被正常输出
    public function test($id)
    {
        echo 'test ' . $id;
    }
}
