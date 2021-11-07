<?php


function Zadanie_Draw_Table($zadania){
    $str = "";
    if($zadania['success']){
        $str .= '<table class="table table-bordered justify-content-center">';
        foreach($zadania['result'] as $key=>$zadanie){
            $str .= '<tr>';
            $str .= '<td>'.$zadanie['zadania'].'</td>';
            if($zadanie['stan']=="0")
            {
                $str .= '<td>Niewykonane</td>';
                $str .= '<td><form method="POST"><input type="hidden" name="zadanieID_skoncz" value="'.$zadanie['id'].'"><input type="submit" value="Oznacz jako skończone"></form></td>';
            }
            else
            {
                $str .= '<td>Wykonane</td>';
                $str .= '<td><form method="POST"><input type="hidden" name="zadanieID_nieskoncz" value="'.$zadanie['id'].'"><input type="submit" value="Oznacz jako niedokończone"></form></td>';
            }
            $str .= '<td><form method="POST"><input type="hidden" name="zadanieID_usun" value="'.$zadanie['id'].'"><input type="submit" name="zadanieAction" value="Usuń"></form></td>';
            $str .= '</tr>';
        }
        $str .= '</table>';
        $str .= '<div><form method="POST"><input type="text" name="zadanie_nowe" value=""><input type="submit" value="Dodaj"></form></div>';
    }else{
        $str .= $zadania['message'];
    }
    return $str;
}



if(isset($_POST['zadanieID_skoncz'])){
    $responseZadanie = User_Zadanie_SetState($_POST['zadanieID_skoncz'],1);
}

if(isset($_POST['zadanieID_nieskoncz'])){
    $responseZadanie = User_Zadanie_SetState($_POST['zadanieID_nieskoncz'],0);
}

if(isset($_POST['zadanieID_usun'])){
    $responseZadanie = User_Zadanie_Remove($_POST['zadanieID_usun']);
}

if(isset($_POST['zadanie_nowe'])){
    $responseZadanie = User_Zadanie_Add($_POST['zadanie_nowe']);
}


echo Zadanie_Draw_Table(User_Zadania_Get());


