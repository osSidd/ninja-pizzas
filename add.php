<?php

    include('config/db_connect.php');

    $email = $title = $ingredients = '';
    $errors = array('email' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $title = $_POST['title'];
        $ingredients = $_POST['ingredients'];

        //check email
        if(empty($email)){
            $errors['email'] = 'An email is required!';
        }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'not a valid email!';
            }
        }

        //check title
        if(empty($title)){
            $errors['title'] = 'A title is required!';
        }
        else{
            if(!preg_match("/^[a-zA-Z\s]+$/", $title)){
                $errors['title'] = 'Title must only contain charcters and space!';
            }
        }

        //check ingredients
        if(empty($ingredients)){
            $errors['ingredients'] = 'At least one ingredient is required!';
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+(,[a-zA-Z\s]+)*$/', $ingredients)){
                $errors['ingredients'] = 'Ingredients must be a comma separated list!';
            }
        }

        if(array_filter($errors)){
            //echo 'errors in form';
        }
        else{
            //echo 'form is valid';
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    
            $sql = "INSERT INTO pizzas(title, ingredients, email) VALUES('$title', '$ingredients', '$email')";
    
            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            }
            else{
                echo "query error: " . mysql_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php require('./templates/header.php') ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label for="email">Your Email</label>
            <input type="text" name="email" value=<?php echo htmlspecialchars($email); ?>>
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label for="title">Pizza title:</label>
            <input type="text" name="title" value=<?php echo htmlspecialchars($title); ?>>
            <div class="red-text"><?php echo $errors['title']; ?></div>

            <label for="ingredients">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value=<?php echo htmlspecialchars($ingredients); ?>>
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>

            <div class="center">
                <input type="submit" class="brand btn z-depth-0" name="submit" value="submit">
            </div>
        </form>
    </section>

    <?php require('./templates/footer.php') ?>

</html>