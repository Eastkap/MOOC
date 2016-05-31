<?php

    // configuration
    require("../includes/config.php"); 
    $rows=CS50::query("SELECT * FROM portfolios WHERE id=?",$_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                
                $positions[] = [
                "price" => number_format($stock["price"],2),
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
                ];
            }
        }
    //dump($positions);
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        if(count($positions)!=0){
            render("sellform.php", ["title" => "Sell","positions" => $positions]);
            
        }
        else{
            apologize("Nothing to sell, because you have no shares!");
        }
        
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        print('<img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif">');
        $shares=CS50::query("SELECT shares FROM portfolios WHERE id=? AND symbol=?",$_SESSION["id"], $_POST["symbol"]);
        $share=$shares[0]["shares"];
        $check=preg_match("/^\d+$/", $_POST["shares2sell"]);
        if($_POST["shares2sell"]>$share || $check==false){
            apologize("Operation cannot be done, you don't have that many shares!");
        }
        else if($_POST["shares2sell"]==$share){
            $q=CS50::query("DELETE FROM portfolios WHERE id = ? AND symbol = ?",$_SESSION["id"],$_POST["symbol"]);
            foreach ($positions as $position)
            {
                if($position["symbol"]==$_POST["symbol"]){
                    $price=$position["price"];
                }
            }
            $p=CS50::query("UPDATE users SET cash=cash+? WHERE id =?",$_POST["shares2sell"]*$price,$_SESSION["id"]);
            CS50::query("INSERT INTO history (Transaction,symbol,shares,price,uid) VALUES(?,?,?,?,?)",'SELL',$_POST["symbol"],$_POST["shares2sell"],$price,$_SESSION["id"]);
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
            CS50::query("INSERT INTO history (Transaction,symbol,shares,price,uid) VALUES(?,?,?,?,?)",'SELL',$_POST["symbol"],$_POST["shares2sell"],$price,$_SESSION["id"]);
            
        }
    }
    redirect("/");
    //$q=CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
    //dump($q);
    //print($q[0]['cash']);
    //$cash[]=["cash" => $q["cash"]];
    // render portfolio
    //render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $q[0]["cash"]]);
?>
