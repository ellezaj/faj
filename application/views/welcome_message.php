
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta charset="utf-8">
  <!-- <meta name="description" content="Find a Builder offers professional plumbers, builders, electricians, carpenters and every other type of building specialist to the home improver and small developer." /> -->
  <meta name="author" content="Find A Jewelry">

  <meta name="keywords" content="Find A Jewelry" />

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- <meta name="description" content="Find a Builder offers professional plumbers, builders, electricians, carpenters and every other type of building specialist to the home improver and small developer." /> -->
  <meta name="language" content="en" />
  <title>Find a Jewelry</title>
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.ico" />

  <!-- Icons-->
  <!-- <link rel="manifest" href="<?=base_url();?>assets/img/favicon/manifest.json"> -->
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImge" content="<?=base_url();?>assets/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style_login.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.min.css">
  <link href="<?=base_url();?>assets/vendors/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
  <link href="<?=base_url();?>assets/vendors/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="<?=base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
  <script type="text/javascript">
    window.App = {
        "baseUrl": "<?= base_url() ?>",
        "removeDOM": "",
    };    
</script>
</head>
<body id="login-welcome-page">
<div id="bg_login">
    <div class="container">       
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 55%;">
                <div id="login" class="card-body text-center">
                    <!-- <img class="mb-4" style="width:45%" src="<?=base_url();?>assets/img/logo.png"> -->
                    <div style="color: rgb(2 63 136); margin: 50px 0px;">
                        <h1 style="font-weight: 900">FIND A JEWELRY</h1>
                    </div>
                    <h4 class="text-center">Sign In</h4>
                    <form @submit.prevent="checklogin">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-custom"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" v-model="username" class="form-control" placeholder="username">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-custom"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" v-model="password" class="form-control" placeholder="password">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn bg-custom float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/vendors/popper.js/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
<script src="<?=base_url();?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
<!-- vue -->
<script src="<?=base_url();?>assets/js/vue.js"></script>
<script src="<?=base_url();?>assets/js/axios.min.js"></script>
<script src="<?=base_url();?>assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/js/global.js"></script>
<script src="<?=base_url();?>assets/js/pages/login.js"></script>

</body>
</html>