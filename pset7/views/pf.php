<form action="profile.php" method="post">
    <fieldset>
        <center><h2>To Change your password</h2></center>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="oldp" placeholder="Old Password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="np" placeholder="New Password" type="password"/>
            <input class="form-control" name="npc" placeholder="Confirm New Password" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-register"></span>
                Change password
            </button>
        </div>
       <center><h2>To Deposit more funds</h2></center>
       <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="p" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="f" placeholder="Funds" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-register"></span>
                Add funds
            </button>
        </div>
    </fieldset>
</form>
