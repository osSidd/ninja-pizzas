<?php

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    $id = $_GET['id'];
    if(isset($id)){
        $id = mysqli_real_escape_string($conn, $id);

        $sql = "SELECT * FROM pizzas WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php require('./templates/header.php') ?>

        <div class="container center">
            <?php if($pizza): ?>
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                
                <p>Created By: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p>Created At: <?php echo date($pizza['created_at']); ?></p>

                <h5>Ingredients</h5>
                <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

                <form action="detail.php" method="POST">
                    <input type="hidden" name="id_to_delete" value=<?php echo $pizza['id'] ?>>
                    <input type="submit" value="Delete" name="delete" class="brand btn z-depth-0">
                </form>

            <?php else: ?>
                <h5>No such pizza exists</h5>
            <?php endif; ?>
        </div>

    <?php require('./templates/footer.php') ?>

</html>