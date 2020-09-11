<?php

class Users extends Controller
{
    public $errors = [];
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];
            if ($this->registerValidate($name, $email, $password, $confirm_password)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                if ($this->userModel->register($name, $email, $password)) {
                    flash('register', 'register successfully');
                    $flash = flash('register');
                    $this->view('users/login', ['email' => '', 'password' => '', 'title' => 'Login', 'errors' => [], 'flash' => $flash]);
                } else {
                    die('注册失败，请重试');
                }
            } else {
                $this->view('users/register', ['name' => $name, 'email' => $email, 'password' => $password, 'confirm_password' => $confirm_password, 'title' => 'Regisiter', 'errors' => $this->errors]);
            }

        } else {
            $this->view('users/register', ['name' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'title' => 'Regisiter', 'errors' => []]);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->loginValidate($email, $password)) {
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    $_SESSION['id'] = $user->id;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    redirect('/pages/index');
                } else {
                    $this->errors['password'] = 'password wrong';
                    $this->view('users/login', ['email' => $email, 'password' => $password, 'title' => 'Login', 'errors' => $this->errors]);
                }
            } else {
                $this->view('users/login', ['email' => $email, 'password' => $password, 'title' => 'Login', 'errors' => $this->errors]);
            }
        } else {
            $this->view('users/login', ['email' => '', 'password' => '', 'title' => 'Login', 'errors' => []]);
        }
    }

    public function registerValidate($name, $email, $password, $confirm_password)
    {
        $name = trim($name);
        $email = trim($email);
        $password = trim($password);
        $confirm_password = trim($confirm_password);

        if (empty($name)) {
            $this->errors['name'] = 'name can\'t be null';
        } elseif (strlen($name) < 6) {
            $this->errors['name'] = 'the characters of name can\'t less than 6';
        }

        if (empty($email)) {
            $this->errors['email'] = 'email can\'t be null';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'email format wrong';
        }

        if ($this->userModel->findByEmail($email)) {
            $this->errors['email'] = 'this email is already taken';
        }

        if (empty($password)) {
            $this->errors['password'] = 'password can\'t be null';
        } elseif (strlen($password) < 6) {
            $this->errors['password'] = 'the characters of password can\'t less than 6';
        }

        if (empty($confirm_password)) {
            $this->errors['confirm_password'] = 'confirm_password can\'t be null';
        } elseif ($password !== $confirm_password) {
            $this->errors['confirm_password'] = 'password and confirm_password must be same';
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 登录验证
     *
     * @param [string] $email
     * @param [string] $password
     * @return boolean
     */
    public function loginValidate($email, $password)
    {
        //首先过滤字符左右的空格
        $email = trim($email);
        $password = trim($password);
        if (empty($email)) {
            $this->errors['email'] = 'email can\'t be null';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'email format wrong';
        }

        if (!$this->userModel->findByEmail($email)) {
            $this->errors['email'] = 'this email hasn\'t registed';
        }

        if (empty($password)) {
            $this->errors['password'] = 'password can\'t be null';
        } elseif (strlen($password) < 6) {
            $this->errors['password'] = 'the characters of password can\'t less than 6';
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 用户退出
     *
     * @return void
     */
    public function logout()
    {
        // 重置会话中的所有变量
        $_SESSION = array();

        // 如果要清理的更彻底，那么同时删除会话 cookie
        // 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // 最后，销毁会话
        session_destroy();

        flash('logout', 'Logout success!');
        $flash = flash('logout');
        $this->view('pages/index', ['title' => 'homepage', 'description' => 'description', 'flash' => $flash]);
        //redirect('/pages/logout_flash');
    }

    
}
