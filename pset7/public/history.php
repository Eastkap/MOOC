<?php

    // configuration
    require("../includes/config.php"); 
    $rows=CS50::query("SELECT * FROM history WHERE uid=?",$_SESSION["id"]);
    //dump($rows);
    render("historyview.php", ["rows" => $rows, "title" => "History"]);

?>
