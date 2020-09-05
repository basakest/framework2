<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<?= $data['title']; ?>
<ul>
<?php foreach($data['posts'] as $post):?>
    <li>
        <?php echo $post->name;?>
    </li>
<?php endforeach;?>
</ul>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>