<?php 

include_once "includes/db.config.php";
if(isset($_POST['delete'])) {
    
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
    $sql ="DELETE FROM pizzas WHERE id = $id_to_delete";
    
    if(mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo 'query error:'.mysqli_error($conn);
    }
}
//check GET request id param
if(isset($_GET['id'])) {
    
    //Security
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql ="SELECT * FROM pizzas WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);
    
    $pizza = mysqli_fetch_assoc($result);
    
    mysqli_free_result($result);
    mysqli_close($conn);
    

}


?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<?php if($pizza): ?>
    <div class="container center">
        <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
        <p><?php echo htmlspecialchars($pizza['email']);?></p>
        <p><?php echo htmlspecialchars($pizza['created_at']);?></p>
        <h5>Ingredients: </h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
        
        <form action="detail.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
            
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    </div>

<?php else: ?>
        <h5>There are no such pizza exit?</h5>

<?php endif; ?>

<?php include('templates/footer.php'); ?>


</html>