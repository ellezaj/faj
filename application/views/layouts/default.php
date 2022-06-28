<!DOCTYPE html>

<html lang="en">

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
  <!-- <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.ico" /> -->
  <!-- Icons-->

  <!-- <link rel="manifest" href="<?= base_url(); ?>assets/img/favicon/manifest.json"> -->
  <meta name="theme-color" content="#ffffff">

  <link href="<?= base_url(); ?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendors/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/dropzone.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/circle.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/css/daterangepicker.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/plugins/chartjs/chart.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/js/spinkit.min.css" rel="stylesheet">

  <!-- Main styles for this application-->
  <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">

  <title><?php echo isset($title) ? $title : 'Find a builder - Making a better home'; ?></title>

  <script type="text/javascript">
    window.App = {
      "baseUrl": "<?= base_url() ?>",
      "removeDOM": "",
    };
  </script>
  <?php if (!isset($_SESSION['logged_in'])) : ?>
    <style type="text/css">
      .main,
      .app-footer {
        margin-left: 0px !important;
      }

      .app-body {
        margin-top: 20px !important;
      }
    </style>
  <?php endif ?>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <div class="parent-loading d-none" style="z-index: 99999999999;">
    <div class="loading ">
      <div class="sk-fold sk-center">
        <div class="sk-fold-cube">D</div>
        <div class="sk-fold-cube">S</div>
        <div class="sk-fold-cube">D</div>
        <div class="sk-fold-cube">W</div>
      </div>
      <br>
      <div id="loading_content" style=" color: red;
  font-weight: bolder;
  background-color: white;
  padding: 6px;
  border-radius: 10px;">
      </div>
    </div>

  </div>
  <?php if (isset($_SESSION['logged_in'])) : ?>
    <?= $template['partials']['header']; ?>
  <?php endif; ?>
  <div class="app-body">

    <?php if (isset($_SESSION['logged_in'])) : ?>
      <?php if (isset($template['partials']['sidebar'])) : ?>
        <div class="sidebar">
          <?= $template['partials']['sidebar']; ?>
        </div>
      <?php endif; ?>

    <?php endif; ?>

    <main class="main">
      <?= $template['body']; ?>
    </main>

    <?php if (isset($template['partials']['aside'])) : ?>
      <aside class="aside-menu">
        <?= $template['partials']['aside']; ?>
      </aside>
    <?php endif; ?>
  </div>

  <?= $template['partials']['footer']; ?>

  <!-- CoreUI and necessary plugins-->
  <script src="<?= base_url(); ?>assets/vendors/jquery/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/popper.js/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/pace-progress/js/pace.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap-select.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/chartjs/chart.min.js"></script>
  <!-- Plugins and scripts required by this view-->

  <!-- <script src="<?= base_url(); ?>assets/vendors/chart.js/js/Chart.min.js"></script> -->
  <!--     <script src="<?= base_url(); ?>assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script> -->

  <script src="<?= base_url(); ?>assets/vendors/toast-master/js/jquery.toast.js"></script>

  <!-- <script src="<?= base_url(); ?>assets/vendors/sweetalert/sweetalert.min.js"></script> -->
  <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>

  <script src="<?= base_url(); ?>assets/vendors/sweetalert/jquery.sweet-alert.custom.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->

  <script src="<?= base_url(); ?>assets/js/main.js"></script>
  <!-- Dropzone -->
  <script src="<?= base_url(); ?>assets/js/dropzone.js"></script>
  <!-- vue -->
  <script src="<?= base_url(); ?>assets/js/vue.js"></script>
  <script src="<?= base_url(); ?>assets/js/vue-tables-2.min.js"></script>
  <!-- axios -->
  <script src="<?= base_url(); ?>assets/js/axios.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/global.js"></script>
  <script src="<?= base_url('assets/js/script.js') ?>"></script>
  <script src="<?= base_url('assets/js/html2canvas.js') ?>"></script>

  <?php echo $template['metadata']; ?>

</body>

</html>