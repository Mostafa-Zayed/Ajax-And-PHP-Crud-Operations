<?php
include_once('Crud.php');
$object = new Crud();
if(isset($_POST['action'])){
    if($_POST['action'] === "Load"){
        $statement = "SELECT * FROM `users` ORDER BY `id` DESC";
        echo $object->get_data_in_table($statement);
    }

    if($_POST['action'] === "Insert"){
        $first_name = mysqli_real_escape_string($object->connect,$_POST["first_name"]);
        $last_name = mysqli_real_escape_string($object->connect,$_POST['last_name']);
        if(isset($_FILES['user_image']) && $_FILES['user_image']['name'] !== null){
            $image = $object->upload_file($_FILES['user_image']);

            $statement = "INSERT INTO   `users` (first_name,last_name,image) VALUES ('".$first_name."', '".$last_name."', '".$image."')";
            $object->execute($statement);
            echo "Data Is Inserted Succefuly";
        }
        
    }
    
    
}
?>