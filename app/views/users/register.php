
<?php require_once(APP_ROOT . '/views/inc/header.php');?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create user account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name:<sup>*</sup></label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg <?php echo isset($data['errors']['name'])?'is-invalid':''?>" value="<?=$data['name'];?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['name']; ?></span>
                </div>
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
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:<sup>*</sup></label>
                    <input type="password" name="confirm-password" id="confirm-password" class="form-control form-control-lg <?php echo isset($data['errors']['confirm_password'])?'is-invalid':''?>" value="<?=$data['confirm_password'];?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['confirm_password']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </div>
                    <div class="col">
                        <a href="/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once(APP_ROOT . '/views/inc/footer.php');?>