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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="hold-transition login-page">
    <div class="loader">
        <img src="<?php echo base_url('assets/dist/img/Preloader.gif') ?>" alt="Loading..." />
    </div>
    <img class="wave" src="<?php echo base_url('assets/dist/img/wave1.png'); ?>" />
    <div class="container">
        <div class="img">
            <img src="<?php echo base_url('assets/dist/img/bg1.svg'); ?>" />
        </div>
        <?php if(!empty($errors)) {
                  echo $errors;
              } ?>
        <div class="login-content">
            <form action="<?php echo base_url('auth/login') ?>" method="post">
                <img src="<?php echo base_url('assets/dist/img/logo.png'); ?>" />
                <h2 class="title">Welcome Back</h2><hr /><br />
                <p>Please, provide login credentials to proceed.</p>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" />
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                    </div>
                </div><br>
                  <div class="g-recaptcha" data-sitekey="6LdN2_AjAAAAAM3IkQK071eP_kPNGSf82iTZNElD"></div>
                <input type="submit" class="btn" value="Login" name="btnLogin" />
                <div>
                    <a style="text-align: center;"href="<?= base_url()?>forgotpass">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url('assets/dist/js/main.js') ?>"></script>
    <script src="<?php echo base_url('assets/dist/js/loader_index.js') ?>"></script>
</body>
</html>