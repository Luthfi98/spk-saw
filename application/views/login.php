

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>App-SPK || Login</title>
    
    <link rel="apple-touch-icon" href="<?= base_url('assets') ?>/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/site.min.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/jquery-mmenu/jquery-mmenu.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/waves/waves.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/examples/css/pages/login-v3.css">
          <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/bootstrap-sweetalert/sweetalert.css">

    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <!--[if lt IE 9]>
    <script src="<?= base_url('assets') ?>/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="<?= base_url('assets') ?>/global/vendor/media-match/media.match.min.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="<?= base_url('assets') ?>/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
    	let base = '<?= base_url() ?>'
      Breakpoints();
    </script>

  </head>
  <body class="animsition page-login-v3 layout-full">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle">
        <div class="panel">
          <div class="panel-body">
            <div class="brand">
              <img class="brand-img" src="<?= base_url('assets') ?>//images/logo-colored.png" alt="...">
              <h2 class="brand-text font-size-18">Login</h2>
            </div>
            <form id="form">
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="text" class="form-control" autofocus="true" name="username" id="username" />
                <label class="floating-label">Username</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="password" class="form-control" name="password" id="password" />
                <label class="floating-label">Password</label>
              </div>
              <div class="form-group clearfix">
                <div class="row">
                    <div class="col-10" id="loadCaptcha"></div>
                    <div class="col-2">
                        <span class="pull-left"><i class="fa fa-refresh" title="Refresh Captcha"  style="cursor:pointer; font-size:30px;" id="captcha_refresh"></i></span>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-group">
                            <input type="text" placeholder="Ketikkan Captcha Disini" name="captcha_words" id="captcha_words" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <!-- <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                  <input type="checkbox" id="inputCheckbox" name="remember">
                  <label for="inputCheckbox">Remember me</label>
                </div> -->
                <!-- <a class="float-right" href="forgot-password.html">Forgot password?</a> -->
              </div>
              <button type="button" class="btn btn-primary btn-block btn-lg mt-40 btn-login">Sign in</button>
            </form>
            <!-- <p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p> -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="<?= base_url('assets') ?>/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/jquery/jquery.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/animsition/animsition.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/waves/waves.js"></script>
    
    <!-- Plugins -->
    <script src="<?= base_url('assets') ?>/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/switchery/switchery.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/intro-js/intro.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/screenfull/screenfull.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="<?= base_url('assets') ?>/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    
    <!-- Scripts -->
    <script src="<?= base_url('assets') ?>/global/js/Component.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Base.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Config.js"></script>
    
    <script src="<?= base_url('assets') ?>/js/Section/Menubar.js"></script>
    <script src="<?= base_url('assets') ?>/js/Section/Sidebar.js"></script>
    <script src="<?= base_url('assets') ?>/js/Section/PageAside.js"></script>
    <script src="<?= base_url('assets') ?>/js/Section/GridMenu.js"></script>
    
    <!-- Config -->
    <script src="<?= base_url('assets') ?>/global/js/config/colors.js"></script>
    <script src="<?= base_url('assets') ?>/js/config/tour.js"></script>
    <script>Config.set('assets', '<?= base_url('assets') ?>');</script>
    
    <!-- Page -->
    <script src="<?= base_url('assets') ?>/js/Site.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/asscrollable.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/slidepanel.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/switchery.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/jquery-placeholder.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/material.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/bootstrap-sweetalert/sweetalert.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/bootstrap-sweetalert.js"></script>
    <script src="<?= base_url('assets') ?>/js/alert.js"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>
    <script>
            var captchaWords=$('#captcha_words');
            $('.btn-login').click(function(){
                var username = $('#username').val()
                var password = $('#password').val()

                if (username == '' || password == '') {
                    alertWarning('Username atau Password Tidak Boleh Kosong');
                }else{  
                    if (captchaWords.val() == '') {
                        alertWarning('Captcha Belum Diisi')
                    }else{
                        $.ajax({
                            url:base+'cekLogin',
                            data:$('#form').serialize(),
                            type:'POST',
                            dataType:'JSON',
                            success:function(respond)
                            {
                                if (respond.sukses) {
                                    alertSuccess(respond.alert)
                                    window.location.href=base+"admin-dashboard"
                                }else{
                                    alertError(respond.alert)
                                }
                            }
                        })
                    }

                }
            })
        $(document).ready(function(){
            loadCaptcha()
        })

        var captchaField=$('#loadCaptcha');
        var recaptcha=$('#captcha_refresh');


        function loadCaptcha()
        {
             $.ajax({
              async:false,
              url:base+'Auth/generateCaptcha'
              ,type:'GET'
              ,dataType:'html'
              ,success:(res)=>{
                captchaField.html(res);
              }

            });
        }

        recaptcha.click((e)=>{
          e.preventDefault();
          loadCaptcha();
        });
    </script>
  </body>
</html>
