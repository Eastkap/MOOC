<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        /* TODO
        If $_POST["username"] or $_POST["password"] is empty or if 
        $_POST["password"] does not equal $_POST["confirmation"], 
        you’ll want to inform registrants of their error.
        
        new user into database: 
        CS50::query("INSERT IGNORE INTO users (username, hash, cash) 
        VALUES(?, ?, 10000.0000)", $_POST["username"], 
        password_hash($_POST["password"], PASSWORD_DEFAULT));
        query returns 0 if failed
        
        get id:
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"]
        
        f registration succeeds, you might as well log the new user in 
        (as by "remembering" that id in $_SESSION), thereafter 
        redirecting to index.php.
        */  
        if($_POST["password"]==''){
            apologize("blank passwords aren't accepted");
        }
        else if($_POST["password"]!=$_POST["confirmation"])
        {
            apologize("password and confirmation do not match!");
        }
        else
        {
            if($_POST["username"]=="")
            {
                apologize("you must chose a username!");
            }
            $result=CS50::query("SELECT `id` FROM `users` WHERE username=?",$_POST["username"]);
            // $_POST["username"])
            if($result==false)
            {
                $result=CS50::query("INSERT INTO `users` (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
                if($result==false){
                    apologize("Weird error happened there, please try again");
                }
                else{
                    $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                    $_SESSION["id"]= $rows[0]["id"];
                    redirect("index.php");
                }
            }
            else{
                apologize("Error in username, already existing?");
            }
        }
    }

?>