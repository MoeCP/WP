<?php
/**
 * Created by PhpStorm.
 * User: Jajamoo
 * Date: 7/15/16
 * Time: 9:50 AM
 */

print_r($_POST);

function ExtendedAddslash(&$params)
{
    foreach ($params as &$var) {
        // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside.
        is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var);
        unset($var);
    }
}

// Initialize ExtendedAddslash() function for every $_POST variable

//die(print_r($_POST));
ExtendedAddslash($_POST);

$candidate_id = $_POST['candidate_id'];
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$email = $_POST['email'];
$cperm = $_POST['cpermission'];
$published = $_POST['published_work'];
$country = $_POST['country'];

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'cmslocal';

$link = mysqli_connect( $db_host, $db_username, $db_password) or die(mysqli_error($link));
mysqli_select_db($link, "cmslocal");

// search submission ID

$query = "SELECT * FROM `candidates` WHERE `candidate_id` = '$candidate_id'";
$sqlsearch = mysqli_query($link, "SELECT * FROM `candidates` WHERE `candidate_id` = '$candidate_id'");
$resultcount = mysqli_num_rows($sqlsearch);

if ($resultcount > 0) {

    mysqli_query($link, "UPDATE `candidates` SET 
                                `first_name` = '$first',
                                `last_name` = '$last',
                                `email` = '$email'     
                             WHERE `candidate_id` = '$candidate_id'")
    or die(mysqli_error($link));

} else {

    mysqli_query($link, "INSERT INTO `candidates` (candidate_id, first_name, last_name, 
                                                                          email, cpermission, published_work, country) 
                               VALUES ($candidate_id, '$first', '$last', 
                                                 '$email', '$cperm', '$published', '$country') ")
    or die(mysqli_error($link));

}

?>