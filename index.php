<?php
    include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Joseph's Task</title>
</head>
<body>
    

    <section class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="text-center">Joseph's Task</h1>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Start</label>
                        <input class="form-control" type="text" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input class="form-control" type="text" name="deadlineDate" required>
                    </div>
                    <div class="form-group">
                        <label for="">Matkul</label>
                        <input class="form-control" type="text" name="matkul" required>
                    </div>
                    <div class="form-group">
                        <label for="">Task</label>
                        <input class="form-control" type="text" name="task" required>
                    </div>

                    <button class="btn btn-success mt-3" type="submit" name="btnsave">Save</button>
                </form>

                <?php

                    if(isset($_POST['btnsave'])){
                        mysqli_query($connect, "INSERT INTO task (Start, Deadline, Matkul, Task) VALUES
                                        ('$_POST[startDate]',
                                        '$_POST[deadlineDate]',
                                        '$_POST[matkul]',
                                        '$_POST[task]');"
                                    );

                        echo "<script>
                        alert('Data has been saved!');
                        document.location = 'index.php';     
                        </script>";
                    }

                ?>
            </div>
        </div>
    </section>


    <section class="container">
        <div class="card">
            <div class="card-header bg-warning">
                <h1 class="text-center">INI DIA</h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-success ">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Start</th>
                        <th class="bg-danger">Dealine</th>
                        <th>Matkul</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $num = 1;
                        $sql_show = "SELECT * FROM task ORDER BY Deadline ASC;";
                        $result = mysqli_query($connect, $sql_show);

                        while($row = mysqli_fetch_assoc($result)){

                    ?>

                    <tr>
                        <td><?=$num++;?></td>
                        <td><?=$row['Start']?></td>
                        <td><?=$row['Deadline']?></td>
                        <td><?=$row['Matkul']?></td>
                        <td><?=$row['Task']?></td>
                        <td>
                            <a href="index.php?hal=delete&id=<?=$row['id']?>"
                            onclick="return confirm('Are you sure?')"
                            class="btn btn-success btndone">Done</a>
                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                    <?php

                        if(isset($_GET['hal'])){
                            if($_GET['hal'] == "delete"){
                                $sql_delete = "DELETE FROM task WHERE id = '$_GET[id]';";

                                mysqli_query($connect, $sql_delete);
                                
                                echo "<script>
                                    alert('Data has been deleted');
                                    document.location = 'index.php';
                                </script>";
                            }
                        }
                    ?>

                </table>
            </div>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
