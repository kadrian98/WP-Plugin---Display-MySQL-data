<?php
class DisplayDataFromDB {

private $conn;

public function __construct(){
    $this->conn = new mysqli('localhost', 'root', '', 'formphp');
    if ($this->conn->connect_error) {
        die('Connection failed: ' . $this->conn->connect_error);
    }
}

public function fetchData(){
    $sql = "SELECT * FROM `formphp`";
    $result = $this->conn->query($sql);

    if (!$result) {
        die('Query failed: ' . $this->conn->error);
    }

    return $result;

}

public function displayData(){
    $result = $this->fetchData();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div id="row-' . $row["id"] . '">';
            echo $row["id"] . " - " . $row["nazwa_klienta"];
            echo ' <button class="btn" data-id="' . $row["id"] . '">Delete</button>';
            echo '</div><br>';
        }
    } else {
        echo "0 results";
    }

    $result->close();
}

public function __destruct() {
    $this->conn->close();
}


}