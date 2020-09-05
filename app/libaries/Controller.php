<?php

class Controller
{
    public function model($model)
    {
        require_once('../app/models/' . $model . '.php');
        return new $model();
    }

    //这个方法在index.php文件中被调用
    //代码顺序执行，所以之后引入的view文件能直接访问到$data数组
    public function view($view, $data)
    {
        require_once('../app/views/' . $view . '.php');
    }
}