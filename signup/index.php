<?php

include "../main.php";

//  How do I insert the performances?
//  Wasn't sure what to put for values of the other Not Null columns
function add_user($email, $first_name, $last_name, $grade) {
    global $db;


    $query = "insert into users (email, password, username) values (:email, \"password\", :username); insert into user_info (grade, is_paid) values (:grade, 0)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":username", $first_name . $last_name);
        $statement->bindValue(":grade", $grade);

        $statement->execute();
        $statement->closeCursor();

    }

    catch (PDOException $e) {
        echo $e;
        exit();
    }


}



if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_form";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = "add_user";
}


switch($action) {
    case "show_form":
        $performances = get_performances();
        include 'view.php';

    case "add_user":
        $button_value = filter_input(INPUT_POST, "submit");
        if($button_value == "Submit") {
            $email = filter_input(INPUT_POST, "email");
            $first_name = filter_input(INPUT_POST, "first_name");
            $last_name = filter_input(INPUT_POST, "last_name");
            $grade = filter_input(INPUT_POST, "grade");
            add_user($email, $first_name, $last_name, $grade);
        }
        break;
}