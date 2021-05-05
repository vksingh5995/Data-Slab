<?php
    // write your code here
    // wp_send_json(  $_POST  );

    global $wpdb;
    $tablename = $wpdb->prefix . "dataslab";

    if( !isset( $_POST['updateId'] ) or !isset( $_POST['name'] ) or !isset( $_POST['username'] ) or !isset( $_POST['email'] ) or !isset( $_POST['phone'] )){
        wp_send_json( array(
            "status" => "failed",
            "message" => "Invalid data send!"
        ));
        wp_die();
    }

    $id = $_POST['updateId'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "UPDATE " . $tablename . " SET name='". $name ."', username='". $username ."', email='". $email ."', phone='". $phone ."' WHERE id='". $id . "'";
    
    ob_start();
        $query_response = $wpdb->query( $query );        
    ob_end_clean();

    if( $query_response === false ) {
        $response_message = "Database Query Failed!";
        $status = "failed";
    }
    elseif( $query_response === 0 ) {
        $response_message = "Database already updated!";
        $status = "success";
    }
    else{
        $response_message = "Database updated successfully!";
        $status = "success";
    }
    wp_send_json( array(
        "status" => $status,
        "message" => $response_message
    ) );

    // End request
    wp_die();
