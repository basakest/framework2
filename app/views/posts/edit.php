<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<a href="/posts/index" class="btn btn-light"><i class="fas fa-backward"></i>&nbsp;Back</a>
<div class="card card-body bg-light mt-2">
    <h2>Edit post</h2>
    <p>Please add these information to update a post</p>
    <form action="/posts/edit/<?=$data['id'];?>" method="post">
        <div class="form-group">
            <label for="title1">Title:<sup>*</sup></label>
            <input type="text" name="title1" id="title1" class="form-control form-control-lg <?php echo isset($data['errors']['title1'])?'is-invalid':''?>" value="<?=$data['title1'];?>" />
            <span class="invalid-feedback"><?php echo $data['errors']['title1']; ?></span>
        </div>
        <div class="form-group">
            <label for="content">Content:<sup>*</sup></label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control form-control-lg <?php echo isset($data['errors']['content'])?'is-invalid':''?>"><?=$data['content'];?></textarea>
            <span class="invalid-feedback"><?php echo $data['errors']['content']; ?></span>
        </div>
        <button type="submit" class="btn btn-success btn-block">Edit</button>   
    </form>
</div>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>