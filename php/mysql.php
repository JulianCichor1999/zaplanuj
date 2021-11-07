<?php

$mysql_server='localhost';
$mysql_user='j.cichor';
$mysql_password='my2Ev9msVwMnsql';
$mysql_db='j.cichor';


$mysqli = new mysqli($mysql_server,$mysql_user,$mysql_password,$mysql_db);


function MySQL_Query($sql){
    global $mysqli;
    $response = [];
    $response['success'] = false;
    $response['message'] = "";
    $response['result'] = [];
    $response['count'] = 0;

    $result = $mysqli->query($sql);
    if ($result) {
        $response['success'] = true;
        $response['message'] = "";
        if(isset($result->num_rows)) $response['count'] = $result->num_rows;
        else $response['count'] = 0;
        for($i=0;$i<$response['count'];$i++){
            $response['result'][] = $result -> fetch_array(MYSQLI_ASSOC);
        }
    }else{
        $response['message'] = '<div class="alert alert-warning" role="alert">'."MySQL error.".'</div>';
    }

    return $response;
}






function User_Create_New($username,$password){
    $response = [];
    $response['success'] = false;
    $response['message'] = "";
    $response['result'] = [];
    $response['count'] = 0;

    if(ctype_alnum($username)==false)
    {
        $response['message'] = '<div class="alert alert-danger" role="alert">'."Login musi składać się z samych liter i cyfr (bez polskich znaków).".'</div>';
        return $response;
    }

    if(strlen($password)<8)
    {
        $response['message'] = '<div class="alert alert-danger" role="alert">'."Hasło jest za krótkie.".'</div>';
        return $response;
    }

    $users = MySQL_Query("SELECT * FROM `uzytkownicy` WHERE `user`=\"".$username."\";");
    if($users['count']>0){
        $response['message'] = '<div class="alert alert-danger" role="alert">'."Istnieje już taki użytkownik."."</div>";
        return $response;
    }
    $users = MySQL_Query("INSERT INTO `uzytkownicy`(`userID`, `user`, `pass`) VALUES (NULL,\"".$username."\",\"".$password."\");");
    $response['success'] = true;
    $response['message'] = '<div class="alert alert-success" role="alert">'."Stworzono uzytkownika. Możesz się już zalgować.".'</div>';

    return $response;
}

function User_Log_In($username,$password){
    $response = [];
    $response['success'] = false;
    $response['message'] = "";
    $response['result'] = [];
    $response['count'] = 0;

    $users = MySQL_Query("SELECT * FROM `uzytkownicy` WHERE `user`=\"".$username."\" AND `pass`=\"".$password."\";");
    if($users['count']>0){
        $response['success'] = true;
        $response['message'] = "Zalogowano.";
        $_SESSION['user'] = $users['result'][0]['userID'];
    }else{
        $response['message'] = '<div class="alert alert-danger" role="alert">'."Nazwa użytkownika albo hasło jest niepoprawne.".'</div>';
    }
    
    return $response;
}

function User_Log_Out(){
    session_destroy();
    //$_SESSION['user'] = 0;
    $response = [];
    $response['success'] = true;
    $response['message'] = '<div class="alert alert-success" role="alert">'."Wylogowano.".'</div>';
    $response['result'] = [];
    $response['count'] = 0;

    return $response;
}

function User_Is_Log_In(){
    $response = [];
    $response['success'] = false;
    $response['message'] = "";
    $response['result'] = [];
    $response['count'] = 0;

    if(isset($_SESSION['user']) && $_SESSION['user']>0){
        $response['success'] = true;
        $response['message'] = '<div class="alert alert-info" role="alert">'."Użytkownik jest zalogowany.".'</div>';
        $response['result'] = $_SESSION['user'];
    }else{
        $response['message'] = '<div class="alert alert-info" role="alert">'."Użytkownik nie jest zalogowany".'</div>';
    }

    return $response;
}


function User_Zadania_Get(){
    $response = User_Is_Log_In();

    if($response['success']){
        $response = MySQL_Query("SELECT * FROM `zadania` WHERE `userID`=\"".$_SESSION['user']."\";");
        if($response['count']==0){
            $response['success'] = false;
            $response['message'] = '<div class="alert alert-info" role="alert">'."Nie masz żadnych zadań."."</div>".'<form method="POST"><input type="text" name="zadanie_nowe" value=""><input type="submit" value="Dodaj"></form>';;
        }
    }

    return $response;
}


function User_Zadanie_Add($zadanie){
    $response = User_Is_Log_In();

    if($response['success']){
        $response = MySQL_Query("INSERT INTO `zadania`(`id`, `userID`, `zadania`, `stan`) VALUES (NULL,\"".$_SESSION['user']."\",\"".$zadanie."\",0);");
    }

    return $response;
}


function User_Zadanie_SetState($zadanieID,$newState){
    $response = User_Is_Log_In();

    if($response['success']){
        $response = MySQL_Query("UPDATE `zadania` SET `stan`=\"".$newState."\" WHERE `id`=\"".$zadanieID."\";");
    }

    return $response;
}

function User_Zadanie_Remove($zadanieId){
    $response = User_Is_Log_In();

    if($response['success']){
        $response = MySQL_Query("SELECT * FROM `zadania` WHERE `userID`=\"".$_SESSION['user']."\" AND `id`=\"".$zadanieId."\";");
        if($response['success']){
            if($response['count']>0){
                $response = MySQL_Query("DELETE FROM `zadania` WHERE `userID`=\"".$_SESSION['user']."\" AND `id`=\"".$zadanieId."\";");
            }else{
                $response['success'] = false;
                $response['message'] = '<div class="alert alert-info" role="alert">'."Nie ma takiego zadania.".'</div>';
            }
        }
    }

    return $response;
}



