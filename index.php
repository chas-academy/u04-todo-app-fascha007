<?php
    include "db.inc.php";

    $query = "SELECT * FROM todo";
    $result = mysqli_query($connection, $query);

    //create a task 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $task = $_POST['task'];
        $date = date('jS \of F Y h:i:s');
        $sql = "INSERT INTO `todo` (`task_name`, `created`) VALUES ('$task', '$date');";
        $results = mysqli_query($connection, $sql);
    //     if (!$results){
    //         die("Failed");
    //     }else{
    //         header("Location:form.php?task-added");
    //    }
    }
    //delete task
    if (isset($_GET['del_task'])){
        $deleteTask =  $_GET['del_task'];
        $sqldel = "DELETE FROM todo WHERE id = $deleteTask";
        $show = mysqli_query ($connection, $sqldel);

        // if (!$show){
        //     die("Failed");
        // }else{
        //     header("Location: form.php?task-deleted");
        // }
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
    <div class="container">
    <div class="list">
    <h1 class="header">To Do Application</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="add_form" method="POST">    
        <input type="text" name= "task" placeholder="Type a task here!" class="input" autocomplete="off" required>
        <input type="submit" value= "Add" class="submit">
    </form>
    </div>
    <div class = "list">
        <table class = "table table-striped">
            <thead>
                <th>ID</th>
                <th>To Do</th>
                <th>Created</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Done</th>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $task =$row['task_name'];
                        $date = $row['created'];
                        ?>
                
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $task;?></td>
                    <td><?php echo $date;?></td>
                    <td><a href="edit.php?edit_task=<?php echo $id; ?>" 
                    class="edit-button">Edit</a> </td>
                    <td><a href="index.php?del_task=<?php echo $id; ?>" 
                    class="del-button">Delete</a> </td>
                    <td>
                    <button onclick ="myFunction()" class = "btn btn-success" id="check_box">Mark as done</button>
                    </td>

                </tr>

                <?php }
                
                ?>
                
            </tbody>
        </table>
    
    </div>
    </div>
    <script>
    function myFunction() {
    document.getElementById("check_box").innerHTML = "completed";
    }
    </script>
</body>
</html>