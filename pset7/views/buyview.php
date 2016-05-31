<div>
<?php
   if($symbol=''){
       apologize("no blank stock can be found");
       }
    else{
        $symbol=strtoupper($_POST["symbol"]);
        $stock = lookup($symbol);
        $c2pay= $stock["price"]*$_POST["buy"];
        if($c2pay>$cash){
            apologize("You don't have enough paper nigga!");
        }
        CS50::query("UPDATE users SET cash=cash-? WHERE id=?",$c2pay,$_SESSION["id"]);
        CS50::query("INSERT INTO portfolios (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)",$_SESSION["id"],$symbol,$_POST["buy"]);
        CS50::query("INSERT INTO history (Transaction,symbol,shares,price,uid) VALUES(?,?,?,?,?)",'BUY',$symbol,$_POST["buy"],$stock["price"],$_SESSION["id"]);
    }
        redirect("/");
       ?>
</div>