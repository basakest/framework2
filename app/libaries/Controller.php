<?php
/**
 * 所有的控制器都是它的子类，能使用除私有方法以外的所有方法
 */
class Controller
{
    /**
     * 加载对应的model
     *
     * @param [string] $model 模型文件在/app/models/下的路径，不需要提供/和.php后缀名
     * @return void
     */
    public function model($model)
    {
        require_once('../app/models/' . $model . '.php');
        return new $model();
    }

    /**
     * 加载对应的视图文件
     * 这个方法在index.php文件中被调用
     * 代码顺序执行，所以之后引入的view文件能直接访问到$data数组
     *
     * @param [string] $view 视图文件在/app/views/下的路径，不需要提供/和.php后缀名
     * @param [array] $data 加载视图文件所必须的数据，全为空也可以，必须提供
     * @return void
     */
    public function view($view, $data)
    {
        require_once('../app/views/' . $view . '.php');
    }
}