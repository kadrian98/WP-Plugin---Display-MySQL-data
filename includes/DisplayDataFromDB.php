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
        echo '<table class="data-table">';
        echo '<tr><th>ID</th><th>Nazwa Klienta</th><th>Email Klienta</th><th>Wiadomość</th><th>Akcje</th></tr>'; // Nagłówki tabeli
        while($row = $result->fetch_assoc()) {
            echo '<tr id="row-' . $row["id"] . '">';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["nazwa_klienta"] . '</td>';
            echo '<td>' . $row["email_klienta"] . '</td>';
            echo '<td>' . $row["wiadomosc"] . '</td>';
            echo '<td><button class="btn" data-id="' . $row["id"] . '">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }

    $result->close();
}

public function __destruct() {
    $this->conn->close();
}


}