<?php
    include "db.php";

    $email = $_GET["email"];
    $message = "";

    //Create connection
    $conn = mysqli_connect($hostname,$username,$password,$database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $call = mysqli_prepare($conn, "Call trad_user_login(?, @message)");
    mysqli_stmt_bind_param($call, 's', $email);
    mysqli_stmt_execute($call);

    $select = mysqli_query($conn, "SELECT @message");
    $result = mysqli_fetch_assoc($select);

    echo json_encode(array("Response" => $result["@message"]));

    mysqli_close($conn);
?>