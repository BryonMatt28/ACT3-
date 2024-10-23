<!-- Database Configuration Code -->
<?php  

$host = "localhost";
$user = "root";
$password = "";
$dbname = "patawaran_a3";
$dsn = "mysql:host={$host};dbname={$dbname}";
$pdo = new PDO($dsn, $user, $password);

?>