<?php


//ninja uusi toimiva

    error_reporting(0);
    mysqli_report(MYSQLI_REPORT_OFF);
    $mysqli = new mysqli('db1.n.kapsi.fi:3306','raikkulenz', 'xNYvFvQzMY','raikkulenz');
    
    //$mysqli = new mysqli('127.0.0.1','shaun', 'Uintikoulu331','packetcode-tut');
    if ($mysqli->connect_errno) {
        throw new RuntimeException('mysqli connection error: ' . $mysqli->connect_error);
    }
    
    /* Set the desired charset after establishing a connection */
    $mysqli->set_charset('utf8mb4');   /* utf8mb4 */
    if ($mysqli->errno) {
        throw new RuntimeException('mysqli error: ' . $mysqli->error);
    }

    //Get numer of rows in table

    //$sql="SELECT COUNT(*) as total FROM data";
    //$rows_number = mysqli_query($mysqli, $sql);


    $sql1="select count(*) as total from data";
    $result=mysqli_query($mysqli,$sql1);
    $max_number_of_rows=mysqli_fetch_assoc($result);
    //echo $max_number_of_rows['total'];

   
    // Get data to display on index page
    $sql = "SELECT * FROM ( SELECT * FROM data ORDER BY id DESC LIMIT 8) as r ORDER BY id desc";
    //$sql = "SELECT * FROM data";
    $query = mysqli_query($mysqli, $sql);

    // Create a new post
    if(isset($_REQUEST['new_post'])){
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];

        $sql = "INSERT INTO data(title, content) VALUES('$title', '$content')";
        mysqli_query($mysqli, $sql);

        //echo $sql;

        //header("Location: blog1_index.php?info=added");
        header("Location: blog1_index.php");
        echo "<meta http-equiv='refresh' content='0'>"; // oooooooooooooooooooooooo
        exit();
    }

    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM data WHERE id = $id";
        $query = mysqli_query($mysqli, $sql);
        
    }

    // Delete a post
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM data WHERE id = $id";
        mysqli_query($mysqli, $sql);
        
        header("Location: blog1_index.php");
        echo "<meta http-equiv='refresh' content='0'>"; // oooooooooooooooooooooooo
        exit();
        
    }

    // Update a post
    if(isset($_REQUEST['update'])){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];

        $sql = "UPDATE data SET title = '$title', content = '$content' WHERE id = $id";
        mysqli_query($mysqli, $sql);
        
        header("Location: blog1_index.php");
        echo "<meta http-equiv='refresh' content='0'>"; // oooooooooooooooooooooooo
        exit();
       
    }






?>
