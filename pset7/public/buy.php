<?php

    // configuration
    require("../includes/config.php");
    $q=CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
    //dump($positions);
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buyform.php", ["title" => "Buy","cash" => $q[0]["cash"]]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST" && preg_match("/^\d+$/",$_POST["buy"])==true)
    {
        render("buyview.php",["title" => "Buy", "cash"=>$q[0]["cash"]]);
        /*$price=CS50::query("SELECT shares FROM portfolios WHERE id=? AND symbol=?",$_SESSION["id"], $_POST["symbol"]);
        $share=$shares[0]["shares"];
        $check=preg_match("/^\d+$/", $_POST["shares2sell"]);
        if($_POST["shares2sell"]>$share || $check==false){
            apologize("Operation cannot be done, you don't have that many shares!");
        }
        else{
            $q=CS50::query("UPDATE portfolios SET shares=shares-? WHERE id =? AND symbol =?",$_POST["shares2sell"],$_SESSION["id"],$_POST["symbol"]);
            foreach ($positions as $position)
            {
                if($position["symbol"]==$_POST["symbol"]){
                    $price=$position["price"];
                }
            }
            $p=CS50::query("UPDATE users SET cash=cash+? WHERE id =?",$_POST["shares2sell"]*$price,$_SESSION["id"]);
        }*/
    }
    else{
        apologize("Make sure you entered a valid number of shares!");
    }
    //header("https://ide50-eastkap.cs50.io/");
    //$q=CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
    //dump($q);
    //print($q[0]['cash']);
    //$cash[]=["cash" => $q["cash"]];
    // render portfolio
    //render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $q[0]["cash"]]);
?>
