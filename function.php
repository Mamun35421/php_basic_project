<?php
class crudApp{
    private $conn;

    public function __construct(){
        #database connet 4ta jinis lagbe->database host, db user, db pass, db name


        $dbhost = "localhost";
        $dbuser = 'root';
        $dbpass = "";
        $dbname = "crudapp";


        $this->conn= mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

        if(!$this->conn){
            die("Database Connection Error!!");
        }
    }

    public function add_data($data){
        $std_name = $data['std_name'];
        $std_id   = $data['std_id'];

        //any file pass $file super gupper er maddhume 
        $std_img =  $_FILES['std_img']['name'];

        //FILE ER  NAME ER STORE KORAR JONNO

        $tmp_name = $_FILES['std_img']['tmp_name'];



        $query = "INSERT INTO students(std_name,std_roll,std_img)  VALUE('$std_name', $std_id,'$std_img')";

///database data send korar jonno mysqli_query use kora hoi 
         if(mysqli_query($this->conn, $query)){
            move_uploaded_file($tmp_name,'upload/'.$std_img); //pic file e rakha hoi 
            return "Information sucessfully added";
         }
    }

    public function display_data(){
        $query = "SELECT * FROM  students ";

        if(mysqli_query($this->conn ,$query)){
            $returndata = mysqli_query($this->conn,$query);

            return $returndata;
        }
    }


    public function display_data_by_id($id){
        $query = "SELECT * FROM  students WHERE id=$id ";

        if(mysqli_query($this->conn ,$query)){
            $returndata = mysqli_query($this->conn,$query);
            $studentData = mysqli_fetch_assoc($returndata);

            return $studentData;
        }
    }

    public function update_data($data){
        $std_name = $data['u_std_name'];
        $std_roll = $data['u_std_id'];
        $idno = $data['std_id'];
        $std_img = $_FILES['u_std_img'] ['name'];
        $tmp_name = $_FILES['u_std_img'] ['tmp_name'];


        $query = "UPDATE students SET std_name='$std_name', std_roll=$std_roll, std_img='$std_img'  WHERE id=$idno";

        if(mysqli_query($this->conn ,$query)){

            move_uploaded_file($tmp_name, 'upload/'.$std_img);
            return "Infomartion Updated SucessFully!";
        }
    }

    public function  delete_data($id){
        $query = "DELETE FROM students WHERE id=$id";
        if(mysqli_query($this->conn ,$query)){
            return "Infomartion Delete SucessFully!";
        }
       
    }
}


?>