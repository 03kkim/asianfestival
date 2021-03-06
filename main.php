<?php

require __DIR__ . '/vendor/autoload.php';
include "db/festival_db.php";
$r = getenv("WEB_ROOT");
if($r != "") {
    $web_root = $r;
}
else {
    $web_root = "/" . basename(__DIR__);
}

function create_header($style="") {
    global $auth;
    global $web_root;
    $header = "<!-- Compiled and minified CSS -->
    <header>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css\">

    <!-- Compiled and minified JavaScript -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js\"></script>
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
    <style>
    body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

  .practices {
    width: 40%;
    margin: 0 auto;
    margin-top: 5%;
    margin-bottom: 5%;
  }
  #logo {
    margin-left: 1%;
  }

  #home_logo {
    padding: 5% 10%;
  }
    </style>";
    $navbar = "<nav style='background:#355070;'>
    <div class=\"nav-wrapper\">
      <a href=\"" . $web_root . "/index.php\" style=\"white-space:nowrap\" class=\"brand-logo\" id=\"logo\">Asian Fest</a>
      <a href=\"#\" data-target=\"mobile-demo\" class=\"sidenav-trigger\"><i class=\"material-icons\">menu</i></a>
      <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
        <li><a href=\"" . $web_root . "/calendar/index.php\">Calendar</a></li>";
        if ($auth->isLoggedIn()) {
            $navbar .= "<li><a href=\"" . $web_root . "/practices/index.php\">Dashboard</a></li>";
            if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN)) {
                $navbar .= "<li><a href=\"" . $web_root . "/control_panel\">Control Panel</a></li>";
            }
            if($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
                $navbar .= "<li><a href=\"" . $web_root . "/confirm_admin_status\">Confirm Admins</a></li>";
            }
            $navbar.= "<li><a href=\"" . $web_root . "/logout/index.php\">Log Out</a></li></ul>
    </div>
  </nav>";
        }

        else {
            $navbar .= "<li><a href=\"" . $web_root . "/signup/index.php\">Sign Up</a></li>
        <li><a href=\"" . $web_root . "/signin/index.php\">Sign In</a></li>
      </ul>
    </div>
  </nav>";
        }

        $navbar .= "<ul class=\"sidenav\" id=\"mobile-demo\">
                    <li><a href=\"" . $web_root . "/calendar/index.php\">Calendar</a></li>";
    if ($auth->isLoggedIn()) {
        $navbar .= "<li><a href=\"" . $web_root . "/practices/index.php\">Dashboard</a></li>";
        if($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
            $navbar .= "<li><a href=\"" . $web_root . "/confirm_admin_status\">Confirm Admins</a></li>";
        }
        $navbar.= "<li><a href=\"" . $web_root . "/logout/index.php\">Log Out</a></li></ul>";
    }
    else {
        $navbar .= "<li><a href=\"" . $web_root . "/signup/index.php\">Sign Up</a></li>
        <li><a href=\"" . $web_root . "/signin/index.php\">Sign In</a></li></ul>";
    }

    $navbar .= "</header></meta><body><main>";

    echo $header . $style . $navbar;
}

function create_footer() {
    $footer = "
          </main></body>  
          <footer style='background:#355070' class=\"page-footer\">
            <div class=\"container\">
            <div class=\"row\">
              <div class=\"col l6 s12\">
                <h5 class=\"white-text\">RHS Asian Festival 2020</h5>
                <p class=\"grey-text text-lighten-4\">This website was designed to be used by performers in the RHS Asian Festival Program.</p>
              </div>
              <div class=\"col l4 offset-l2 s12\">
                <h5 class=\"white-text\">Contact</h5>
                <ul>
                  <li><a class=\"grey-text text-lighten-3\" href=\"https://www.instagram.com/rhs.asianfest/\">Instagram | @rhs.asianfest</a></li>
                  <li><a class=\"grey-text text-lighten-3\" href=\"#!\">Questions? | 03kkim@ridgewood.k12.nj.us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class=\"footer-copyright\">
            <div class=\"container\">
            © 2020 RHS Asian Fest
            <a class=\"grey-text text-lighten-4 right\" href=\"#!\"></a>
            </div>
          </div>
        </footer>";

    $footer .= "<script>
                  $(document).ready(function(){
                    $('.sidenav').sidenav();
                  });
                </script>";

    echo $footer;
}