<!DOCTYPE html>
<html>
<head>
    <title>curd</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php require_once 'process.php'; ?>
    <?php
    if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>
    <?php endif; ?>
    <div class="container">
    <?php 
    $mysqli = new mysqli('localhost','root','','curd') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    ?>
    <div class="justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php

    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Enter Details</div>
                    <div class="card-body">
                        <form action="process.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter Your Location">
                            </div>
                            <?php if($update == true): ?>
                                <button type="submit" name="update" class="btn btn-info">Update</button>
                            <?php else: ?>
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
</body>
</html>
