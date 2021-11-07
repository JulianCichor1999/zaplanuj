<?php
$ResponseRegister = null;
    if(isset($_POST['login']) && isset($_POST['haslo'])){
        $ResponseRegister = User_Create_New($_POST['login'],$_POST['haslo']);
        $_POST['login'] = "";
        $_POST['haslo'] = "";
    }
?>


<form action="" method="post" class="form-container">
    <div class="form-group">
        <div class="form-group form-group-lg">
            <label for="usr">Login:</label>
            <input type="text" class="form-control input-lg" id="usr" name="login" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>">
        </div>
        <div class="form-group form-group-lg">
            <label for="pwd">Hasło:</label>
            <input type="password" class="form-control input-lg" id="pwd" name="haslo" value="<?php if(isset($_POST['haslo'])) echo $_POST['haslo']; ?>">
        </div>
        <input type="submit" value="Zarejestruj się" class="btn btn-block" style="background-color:#FFEFBA;"/>
    </div>
<?php
    if($ResponseRegister){
        echo $ResponseRegister['message'];
    }
?>
</form>