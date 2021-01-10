<?php
    include "db.inc.php";

    if (isset($_GET['edit_task'])){
        $editor = $_GET['edit_task'];
    }

    if (isset($_POST['edit_task'])){
        $edit_task = $_POST['task'];

        $query = "UPDATE todo SET task_name = '$edit_task' WHERE id = $editor";
        $load = mysqli_query($connection, $query);

        if (!$load){
            die("Failed");
        }else{
            header("Location: index.php?updated");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do Application</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Delius+Unicase:wght@700" rel="stylesheet">
    <link rel="stylesheet" href="styles\style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="list">
    <h1 class="header">To Do Application</h1>
    <form action="" class="item-add" method="post">
        <?php 
            $sql = "SELECT * FROM todo WHERE id = $editor";
            $result = mysqli_query($connection, $sql);
            $data = mysqli_fetch_array($result);
        ?>    
        <input type="text" name= "task" placeholder="Type a task here!" class="input" 
        value = "<?php echo $data['task_name'];?>" autocomplete="off" required>
        <input type="submit" value= "Edit" class="submit" name="edit_task">
    </form>

</body>
</html>

