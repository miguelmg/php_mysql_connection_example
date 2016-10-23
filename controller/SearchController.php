<?php

/**
 * Class SearchController
 * @autor Miguel Moreno
 * Class with example methods for MYSQL connections
 **/

class SearchController{
    protected $mysqlServer = "<dbserver>";
    protected $mysqlUser = "<usernane>";
    protected $mysqlPassword = "<password>";
    protected $mysqlDBName = "<database>";

    function SearchCrontroller(){
    }

    //Deprecated function for MYSQL
    function SearchMYSQL($productName){
        $conn = mysql_connect($this->mysqlServer, $this->mysqlUser, $this->mysqlPassword, $this->mysqlDBName);

        if (!$conn) {
            die('No pudo conectarse: ' . mysql_error());
        }

        $query_result = mysql_query("SELECT * FROM Product WHERE name LIKE '".mysql_real_escape_string($productName)."';");

        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Quantity</th></tr>";

        while ($line = mysql_fetch_array($query_result, MYSQL_ASSOC)) {
            echo "<tr>";
            foreach ($line as $col_value) {
                echo "<td>$col_value</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
        mysql_close($conn);
    }

    //Function only for MYSQL
    function SearchMYSQLI($productName){
        $conn = new mysqli($this->mysqlServer, $this->mysqlUser, $this->mysqlPassword, $this->mysqlDBName);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $productName = $conn->real_escape_string($productName);

        $sql = "SELECT * FROM Product WHERE name LIKE '$productName';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Quantity</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["quantity"]."</td></tr>";
            }
            echo "</table>";
        }
        $conn->close();
    }

    //Function for different database tecnologies
    function SearchPDO($productName){
        try {
            $conn = new PDO("mysql:host=$this->mysqlServer;dbname=$this->mysqlDBName", $this->mysqlUser, $this->mysqlPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM Product WHERE name LIKE :productName");
            $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Quantity</th></tr>";
                // set the resulting array to associative
                while ($product = $stmt->fetchObject()) {
                    echo "<tr><td>".$product->id."</td><td>".$product->name."</td><td>".$product->quantity."</td></tr>";
                }
                echo "</table>";
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}


