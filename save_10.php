<?php
  session_start();

  //var_dump($_POST);
  
  $text = $_POST['text'];
  
  $pdo = new PDO("mysql:host=localhost;dbname=task_7;", "root", "");
  
  $sql = "SELECT * FROM my_table WHERE text=:text";
  $statement = $pdo->prepare($sql);
  $statement->execute(['text' => $text]);  
  $task = $statement->fetch(PDO::FETCH_ASSOC); //fetchAll -mnogo zapse fetch - odna zapis iz bd poluchit
  //var_dump($task);die;
  
  if (!empty($task)) {
    $message = "Введенная запись уже присутствует в таблице.";
    $_SESSION['danger'] = $message;
    header("Location: /tasks/task_10.php");
    exit;
  }
  
  $sql = "INSERT INTO my_table (text) VALUES (:text)";
  $statement = $pdo->prepare($sql);  
  $statement->execute(['text' => $text]);

  $message = "Введенная запись уже присутствует в таблице.";
  $_SESSION['success'] = $message;
    
 
  header("Location: /tasks/task_10.php");
   
  


?>

