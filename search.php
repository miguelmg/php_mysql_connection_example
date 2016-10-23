<?php

require ('controller/SearchController.php');

$searchController = new SearchController();

echo "<h2>Connection with MYSQL</h2> <br>";
$searchController->SearchMYSQL($_POST['productName']);
echo "<h2>Connection with MYSQLi</h2> <br>";
$searchController->SearchMYSQLI($_POST['productName']);
echo "<h2>Connection with PDO</h2> <br>";
$searchController->SearchPDO($_POST['productName']);