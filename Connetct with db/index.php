<?php
    include_once ('includes/db.config.php');
    $sql = "SELECT title, ingredients, id FROM pizzas ORDER BY created_at";

    $result = mysqli_query($conn, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

     mysqli_free_result($result);

     mysqli_close($conn);

    

?>
<html lang="en">
<html>
<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
    <div class="row">
        
        <?php foreach($pizzas as $pizza) : ?>
        
        <div class="col s6 md3">
            <div class="card z-depth-0">
               <img src="img/pizza.svg" alt="Pizza" class="pizza">
                <div class="card-content center">
                  <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                  <div><?php foreach(explode(',' , $pizza['ingredients']) as $ing) :?>
                        <li><?php echo htmlspecialchars($ing); ?></li>
                       <?php endforeach; ?>
                  
                  </div>  
                </div>
                <div class="card-action right-align">
                    <a href="detail.php?id=<?php echo $pizza['id'] ?>" class="brand-text">more info</a>
                </div>
            </div>
        </div>
        
        
        
        <?php endforeach; ?>
        
        
        
        <?php if(count($pizzas) >= 3): ?>
<!--        <p>There are there or more pizzas</p>-->
        <?php else: ?>
<!--        <p>Threre are less than 3 pizzas</p>-->
        <?php endif; ?>

        
        
        
    </div>
</div>
<?php include('templates/footer.php'); ?>
    

</html>