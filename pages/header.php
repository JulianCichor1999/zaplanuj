<?php
    $ResponseIsLogin = User_Is_Log_In();
?>

<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    	<title>zaplanuj.to</title>
    </head>
    <body>
    <header>
    <img src="tasks.png" width="55" height="80" alt="zaplanuj_logo">
        <p>zaplanuj.to</p>  
    </header>
    <nav>
    <ul class="navbar navbar-expand-sm justify-content-center" style="background-color:#ff8080; list-style-type:none;">
            <!--<ul class="navbar-nav">-->
                <li class="nav-item"><a class="nav-link" href="./">Strona główna</a></li>
		<li class="nav-item"><a class="nav-link" href="?page=instrukcja">Instrukcja</a></li>
                <?php if($ResponseIsLogin['success']==false){ ?><li class="nav-item"><a class="nav-link" href="?page=rejestracja">Stwórz konto</a></li><?php } ?>
                <?php if($ResponseIsLogin['success']==false){ ?><li class="nav-item"><a class="nav-link" href="?page=zaloguj_sie">Zaloguj</a></li><?php } ?>
                <?php if($ResponseIsLogin['success']){ ?><li class="nav-item"><a class="nav-link" href="?page=lista">Lista</a></li><?php } ?>
                <?php if($ResponseIsLogin['success']){ ?><li class="nav-item"><a class="nav-link" href="?page=wyloguj_sie" class="menu-element">Wyloguj</a></li><?php } ?>
            <!--</ul>-->
        </ul> 
    </nav>
    <main>
        <div class="container" style="text-align:center;">