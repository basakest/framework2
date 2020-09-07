<?php


function redirect($path)
{
    header('Location: ' . $path);
}

//放在flash里会报错
session_start();

/**
 * 这个函数有两个用处，创建flash和使用flash
 * 创建的话需要提供$name和$message
 * 使用的话需要提供$name
 *
 * @param string $name
 * @param string $message
 * @param string $class
 * @return void
 */
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name) && !empty($message)) {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
        if (isset($_SESSION[$name . '_class'])) {
            unset($_SESSION[$name . '_class']);
        }
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    
    } elseif (!empty($name) && empty($message)) {
        $flash['class'] = isset($_SESSION[$name . '_class'])?$_SESSION[$name . '_class']:'';
        $flash['message']= $_SESSION[$name];
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
        return $flash;
    }
}