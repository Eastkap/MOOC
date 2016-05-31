<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol">
                <option disabled selected value="">Choose share</option>
        <?php foreach ($positions as $position)
            {
                print("<option value='".$position["symbol"]."'>".$position["shares"]." ".$position["symbol"]." shares. Each of price: ".$position["price"]."</option>");
            }
        ?>
        </select>
        </div>
        <p>How much shares you want to sell?</p>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="shares2sell" placeholder="Shares to sell" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">Sell
            </button>
        </div>
    </fieldset>
</form>
