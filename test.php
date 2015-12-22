<?php
//set the headers to be a json string
header('content-type: text/json');

include 'db/db_connect.php';

//no need to continue if there is no value in the POST username
if(!isset($_POST['username']))
    exit;

//prepare our query.
$query = $dbh->prepare('SELECT * FROM user_mymovies WHERE user_username = :name');
//let PDO bind the username into the query, and prevent any SQL injection attempts.
$query->bindParam(':name', $_POST['username']);
//execute the query
$query->execute();

//return the json object containing the result of if the username exists or not. The $.post in our jquery will access it.
echo json_encode(array('exists' => $query->rowCount() > 0));
?>