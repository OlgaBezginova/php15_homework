<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "lesson5");

function connect() {
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

    if( ! $connection ) {
        die();
    }

    return $connection;
}

function getPosts() {
    $mysql = connect();
    $query = "SELECT title, author FROM posts";
    if( isset( $_POST['s'] ) ){
        $query .= " WHERE `title` LIKE '%{$_POST['s']}%'";
    }

    $data = mysqli_query( $mysql, $query );
    $data = mysqli_fetch_all( $data, MYSQLI_ASSOC );

    echo json_encode( $data );
}

echo getPosts();