 <?php
 if (isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data =stripcslashes($data);
        $data =htmlspecialchars($data);
        return $data;
    }
    $uname = $_POST['uname'];
    $uname = $_POST['password'];
    
    if(empty($uname)){
        header("Location: index.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
    }else{
        echo "Valid input";
    }
}else{
    header("Location : index.php?error");
    exit();
 }
