<?php
class adminBlog {

    private $conn;

    public function __construct()
    {
        #database host, database user, database pass, database name
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = "";
        $dbname = 'blogproject';

        $this->conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
        
        if(!$this->conn){
            die("Database Connection Error!!");
        }
    }

    public function admin_login($data){
        $admin_email= $data['admin_email'];
        $admin_pass= md5($data['admin_pass']);

        $query= "SELECT * FROM admin_info WHERE admin_email='$admin_email' && admin_pass='$admin_pass'";

        if(mysqli_query($this->conn, $query)){
            $admin_info= mysqli_query($this->conn, $query);

            if($admin_info){
                header("location:dashboard.php");
                $admin_data= mysqli_fetch_assoc($admin_info);
                session_start();
                $_SESSION['adminID']= $admin_data['id'];
                $_SESSION['admin_name']= $admin_data['admin_name'];
            }
        }
    }
        public function adminlogout(){
            unset ($_SESSION['adminID']);
            unset ($_SESSION['admin_name']);
            header('location: index.php');
        }

        public function add_category($data){
            $cat_name = $data['cat_name'];
            $cat_des = $data['cat_des'];

            $query = "INSERT INTO category(cat_name,cat_des) VALUE('$cat_name','$cat_des')";

            if (mysqli_query($this->conn, $query)){
                return "Category Added Successfully!";
            }
        }
            public function display_category(){
                $query= "SELECT * FROM category";
                
                if(mysqli_query($this->conn, $query)){
                    $category = mysqli_query($this->conn, $query);
                    return $category;
                }
            }
            public function delete_category($id){
                $query= "DELETE from category WHERE cat_id=$id";
                if(mysqli_query($this->conn, $query)){
                    return "Category Deleted Successfully!";
                }
            }
        }