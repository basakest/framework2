<?php

class Pages extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $this->view('pages/index', ['title' => 'test myself', 'description' => 'the description']);
    }

    //这个方法是用call_user_func_array调用的，传递了相关数组做参数，他们的位置是对应的，所以会被正常输出
    public function test($id)
    {
        echo 'test ' . $id;
    }
}
