<?php
require __DIR__. '/__connect_db.php';
  
$result=$pdo->query('SELECT * FROM e_list WHERE e_name');
    
while($row=$result->fetch()){
    echo "e_name".$row['e_name'];
    }
    ?>
?>