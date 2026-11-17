<?php

include('config/db_connect.php');

// kalau tekan butang delete
if (isset($_POST['delete'])) {

    $id_to_delete = (int) $_POST['id_to_delete'];

    $stmt = mysqli_prepare($conn, 'DELETE FROM pizzas WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id_to_delete);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }

}

// ambil pizza ikut id dalam URL
$pizza = null;

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmt = mysqli_prepare($conn, 'SELECT * FROM pizzas WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $pizza = mysqli_fetch_assoc($result);

}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center grey-text">

    <?php if ($pizza) { ?>

        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date('d M Y', strtotime($pizza['created_at'])); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

        <!-- butang edit dan delete -->
        <a href="edit.php?id=<?php echo $pizza['id']; ?>" class="btn brand z-depth-0">Edit</a>

        <form action="details.php" method="POST" style="display:inline-block; margin:0; padding:0;">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    <?php } else { ?>

        <h5>No such pizza exists!</h5>

    <?php } ?>

</div>

<?php include('templates/footer.php'); ?>

</html>