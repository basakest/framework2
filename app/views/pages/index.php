<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <?php if (isset($data['flash'])):?>
            <div class="<?=$data['flash']['class'];?>" id="msg-flash">
                    <?=$data['flash']['message'];?>
            </div>
        <?php endif;?>
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
    </div>
</div> 
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>