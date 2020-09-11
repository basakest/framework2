<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/users/login');
            exit;
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }


    public function index()
    {
        $posts = $this->postModel->getAll();
        $this->view('posts/index', ['title' => 'post', 'posts' => $posts]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user_id = $_SESSION['id'];
            $title1 = trim($_POST['title1']);
            $content = trim($_POST['content']);
            if (empty($title1)) {
                $errors['title1'] = 'title can\'t be null';
            }
            if (empty($content)) {
                $errors['content'] = 'content can\'t be null';
            }
            if (empty($errors)) {
                if ($this->postModel->add($title1, $content, $user_id)) {
                    flash('post_flash', 'add successfully');
                    $flash = flash('post_flash');
                    $posts = $this->postModel->getAll();
                    $this->view('posts/index', ['title' => 'index', 'posts' => $posts, 'flash' => $flash]);
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('posts/add', ['title' => 'add', 'title1' => '', 'content' => '', 'errors' => $errors]);
            }
        } else {
            $this->view('posts/add', ['title' => 'add', 'title1' => '', 'content' => '']);
        }   
    }

    public function show($id)
    {
        $post = $this->postModel->getById($id);
        $user = $this->userModel->getById($post->user_id);
        $this->view('posts/show', ['title' => 'show', 'post' => $post, 'user' => $user]);
    }

    public function edit($id)
    {
        $post = $this->postModel->getById($id);
        if ($post->user_id != $_SESSION['id']) {
            redirect('/posts/index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user_id = $_SESSION['id'];
            $title1 = trim($_POST['title1']);
            $content = trim($_POST['content']);
            if (empty($title1)) {
                $errors['title1'] = 'title can\'t be null';
            }
            if (empty($content)) {
                $errors['content'] = 'content can\'t be null';
            }
            if (empty($errors)) {
                if ($this->postModel->update($title1, $content, $id)) {
                    flash('post_flash', 'update successfully');
                    $flash = flash('post_flash');
                    $posts = $this->postModel->getAll();
                    $this->view('posts/index', ['title' => 'index', 'posts' => $posts, 'flash' => $flash]);
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('posts/edit', ['title' => 'edit', 'title1' => $title1, 'content' => $content, 'errors' => $errors]);
            }
        } else {
            //$post = $this->postModel->getById($id);
            $this->view('posts/edit', ['title' => 'edit', 'title1' => $post->title, 'content' => $post->content, 'id' => $id]);
        }   
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$id) {
                echo 'no id is supplied';
                exit;
            }
            $post = $this->postModel->getById($id);
            if ($post) {
                if ($this->postModel->delete($id)) {
                    $posts = $this->postModel->getAll();
                    flash('post_message', 'delete successfully');
                    $flash = flash('post_message');
                    $this->view('posts/index', ['posts' => $posts, 'title' => 'index', 'flash' => $flash]);
                } else {
                    echo '删除失败';
                    exit;
                }
            }
        } else {
            redirect('');
        }
    }
}