<!DOCTYPE html>
<html>
    <head>
        <title>index</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class='row'>
                <div class='col-md-12'>
                    <h3 align="center"> PHP Ajax Crud</h3>
                </div>
            </div>
            <div>
                <form method="post" id="user_form">
                    <div class='form-group'>
                        <label>Enter First Name : </label>
                        <input type="text" name="first_name" id="first_name" class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label>Enter Last Name  : </label>
                        <input type="text" id="last_name" name="last_name" class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label>Select User Image :</label>
                        <input type="file" name="user_image" id="user_image">
                        <input type="hidden" name="action" id="action" class='form-control-file'>
                    </div>
                    <div class='form-group'>
                        <input type="submit" name="button_action" id="button_action" value="Insert" class='btn btn-primary'>
                    </div>
                </form>
            </div>
            <div id="user_table" class="table-responsive">
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        load_data();
        $('#action').val("Insert");
        function load_data(){
            var action = "Load";
            $.ajax({
                url:"action.php",
                method: "POST",
                data:{action:action},
                success:function(data){
                    $("#user_table").html(data);
                }
            });
        }
        
        // Handel Form 
        $("#user_form").on('submit',function(event){
            event.preventDefault();
            var firstName = $("#first_name").val();
            var lastName = $("#last_name").val();
            var extension = $("#user_image").val().split('.').pop().toLowerCase();
            
            // Check if extension is exists
            if(extension != ''){
                
                if(jQuery.inArray(extension,['gif','png','jpg','jpeg']) == -1){
                    alert('Invalid Image');
                    $("#user_image").val('');
                    return false;
                }

            }

            // Check Form 
            if(firstName != '' && lastName != '' && extension != ''){
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        alert(data);
                        $('#user_form')[0].reset();
                        load_data();
                    }

                });
            }else{
                alert('Both Fildes Are Requireds!!');
            }
        });
    });
</script>