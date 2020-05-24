<?php

include "db/festival_db.php";

function create_header($style) {
    $header = "<!-- Compiled and minified CSS -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css\">

    <!-- Compiled and minified JavaScript -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js\"></script>";

    $navbar = "<nav class=\"red darken-4\">
    <div class=\"nav-wrapper\">
      <a href=\"../index.php\" class=\"brand-logo\" id=\"logo\">Asian Festival</a>
      <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
        <li><a href=\"calendar/index.php\">Calendar</a></li>
        <li><a href=\"signup/index.php\">Sign Up</a></li>
        <li><a href=\"collapsible.html\">JavaScript</a></li>
      </ul>
    </div>
  </nav>";

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
        </footer>";

    echo $footer;
}