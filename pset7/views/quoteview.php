<div>
<?php
   if($_POST["stock"]=''){
       apologize("no blank stock can be found");
       }
    else{
        $stock = lookup($_POST["symbol"]);
        print("A share of ".$stock["name"]." (".$stock["symbol"].") costs <strong>$".number_format($stock["price"],2)."</strong>");
    }
       ?>
</div>