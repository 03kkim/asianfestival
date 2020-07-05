<?php

require __DIR__ . '/vendor/autoload.php';
include "db/festival_db.php";

function create_header($style) {
    global $auth;
    $header = "<!-- Compiled and minified CSS -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css\">

    <!-- Compiled and minified JavaScript -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js\"></script>
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">";

    $navbar = "<nav class=\"red darken-4\">
    <div class=\"nav-wrapper\">
      <a href=\"/asianfestival/index.php\" class=\"brand-logo\" id=\"logo\">Asian Festival</a>
      <a href=\"#\" data-target=\"mobile-demo\" class=\"sidenav-trigger\"><i class=\"material-icons\">menu</i></a>
      <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
        <li><a href=\"/asianfestival/calendar/index.php\">Calendar</a></li>";
        if ($auth->isLoggedIn()) {
            $navbar .= "<li><a href=\"/asianfestival/practices/index.php\">Dashboard</a></li>";
            if($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
                $navbar .= "<li><a href=\"/asianfestival/confirm_admin_status\">Confirm Admins</a></li>";
            }
            $navbar.= "<li><a href=\"/asianfestival/logout/index.php\">Log Out</a></li></ul>
    </div>
  </nav>";
        }

        else {
            $navbar .= "<li><a href=\"/asianfestival/signup/index.php\">Sign Up</a></li>
        <li><a href=\"/asianfestival/signin/index.php\">Sign In</a></li>
      </ul>
    </div>
  </nav>";
        }

        $navbar .= "<ul class=\"sidenav\" id=\"mobile-demo\">
                    <li><a href=\"/asianfestival/calendar/index.php\">Calendar</a></li>";
    if ($auth->isLoggedIn()) {
        $navbar .= "<li><a href=\"/asianfestival/practices/index.php\">Dashboard</a></li>";
        if($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
            $navbar .= "<li><a href=\"/asianfestival/confirm_admin_status\">Confirm Admins</a></li>";
        }
        $navbar.= "<li><a href=\"/asianfestival/logout/index.php\">Log Out</a></li></ul>";
    }
    else {
        $navbar .= "<li><a href=\"/asianfestival/signup/index.php\">Sign Up</a></li>
        <li><a href=\"/asianfestival/signin/index.php\">Sign In</a></li></ul>";
    }

    $navbar .= "<body><main>";


    echo $header . $style . $navbar;
}

function create_footer() {
    $footer = "  
          <footer class=\"page-footer red darken-4\">
            <div class=\"container\">
            <div class=\"row\">
              <div class=\"col l6 s12\">
                <h5 class=\"white-text\">Footer Content</h5>
                <p class=\"grey-text text-lighten-4\">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class=\"col l4 offset-l2 s12\">
                <h5 class=\"white-text\">Links</h5>
                <ul>
                  <li><a class=\"grey-text text-lighten-3\" href=\"#!\">Link 1</a></li>
                  <li><a class=\"grey-text text-lighten-3\" href=\"#!\">Link 2</a></li>
                  <li><a class=\"grey-text text-lighten-3\" href=\"#!\">Link 3</a></li>
                  <li><a class=\"grey-text text-lighten-3\" href=\"#!\">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class=\"footer-copyright\">
            <div class=\"container\">
            © 2014 Copyright Text
            <a class=\"grey-text text-lighten-4 right\" href=\"#!\">More Links</a>
            </div>
          </div>
        </footer></main></body>";

    $footer .= "<script>
                  $(document).ready(function(){
                    $('.sidenav').sidenav();
                  });
                </script>";

    echo $footer;
}