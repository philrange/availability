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

function getStatus($event, $person, $date) {

    $sql = "select available from availability where event = " . $event . " and person = " . $person . " and date = " . $date;


    $conn = connectToDb();
    $result = mysqli_query($conn, $sql);

    $available = "undecided";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $available = $row["available"];
            break;
        }
    } 

    mysqli_close($conn);
    return $available;

}

function getDates($event) {
    $sql = "select id, date from dates where event = " . $event . " order by date";

    $conn = connectToDb();
    $result = mysqli_query($conn, $sql);

    $dates = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $date = $row["date"];
            $date_id = $row["id"];
            $dates[$date_id] = $date;
        }
    } else {
        echo "0 results found.";
    }
    
    mysqli_close($conn);
    return $dates;
}

function getPeopleForDate($event, $date, $status) {

    $sql = "SELECT p.username, p.displayName, p.picture, a.available from availability a, people p where a.person = p.id and a.event = " . $event . " and a.date = " . $date . " and a.available = '" . $status . "'";

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

    mysqli_close($conn);
    return $people;
}

    function saveDate($event, $user, $date, $status) {
        $conn = connectToDb();
        $sql = "INSERT INTO availability (event, person, date, available) VALUES(" . $event . ", " . $user . ", " . $date . ", '" . $status . "') ON DUPLICATE KEY UPDATE available='" . $status . "'";
        // echo $sql;
        $result = mysqli_query($conn, $sql);

        $error = "";
        if (!$result) {
            $error = "Error creating user: " . mysqli_error($conn);
        }

        mysqli_close($conn);

        return $error;
    }

    function getEventName($event) {
       $conn = connectToDb();
        $sql = "select name from events where id = " . $event;
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row["name"];
                }
            } else {
                //echo "0 results found.";
                $name = "";
            }
        } else {
            $name =  "Error getting title: " . mysqli_error($conn);
        }

        mysqli_close($conn);

        return $name;
    }

?> 