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
    if( isset( $_GET['s'] ) ){
        $query .= " WHERE `title` LIKE '%{$_GET['s']}%'";
    }

    $data = mysqli_query( $mysql, $query );
    $data = mysqli_fetch_all( $data, MYSQLI_ASSOC );

    echo json_encode( $data );
}

function addPost( $title, $author ) {
    $title  = trim( strip_tags( $title ) );
    $author = trim( strip_tags( $author ) );

    if( empty( $title ) || empty( $author ) ) {
        return;
    }

    $mysql = connect();
    $query = "INSERT INTO posts (title, author) VALUES ('$title', '$author')";

    mysqli_query( $mysql, $query );
}

if ( ! empty( $_POST ) ) {
    addPost( $_POST['title'], $_POST['author'] );
} else {
    getPosts();
}