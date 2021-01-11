

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>App-SPK || <?= $title ?></title>
    
    <link rel="apple-touch-icon" href="<?= base_url('assets') ?>/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/site.min.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/jquery-mmenu/jquery-mmenu.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/waves/waves.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
   
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/nestable/nestable.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/tasklist/tasklist.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/sortable/sortable.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/vendor/bootstrap-sweetalert/sweetalert.css">
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/global/fonts/font-awesome/font-awesome.css">
    
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
      Breakpoints();
    </script>
    <script>
        let base = '<?= base_url('')?>';
    </script>
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
    <script src="<?= base_url('assets') ?>/global/vendor/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/asrange/jquery-asRange.min.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/bootbox/bootbox.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/formvalidation/formValidation.min.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/formvalidation/framework/bootstrap4.min.js"></script>


    <script src="<?= base_url('assets') ?>/global/vendor/sortable/Sortable.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/nestable/jquery.nestable.js"></script>



    <!-- Scripts -->
    <script src="<?= base_url('assets') ?>/global/js/Component.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Base.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Config.js"></script>
    
    <script src="<?= base_url() ?>/assets/js/Section/Sidebar.js"></script>
    <script src="<?= base_url() ?>/assets/js/Section/PageAside.js"></script>
    <script src="<?= base_url() ?>/assets/js/Section/GridMenu.js"></script>
    
    <!-- Config -->
    <script src="<?= base_url('assets') ?>/global/js/config/colors.js"></script>
    <script src="<?= base_url() ?>/assets/js/config/tour.js"></script>
    <script>Config.set('assets', '<?= base_url() ?>/assets');</script>
    
    <!-- Page -->
    
    <script src="<?= base_url('assets') ?>/global/js/Plugin/asscrollable.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/slidepanel.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/switchery.js"></script>
    

    <script src="<?= base_url('assets') ?>/global/js/Plugin/jquery-placeholder.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/material.js"></script>
    <script src="<?= base_url('assets') ?>/global/vendor/bootstrap-sweetalert/sweetalert.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/bootstrap-sweetalert.js"></script>
  </head>
  <body class="animsition site-navbar-small ">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <span class="navbar-brand-logo">SPK</span>
          <!-- <img class="navbar-brand-logo" src="<?= base_url() ?>/assets/images/logo.png" title="Remark"> -->
          <span class="navbar-brand-text hidden-xs-down"> Sistem Pendukung</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon md-search" aria-hidden="true"></i>
        </button>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <!-- <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li> -->
            <li class="nav-item hidden-float">
              <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>
            <li class="nav-item dropdown dropdown-fw dropdown-mega">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
                role="button">Mega <i class="icon md-chevron-down" aria-hidden="true"></i></a>
              <div class="dropdown-menu" role="menu">
                <div class="mega-content">
                  <div class="row">
                    <div class="col-md-4">
                      <h5>UI Kit</h5>
                      <ul class="blocks-2">
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/animation.html">Animation</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/buttons.html">Buttons</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/colors.html">Colors</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/dropdowns.html">Dropdowns</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/icons.html">Icons</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/lightbox.html">Lightbox</a></li>
                          </ul>
                        </li>
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/modals.html">Modals</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/panel-structure.html">Panels</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../structure/overlay.html">Overlay</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/tooltip-popover.html ">Tooltips</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../advanced/scrollable.html">Scrollable</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="../uikit/typography.html">Typography</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5>Media
                        <span class="badge badge-pill badge-success">4</span>
                      </h5>
                      <ul class="blocks-3">
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="<?= base_url('assets') ?>/global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="mb-0">Accordion</h5>
                      <!-- Accordion -->
                      <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true"
                        role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingOne" role="tab">
                            <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne" data-parent="#siteMegaAccordion"
                              aria-expanded="false" aria-controls="siteMegaCollapseOne">
                              Collapsible Group Item #1
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseOne" aria-labelledby="siteMegaAccordionHeadingOne"
                            role="tabpanel">
                            <div class="panel-body">
                              De moveat laudatur vestra parum doloribus labitur sentire partes, eripuit praesenti
                              congressus ostendit alienae, voluptati ornateque accusamus
                              clamat reperietur convicia albucius.
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingTwo" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseTwo"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseTwo">
                              Collapsible Group Item #2
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseTwo" aria-labelledby="siteMegaAccordionHeadingTwo"
                            role="tabpanel">
                            <div class="panel-body">
                              Praestabiliorem. Pellat excruciant legantur ullum leniter vacare foris voluptate
                              loco ignavi, credo videretur multoque choro fatemur mortis
                              animus adoptionem, bello statuat expediunt naturales.
                            </div>
                          </div>
                        </div>
    
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseThree"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseThree">
                              Collapsible Group Item #3
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseThree" aria-labelledby="siteMegaAccordionHeadingThree"
                            role="tabpanel">
                            <div class="panel-body">
                              Horum, antiquitate perciperet d conspectum locus obruamus animumque perspici probabis
                              suscipere. Desiderat magnum, contenta poena desiderant
                              concederetur menandri damna disputandum corporum.
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Accordion -->
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                aria-expanded="false" role="button">
                <span class="flag-icon flag-icon-us"></span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-gb"></span> English</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-fr"></span> French</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-de"></span> German</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-nl"></span> Dutch</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="<?= base_url('assets/img/').$this->session->userdata('gambar') ?>" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?= base_url('profile') ?>" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn-logout" type="button" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon md-notifications" aria-hidden="true"></i>
                <span class="badge badge-pill badge-danger up">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>NOTIFICATIONS</h5>
                  <span class="badge badge-round badge-danger">New 5</span>
                </div>
    
                <div class="list-group">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">A new order has been placed</h6>
                            <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-account bg-green-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Completed the task</h6>
                            <time class="media-meta" datetime="2017-06-11T18:29:20+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Settings updated</h6>
                            <time class="media-meta" datetime="2017-06-11T14:05:00+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Event started</h6>
                            <time class="media-meta" datetime="2017-06-10T13:50:18+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-comment bg-orange-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Message received</h6>
                            <time class="media-meta" datetime="2017-06-10T12:34:48+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon md-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon md-email" aria-hidden="true"></i>
                <span class="badge badge-pill badge-info up">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>MESSAGES</h5>
                  <span class="badge badge-round badge-info">New 3</span>
                </div>
    
                <div class="list-group" role="presentation">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-online">
                              <img src="<?= base_url('assets') ?>/global/portraits/2.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Mary Adams</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-17T20:22:05+08:00">30 minutes ago</time>
                            </div>
                            <div class="media-detail">Anyways, i would like just do it</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-off">
                              <img src="<?= base_url('assets') ?>/global/portraits/3.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Caleb Richards</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-17T12:30:30+08:00">12 hours ago</time>
                            </div>
                            <div class="media-detail">I checheck the document. But there seems</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-busy">
                              <img src="<?= base_url('assets') ?>/global/portraits/4.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">June Lane</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-16T18:38:40+08:00">2 days ago</time>
                            </div>
                            <div class="media-detail">Lorem ipsum Id consectetur et minim</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-away">
                              <img src="<?= base_url('assets') ?>/global/portraits/5.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Edward Fletcher</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-15T20:34:48+08:00">3 days ago</time>
                            </div>
                            <div class="media-detail">Dolor et irure cupidatat commodo nostrud nostrud.</div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer" role="presentation">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon md-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    See all messages
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item" id="toggleChat">
              <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                data-url="../site-sidebar.tpl">
                <i class="icon md-comment" aria-hidden="true"></i>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon md-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                  data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
    </nav> 
    <div id="menu">
      
    </div>  


    <!-- Page -->
    <div class="page">
      <div class="page-content">
        <?php 
            $jabatan = $this->session->userdata('id_jabatan');
            $url1 = $this->uri->segment(1);
            $url2 = $this->uri->segment(2);
            if ($url2) {
              $url = $this->uri->segment(1).'/'.$this->uri->segment(2);
            }else{
              $url = $url1;
            }
            $menu = $this->db->get_where('menu', ['url_menu' => $url])->row();
          ?>
          <?php if ($menu): 
            $akses = $this->db->get_where('previlege_jabatan', ['id_jabatan' => $jabatan, 'id_menu' => $menu->id_menu]);
            ?>
            <?php if ($akses->num_rows() < 1): ?>
                    <link rel="stylesheet" href="<?= base_url()?>assets/examples/css/pages/errors.css">
                    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
                      <div class="page-content vertical-align-middle">
                        <header>
                          <h1 class="animation-slide-top">403</h1>
                          <p>Akses Ditolak</p>
                        </header>
                        <p class="error-advise">Anda Tidak Memiliki Akses Untuk Mengakses Halaman Ini</p>
                        <a class="btn btn-primary btn-round" href="<?= base_url('admin-dashboard')?>">Kembali Ke Dashboard</a>

                        <footer class="page-copyright">
                          <p>WEBSITE App For SKripsi</p>
                          <p>© 2021. All RIGHT RESERVED.</p>
                          <div class="social">
                            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                          <i class="icon bd-twitter" aria-hidden="true"></i>
                        </a>
                            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                          <i class="icon bd-facebook" aria-hidden="true"></i>
                        </a>
                            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                          <i class="icon bd-google-plus" aria-hidden="true"></i>
                        </a>
                          </div>
                        </footer>
                      </div>
                    </div>
            <?php else: ?>
                <h2><?= $title ?></h2>
                <?= $konten ?>
            <?php endif ?>

          <?php endif ?>
      </div>
    </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© <?= date('Y') ?> <a href="https://app/">Sistem Pendukung Keputusan</a></div>
      <div class="site-footer-right">
        Template <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
 
    <script src="<?= base_url('assets') ?>/js/alert.js"></script>
    <script src="<?= base_url('assets') ?>/global/js/Plugin/panel.js"></script>
    <script src="<?= base_url('assets') ?>/examples/js/uikit/panel-actions.js"></script>
        
   
    <script>
     

      var url1 = '<?= $this->uri->segment(1) ?>'
      var url2 = '<?= $this->uri->segment(2) ?>'
      $.ajax({
          url:base+'generate_menu',
          data:
          {
              url1 : url1,
              url2 : url2
          },
          type:'POST',
          dataType:'HTML',
          success:function(response)
          {
              $('#menu').html(response)
          }
      })
    </script>
    
  </body>
</html>
