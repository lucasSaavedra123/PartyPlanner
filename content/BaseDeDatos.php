<?php

function conectarBD() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "partyplanner";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checkear conexión
    if ($conn->connect_error) {
        die("Conexion fallida: " . $conn->connect_error);
    }

    //echo "Conexion EXISTOSA";
    return $conn;
}


function consultaSQL($conn, $sql) 
{   
    $result = $conn->query($sql);
    return $result; 
}


function desconectarBD($conn) 
{
    // cerrar conexión
    $conn->close();
}


//UPDATES
function updateEventName($id,$name){
        $name = ucwords(strtolower($name));
        $connection = conectarBD();
        $sql = "UPDATE events SET name='".$name."' WHERE id='".$id."';";
        consultaSQL($connection, $sql);
        desconectarBD($connection);
}

function updateEventAddress($id,$address){
        $address = ucwords(strtolower($address));

        $connection = conectarBD();
        $sql = "UPDATE events SET address='".$address."' WHERE id='".$id."';";
        consultaSQL($connection, $sql);
        desconectarBD($connection);
}

function updateEventDate($id,$date){
    $connection = conectarBD();
    $sql = "UPDATE events SET date='".$date."' WHERE id='".$id."';";
    consultaSQL($connection, $sql);
    desconectarBD($connection);
}

function updateEventHorary($id,$horary){
    $connection = conectarBD();
    $sql = "UPDATE events SET horary='".$horary."' WHERE id='".$id."';";
    consultaSQL($connection, $sql);
    desconectarBD($connection);
}

function updateGuest($id,$name,$surname,$mail,$table){
    $connection = conectarBD();

    $name = ucwords(strtolower($name));
    $surname = ucwords(strtolower($surname));
    $mail = strtolower($mail);

    $sql = "UPDATE guests SET name = '".$name."', 
                                      surname ='".$surname."', 
                                      mail='".$mail."',
                                      id_table='".$table."' 
                                      WHERE id = '".$id."';"
                                      ;
    consultaSQL($connection, $sql);
    desconectarBD($connection);
}

function updateTable($id,$name){
    $name = ucwords(strtolower($name));
    $connection = conectarBD();
    $sql = "UPDATE tables SET name = '".$name."'
                                      WHERE id = '".$id."';"
                                      ;
    consultaSQL($connection, $sql);
    desconectarBD($connection);
}





//INSERT INTO

function addGuest($name,$surname,$mail,$table){
    $connection = conectarBD();

    $name = ucwords(strtolower($name));
    $surname = ucwords(strtolower($surname));
    $mail = strtolower($mail);

    $sql = "INSERT INTO guests (name,surname,mail,id_table,code) 
            VALUES ('".$name."','".$surname."','".$mail."',".$table.",'".generateCode()."');";
    consultaSQL($connection, $sql);
    desconectarBD($connection);
}

function addTable($id,$name){
    $name = ucwords(strtolower($name));
    $tables = getTables($id);

    $connection = conectarBD();

    $sql = "INSERT INTO tables (name,id_event) VALUES ('".$name."','".$id."');";
    consultaSQL($connection,$sql);
    desconectarBD($connection);
}

function addEvent($id,$name,$address,$date,$hour){
    $name = ucwords(strtolower($name));
    $address = ucwords(strtolower($address));

    $connection = conectarBD();

    $sql = "INSERT INTO events (name,id_user,address,date,horary) 
            VALUES ('".$name."',".$id.",'".$address."','".$date."','".$hour."');";
    consultaSQL($connection,$sql);
    desconectarBD($connection);
}

//SELECTS
function getCodes(){
    $connection = conectarBD();
    $codesList = array();
    $sql = "SELECT code FROM guests;";

    $result = consultaSQL($connection,$sql);

    while ($row = mysqli_fetch_array($result))
        array_push($codesList,$row['code']);

    desconectarBD($connection);

    return $codesList;
}

function getEvent($id){
    $connection = conectarBD();
    $sql = "SELECT * FROM events WHERE id = ".$id.";";
    
    $result = consultaSQL($connection, $sql);
    $result = mysqli_fetch_array($result);

    desconectarBD($connection);

    return $result;
}

function getEventsByUserID($id){
    $events = array();
    $connection = conectarBD();
    $sql = "SELECT * FROM events WHERE id_user = ".$id.";";
    
    $result = consultaSQL($connection, $sql);
    
    while ( $row = mysqli_fetch_array($result) )
        array_push($events,$row);

    desconectarBD($connection);

    return $events;
}

function getUser($id){
    $connection = conectarBD();
    $sql = "SELECT * FROM users WHERE id = ".$id.";";

    $result = consultaSQL($connection, $sql);
    $result = mysqli_fetch_array($result);

    desconectarBD($connection);

    return $result;
}

function getTables($id){
    $connection = conectarBD();
    $tables = array();
    $sql = "SELECT * FROM tables WHERE id_event = ".$id.";";

    $result = consultaSQL($connection, $sql);

    while($table = mysqli_fetch_array($result))
        array_push($tables,$table);

    desconectarBD($connection);

    return $tables;
}

function getGuests($id){
    $connection = conectarBD();
    $guests = array();
    $sql = "SELECT 
        guests.id AS id,
        guests.name AS guestName , 
        guests.surname AS guestSurname , 
        guests.confirmation , 
        guests.mail , 
        guests.id_table AS tableID,
        tables.name AS tableName 
        FROM guests 
        INNER JOIN tables ON guests.id_table=tables.id 
        INNER JOIN events ON events.id = tables.id_event 
        WHERE events.id = ".$id." 
        ORDER BY guests.surname ASC;";

    $result = consultaSQL($connection,$sql);

    while ($row = mysqli_fetch_array($result))
        array_push($guests,$row);

    desconectarBD($connection);

    return $guests;
}

function getGuest($id){
    $connection = conectarBD();

    $sql = "SELECT * FROM guests WHERE id =".$_GET['guestID'].";";
    $result = consultaSQL($connection,$sql);
    $guest = mysqli_fetch_array($result);

    desconectarBD($connection);

    return $guest;
}

function getEventInfo($guestCode){
    $conn = conectarBD();
    $sql = $sql = "SELECT v.name AS eventName,
        v.date AS eventDate,
        v.horary AS eventTime,
        v.address AS eventAddress
                FROM events v
                INNER JOIN tables t ON v.id=id_event
                INNER JOIN guests g ON t.id=id_table
                WHERE g.code='$guestCode'";
    $result=consultaSQL($conn,$sql);
    $event = mysqli_fetch_array($result);
    desconectarBD($conn);

    return $event;
}

//DELETES
function deleteGuest($id){
    $connection = conectarBD();
    $sql = "DELETE FROM guests WHERE id = ".$id.";";
    consultaSQL($connection,$sql);
    desconectarBD($connection);
}

function deleteTable($id){
    $connection = conectarBD();

    $sql = "DELETE FROM guests WHERE id_table = ".$id.";";
    consultaSQL($connection,$sql);

    $sql = "DELETE FROM tables WHERE id = ".$id.";";
    consultaSQL($connection,$sql);

    desconectarBD($connection);
}

function deleteEvent($id){
    $connection = conectarBD();

    $tables = getTables($id);

    for ($arrayIndex=0 ; $arrayIndex < sizeOf($tables) ; $arrayIndex++)
        deleteTable($tables[$arrayIndex]['id']);

    $sql = "DELETE FROM events WHERE id = ".$id.";";
    consultaSQL($connection,$sql);

    desconectarBD($connection);
}



//CHECKS
function checkEmail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    }else {
        return FALSE;
}
}

function checkPassword($password) {
    $regex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
    if (preg_match($regex, $password)) {
        return true;
    } else {
        return false;
    }
}

function checkName($name){
    $regex = "/^([a-zA-Z0-9' ]+)$/";
    if (preg_match($regex, $name)) {
        return true;
    } else {
        return false;
    }
}

function checkGuestCode($guestCode) {
    $regex = "/^(?=.*)(?=.*\d)[\d]{1,}$/";
    if (preg_match($regex, $guestCode)) {
        return true;
    } else {
        return false;
    }
}

function checkNumber($number){
    $regex = "/^[0-9]{1,}$/";

    if (preg_match($regex, $number)) {
        return true;
    } else {
        return false;
    }

}

function checkTableName($id,$tableName){

    $tableName = ucwords(strtolower($tableName));
    
    $tables = getTables($id);

    for ($arrayIndex=0; $arrayIndex < sizeOf($tables); $arrayIndex++) {  
        if ($tables[$arrayIndex]['name'] == $tableName)
            return false;
    }

    return true;
}

//Se fija si es valida esa fecha con respecto al momento en que se la llama
//NOTA: SE le puso dos pq ya exisitia una funcion en PHP que se llamaba checkDate
function checkDate2($date,$hour){
    $regexDate = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
    $regexHour = "/^(([0-1]{1}[0-9]{1})|([2]{1}[0-3]{1})):(([0-5]{1}[0-9]{1}))$/";

    if (preg_match($regexDate, $date) && preg_match($regexHour, $hour)){

        if (getDifferenceOfDate($date,$hour) < 0)
            return false;
        else
            return true;

    }

    return false;

}

function checkAddress($address){
    $regex = "/^[a-zA-Z .]+[0-9]{1,10}$/";

    if (preg_match($regex, $address))
        return true;
    else
        return false;
}





















//FUNCIONES EXTRAS
function generateCode(){

    $codesList = getCodes();
    $generatedCode='';

    $sizeOfCode = 5;

    while( strlen($generatedCode) < $sizeOfCode )
        $generatedCode = $generatedCode.strval(rand(0,9));

    //Evitamos que se repita el codigo
    while (in_array($generatedCode, $codesList)){

        $generatedCode = '';

        while( strlen($generatedCode) < $sizeOfCode )
            $generatedCode = $generatedCode.strval(rand(0,9));

    }

    return $generatedCode;
}

//Obtiene una diferencia en dias con respecto al momento en que se llama a esta funcion
function getDifferenceOfDate($date, $time){
    $hours = substr($time,0,2);
    $minutes = substr($time,3,2);

    $todayDate = strtotime("now");
    $inputDate = strtotime($date." ".$hours." hours ".$minutes." minutes");

    return ($inputDate - $todayDate) / (60 * 60 * 24);
}

function orderByAlphabeticalOrder($list){
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $arrayIndex2 = 0;
    $newArray = array();

    for ($arrayIndex=0; $arrayIndex < strlen($alphabet) ; $arrayIndex++) {

        $letter = $alphabet[$arrayIndex];
        $newArray[$letter] = array();

        if (sizeof($list) != 0 ){

            if ($arrayIndex2 != sizeof($list)){

                while ($list[$arrayIndex2]['guestSurname'][0] == $letter) {
                    array_push($newArray[$letter], $list[$arrayIndex2]);

                    $arrayIndex2++;

                    if ($arrayIndex2 == sizeof($list))
                        break;
                }

            }
        }

    }

    return $newArray;

    }

function orderGuestsByTable($guestsList,$tablesList){

    $tablesNamesList = array();
    $guestsByTableArray = array();

    for ($arrayIndex=0; $arrayIndex < sizeof($tablesList) ; $arrayIndex++){
        $tableName = $tablesList[$arrayIndex]['name'];
        array_push($tablesNamesList,$tableName);
        $guestsByTableArray[$tableName] = array();
    }

    for ($arrayIndex=0; $arrayIndex < sizeof($guestsList); $arrayIndex++) {
        $guest = $guestsList[$arrayIndex];
        array_push($guestsByTableArray[$guest['tableName']], $guest);
    }

    return $guestsByTableArray;
    }



function getGuestsQuantities($guestsList){

    $guestsQuantity = sizeOf($guestsList);
    $deniedGuestsQuantity = 0;
    $confirmatedGuestsQuantity = 0;


    for ($arrayIndex=0; $arrayIndex < $guestsQuantity ; $arrayIndex++) { 
        $confirmation = $guestsList[$arrayIndex]['confirmation'];

        if ($confirmation === '0')
            $deniedGuestsQuantity++;
        elseif ($confirmation === '1')
            $confirmatedGuestsQuantity++;
    }

    return array($guestsQuantity,$confirmatedGuestsQuantity,$deniedGuestsQuantity);
}





function userExists($username,$password){
    $conn = conectarBD();
    $sql = "SELECT * FROM users WHERE mail='$username' and password='$password'";
    $result=consultaSQL($conn,$sql);
    $rows=mysqli_num_rows($result);
    desconectarBD($conn);

    if ($rows>0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function getUserInfo($username,$password){
    $conn = conectarBD();
    $sql = "SELECT * FROM users WHERE mail='$username' and password='$password'";
    $result=consultaSQL($conn,$sql);
    $user = mysqli_fetch_array($result);
    desconectarBD($conn);

    return $user;
}

function usernameExists($username){
    $conn = conectarBD();
    $sql = "SELECT * FROM users WHERE mail='$username'";
    $result=consultaSQL($conn,$sql);
    $rows=mysqli_num_rows($result);
    desconectarBD($conn);

    if ($rows>0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function registerUser($name,$username,$password){
    $conn = conectarBD();
    $sql = "INSERT INTO users (name, mail, password)
            VALUES ('$name', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        return TRUE;
    }else{
        return FALSE;
    }
    desconectarBD($conn);
}

function guestExists($guestCode){
    $conn = conectarBD();
    $sql = "SELECT * FROM guests WHERE code='$guestCode'";
    $result=consultaSQL($conn,$sql);
    $rows=mysqli_num_rows($result);
    desconectarBD($conn);

    if ($rows>0){
        return TRUE;
    }else{
        return FALSE;
    }
}


?>