<?php
    include_once ('includes/db.config.php');
    $email = $title = $ingredients = "";
    $errors = array('email'=>'','title'=>'','ingredients'=>'');
    if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
        
    if(empty($email)) {
        $errors['email'] = "Email is required?<br>";
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be vailted address?<br>"; 
        } 
    }
        
    if(empty($title)) {
        $errors['title'] = "Title is required?<br>";
    } else {
        if(!preg_match('/^[a-zA-Z]*$/',$title)) {
        $errors['title'] = "Title must be vailted letter?<br>"; 
        } 
    }
    
    if(empty($ingredients)) {
        $errors['ingredients'] = "Ingredients is required?<br>";
    } else {
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = "Ingredients must be vailted?<br>"; 
        } 
    }
    
    if(array_filter($errors)) {
        
    } else {
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        
        $sql ="INSERT INTO pizzas (email, title, ingredients) VALUES ('$email', '$title', '$ingredients')";
        
        if(mysqli_query($conn,$sql)) {
            header("Location: index.php");
        } else {
            echo "Query Error" . mysqli_error($conn);
        }
        
        
        
    }
    
        
        
    }
    

    



?>
<html lang="en">
<html>
<?php include('templates/header.php'); ?>

    <secton class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label for="email">Your Email:</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email)?>">
<!--            error sms-->
            <div class="red-text"><?php echo $errors['email'] ?></div>
            <label for="title">Pizza Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title)?>">
            <div class="red-text"><?php echo $errors['title'] ?></div>
            <label for="ingredients">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" id="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
            <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        <div class="center">
            <input type="submit" name="submit" class="btn brand z-depth-0" value="submit">
        </div>
            
            
        </form>
        
        
    </secton>


<?php include('templates/footer.php'); ?>
    

</html>