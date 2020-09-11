<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="/posts/add" class="btn btn-primary float-right">
            <i class="fas fa-pencil-alt"></i>Add Post
        </a>
    </div>
</div>
<?php if (isset($data['flash'])):?>
    <p class="<?=$data['flash']['class']?>"><?=$data['flash']['message'];?></p>
<?php endif; ?>
<?php foreach($data['posts'] as $post):?>
    <div class="card card-body mb-3">
        <h4 class="card-title">
            <?=$post->title?>
        </h4>
        <div class="bg-light p-2 mb-3">
            Writen by <?=$post->postCreateAt;?>
        </div>
        <div class="card-text">
            <?=$post->content;?>
        </div>
        <a href="/posts/show/<?=$post->postId?>" class="btn btn-dark mt-2">More</a>
    </div>
<?php endforeach;?>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>