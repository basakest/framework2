<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <p>Please fill in your credentials to log in</p>
            <?php if (isset($data['flash'])):?>
                <div class="<?=$data['flash']['class'];?>" id="msg-flash">
                        <?=$data['flash']['message'];?>
                </div>
            <?php endif;?>
            <form action="/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email:<sup>*</sup></label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg <?php echo isset($data['errors']['email'])?'is-invalid':''?>" value="<?=$data['email'];?>" />
                    <span class="invalid-feedback"><?php echo $data['errors']['email']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password:<sup>*</sup></label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg <?php echo isset($data['errors']['password'])?'is-invalid':''?>" value="<?=$data['password'];?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['password']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block">Login</button>
                    </div>
                    <div class="col">
                        <a href="/users/register" class="btn btn-light btn-block">No account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>