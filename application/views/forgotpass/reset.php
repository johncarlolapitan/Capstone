<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/loader.css') ?>" />
</head>
<body class="hold-transition login-page">
   
    <img class="wave" src="<?php echo base_url('assets/dist/img/wave1.png'); ?>" />
    <div class="container">
        <div class="img">
            <img src="<?php echo base_url('assets/dist/img/bg1.svg'); ?>" />
        </div>
        <?php if(!empty($errors)) {
                  echo $errors;
              } ?>
        <div class="login-content">
            <form action="<?php echo base_url('reset/password?hash='.$hash) ?>" method="post">
                <img src="<?php echo base_url('assets/dist/img/logo.png'); ?>" />
                <h2 class="title">Set New Password</h2><hr /><br />
                <p>Please, set a new password.</p>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm New Password" autocomplete="off" />
                    </div>
                </div>
                <input type="submit" class="btn" value="Submit" name="btnLogin" />
                <div>
                    <a style="text-align: center;"href="<?= base_url()?>auth/login">Go Back</a>
                </div>
                 <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <?php if($this->session->userdata('error')) { ?>
                            <p class="text-danger"><?=$this->session->userdata('error')?> </p>
                            <?php } ?>
                             <?php if($this->session->userdata('success')) { ?>
                            <p class="text-danger"><?=$this->session->userdata('success')?> </p>
                            <?php } ?>

                            <p class="text-danger"><?php echo validation_errors(); ?></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url('assets/dist/js/main.js') ?>"></script>
</body>
</html>