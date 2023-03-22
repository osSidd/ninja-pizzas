<?php

    //connect to the database
    include('config/db_connect.php');

    //write query for all pizzas
    $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

    //make a query and get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <?php require('./templates/header.php') ?>

    <h4 class="center grey-text">Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza): ?>
                
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="pizza.svg" alt="pizza" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <div>
                                <ul>
                                    <?php foreach(explode(',',$pizza['ingredients']) as $ing): ?>
                                        <li><?php echo $ing ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-action right-align">
                            <a href="detail.php?id=<?php echo $pizza['id']; ?>" class="brand-text">More Info</a>
                        </div>
                    </div>
                </div>
                
            <?php endforeach ?>
        </div>
    </div>

    <?php require('./templates/footer.php') ?>

</html>