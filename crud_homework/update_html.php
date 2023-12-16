<?php require_once('partial/header.php'); ?>
<?php require_once ('./database/database.php'); ?>
<?php
    $id = intval($_GET['id']);
    $student = selectOnestudent($id);
    foreach ($student as $st){
        
?>
    <div class="container p-4">
        <form action="update_model.php?id=<?php echo $st['id'];?>" method="post">
            
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $st['name']; ?>">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Age" name="age" value="<?php echo $st['age']; ?>" >
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $st['email']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Image URL" name="image_url" value="<?php echo $st['profile']; ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" >Update</button>
            </div>
        </form>
    </div>
<?php }  require_once('partial/footer.php'); ?>


