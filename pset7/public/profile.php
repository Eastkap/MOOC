<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("pf.php", ["title" => "Profile Settings"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["f"]))
        {
            $hash=password_hash($_POST["oldp"], PASSWORD_DEFAULT);
            $hashcheck=CS50::query("SELECT hash FROM users WHERE id=?",$_SESSION["id"]);
            //dump($hashcheck);
            if(!password_verify($_POST["oldp"], $hashcheck[0]["hash"])){
                apologize("bad password input");
            }
            if($_POST["npc"]==$_POST["np"]){
                $newhash=password_hash($_POST["np"], PASSWORD_DEFAULT);
                CS50::query("UPDATE users SET hash=? WHERE id=?",$newhash,$_SESSION["id"]);
            }
            else{
                apologize("New passwords do not match");
            }
        }
        else{
            $hashcheck=CS50::query("SELECT hash FROM users WHERE id=?",$_SESSION["id"]);

            if(password_verify($_POST["p"], $hashcheck[0]["hash"])){
                CS50::query("UPDATE users SET cash=cash+? WHERE id=?",$_POST["f"],$_SESSION["id"]);
                CS50::query("INSERT INTO history (Transaction,price,uid) VALUES(?,?,?)",'ADD',$_POST["f"],$_SESSION["id"]);
            }
                redirect("/");
                
            }
                
    }
?>