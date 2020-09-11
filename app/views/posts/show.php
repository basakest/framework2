<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<a href="/posts/index" class="btn btn-light"><i class="fas fa-backward"></i>&nbsp;Back</a>
<h1><?=$data['post']->title?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?=$data['user']->name;?> on <?=$data['post']->created_at;?>
</div>
<p>
    <?=$data['post']->content;?>
</p>
<?php if ($_SESSION['id'] == $data['user']->id): ?>
    <hr />
    <a href="/posts/edit/<?=$data['post']->id;?>" class="btn btn-dark">edit</a>
    <!--要对form添加float-right才行，对button添加的话，button所在的行会在a的下面-->
    <form action="/posts/delete/<?=$data['post']->id;?>" method="post" class="float-right">
        <button class="btn btn-danger">delete</button>
    </form>
<?php endif; ?>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>