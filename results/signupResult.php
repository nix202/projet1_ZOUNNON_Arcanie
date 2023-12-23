<a href="../">Accueil</a>

<?php
require_once('../functions/function.php');
require_once('../functions/userCrud.php');
require_once('../functions/validation.php');
require_once('../utils/connexion.php');
session_start();

$_SESSION['user_name']=$_POST["user_name"];
$_SESSION['name']=$_POST["lname"];
$_SESSION['fname']=$_POST["fname"];
$_SESSION['email']=$_POST["email"];

// declarations de nos variables
$userName=userNameIsValid($_POST["user_name"]);
$name=l_NameIsValid($_POST["lname"]);
$f_name= f_NameIsValid($_POST["fname"]);
$email=EmailIsValid($_POST["email"]);
$password=pwdIsValid($_POST["pwd"]);
 

if(isset($_POST))
{
    $_SESSION['form_signup']=$_POST;

    unset($_SESSION['errors']);
    $fieldValidation=true;

    if (empty($_POST["user_name"] and $_POST["lname"] and $_POST["fname"] and $_POST["email"] and $_POST["pwd"]))
    {
        $url='../pages/signUp.php';
       
    }
    if($userName["is valid"]== false)
    {
    $fieldValidation= false;
    }
    if($name["is valid"]== false)
    {
        $fieldValidation= false;
        
        
    }if($f_name["is valid"]==false)
    {
        $fieldValidation= false;
        

    }if($email["is valid"]==false)
    {
        $fieldValidation= false;
        
    }
    if($password["is valid"]==false)
    {
        
        $fieldValidation= false;
        
        
    }if($fieldValidation==true )
    {

        var_dump("ma validation est ok");
        $encodePwd=encodePwd($_POST["pwd"]);

        $data=[
            
            "user_name"=>$_POST["user_name"],
            "email"=>$_POST["email"],
            "pwd"=> $encodePwd,
            "fname"=>$_POST["first_name"],
            "lname"=>$_POST["lname"],
           "billing_address_id"=> 1, 
           "shipping_address_id"=>1,
           "token"=>'bonjour', 
           "role_id"=>3,
        ];

        $newUser=createUser($data);

        var_dump($newUser);
        $url='../pages/loginUp.php';
        
    } 
   
    else
    {

        var_dump("ma validation est fausse");

        $_SESSION['errors'] =[
            'user_name' => $userName["message"],
            'name'=> $name["message"] ,
            'lname'=>  $f_name["message"] ,
            'email' => $email["message"],
            'pwd' => $password["message"]
        ];
        var_dump($_SESSION['errors'] );
        $url='../pages/signUp.php';
        
    };

} 
else
{
$url='../pages/signUp.php';
header('location:'.$url);
}

?>
<a href="../pages/loginUp.php"> CONNEXION </a>