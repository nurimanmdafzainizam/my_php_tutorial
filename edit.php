<?php

include('config/db_connect.php');

$id = 0;
$title = $email = $ingredients = '';
$pizza_found = false;
$errors = array(
    'email' => '',
    'title' => '',
    'ingredients' => ''
);

if (isset($_POST['submit'])) {

    $id = (int) $_POST['id'];
    $pizza_found = true;

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check title
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required <br />';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    // check ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingredient is required <br />';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be a comma separated list';
        }
    }

    if (!array_filter($errors)) {

        // kemaskini pizza dalam database
        $stmt = mysqli_prepare($conn, 'UPDATE pizzas SET title = ?, email = ?, ingredients = ? WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'sssi', $title, $email, $ingredients, $id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: details.php?id=' . $id);
            exit;
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }

    }

} elseif (isset($_GET['id'])) {

    // ambil data pizza yang nak diedit
    $id = (int) $_GET['id'];

    $stmt = mysqli_prepare($conn, 'SELECT * FROM pizzas WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $pizza = mysqli_fetch_assoc($result);

    if ($pizza) {
        $pizza_found = true;
        $title = $pizza['title'];
        $email = $pizza['email'];
        $ingredients = $pizza['ingredients'];
    }

}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">

    <?php if ($pizza_found) { ?>

        <h4 class="center">Edit Pizza</h4>
        <form class="white" action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="Save" class="btn brand z-depth-0">
            </div>
        </form>

    <?php } else { ?>

        <h5 class="center">No such pizza exists!</h5>

    <?php } ?>

</section>

<?php include('templates/footer.php'); ?>

</html>