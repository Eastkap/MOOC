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
                "name" => $stock["name"],
                "price" => number_format($stock["price"],2),
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
                ];
            }
        }
    $q=CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
    //dump($q);
    //print($q[0]['cash']);
    //$cash[]=["cash" => $q["cash"]];
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $q[0]["cash"]]);

?>
