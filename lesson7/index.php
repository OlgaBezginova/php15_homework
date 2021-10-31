<?php

$email = '';
$phone = '';
$email_msg = '';
$phone_msg = '';
$success_msg = '';

$required_text = '<div class="alert alert-danger" role="alert">
                        The field <strong>%s</strong> is required!
                     </div>';
$success_text = '<div class="alert alert-success" role="alert">
                    Success! Your data has been sent to the server<br>
                    <strong>Email</strong>: %s<br>
                    <strong>Phone</strong>: %s<br><br>
                    <a href="" class="alert-link">X Close</a>
                 </div>';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $post = true;
    $success = true;

    if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {
        $email = $_POST['email'];
    } else {
        $email_msg = sprintf( $required_text, 'Email' );
        $success = false;
    }

    if ( isset( $_POST['phone'] ) && ! empty( $_POST['phone'] ) ) {
        $phone = $_POST['phone'];
    } else {
        $phone_msg = sprintf( $required_text, 'Phone' );
        $success = false;
    }

    if ( $success ) {
        $success_msg = sprintf( $success_text, $email, $phone );
        $email = '';
        $phone = '';
    }
}

require_once 'form.php';