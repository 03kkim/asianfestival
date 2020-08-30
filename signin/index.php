<?php

include "../main.php";

if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_form";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = "sign_in";
}
switch($action) {
    case "show_form":
        include "view.php";
        break;

    case "sign_in":
        if ($_POST['remember'] == 1) {
            // keep logged in for one year
            $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        }
        else {
            // do not keep logged in after session ends
            $rememberDuration = null;
        }
        try {
            $auth->login($_POST['email'], $_POST['password'], $rememberDuration);

            echo 'User is logged in';
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid Email');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }

        header("Location: ../index.php");
        break;
}

