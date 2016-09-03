<?php

function connectToDb() {
    $servername = DB_HOST;
    $username = DB_USER;
    $password = DB_PASSWORD;
    $dbname = DB_NAME;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    return $conn;
}

function getDates($event) {
    $sql = "select date from dates where event = " . $event;

    $conn = connectToDb();
    $result = mysqli_query($conn, $sql);

    $dates = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $date = $row["date"];
            $dates[] = $date;
        }
    } else {
        echo "0 results found.";
    }

    return $dates;
}

function getPeopleForDate($event, $date, $status) {

    $sql = "SELECT p.username, p.displayName, p.picture, a.available from availability a, people p, dates d where a.person = p.id and a.date = d.id and a.event = " . $event . " and d.date = '" . $date . "' and a.available = '" . $status . "'";

    return getPeople($sql);
}


function getPeople($sql) {

    $conn = connectToDb();

    $result = mysqli_query($conn, $sql);

    $people = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            // $id = $row["id"];
            $username = $row["username"];
            $displayName = $row["displayName"];
            $picture = $row["picture"];
            $available = $row["available"];


            $person = new Person($username, $displayName, $picture, $available);
            $people[] = $person;
        }
    } else {
        //echo "0 results found.";
    }

    return $people;
}





//mysqli_close($conn);


?> 