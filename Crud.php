<?php
class Crud{
    public $connect;
    private $hostName = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $databaseName = 'crud';

    function __construct(){
        $this->connection();
    }
    public function connection(){
        $this->connect = mysqli_connect($this->hostName,$this->userName,$this->password,$this->databaseName);
    }

    public function execute($query){
        return mysqli_query($this->connect,$query);
    }

    public function get_data_in_table($query){
        $output = '';
        $result = $this->execute($query);
        $output .='<table class="table table-bordered table-striped">
                        <tr>
                            <th width="10%">Image</th>
                            <th width="35%">First Name : </th>
                            <th width="35%">Last Name  : </th>
                            <th width="10%">Update </th>
                            <th width="10%">Delete</th>
                        </tr>';
                        while($row=mysqli_fetch_object($result)){
                            $output .='<tr>
                            <td><img src="upload/'.$row->image.'" class="img-thumbnail rounded" width="50" height="35" /></td>
                            <td>'.$row->first_name.'</td>
                            <td>'.$row->last_name.'</td>
                            <td><button type="button" name="update" id="'.$row->id.'" class="btn btn-success btn-xs update">Update</button></td>
                            <td><button type="button name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete">Delete</button></td>
                            </tr>';
                        }
                    $output .='
                   </table>';
                   return $output;

    }

    public function upload_file($file){

        if(isset($file) && $file['name'] !=''){
            
            $extension = explode('.',$file["name"]);
            $new_file = rand().'.'.$extension[1];
            $destination = './upload/'.$new_file;
            move_uploaded_file($file['tmp_name'],$destination);
            return $new_file;
        }
    }
}
?>