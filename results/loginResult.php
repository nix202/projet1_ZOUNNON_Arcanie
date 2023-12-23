<?php 
require_once('../functions/usercrud.php');
require_once('../functions/functions.php');
require_once('../utils/connexion.php');
require_once('../functions/validation.php');
session_start();
$userName=userNameExist($_POST["user_name"]);
if (isset($_POST)){
    unset($_SESSION['errorLogin']);
    $fieldExist=true;
    if(empty($_POST['user_name'] and $_POST['pwd'])){

     $url='../pages/loginUp.php';
        header('location:'.$url);
    }if($userName['exist']==false) {
     $fieldExist=false;
   }if($fieldExist==true){
        $userData= getUserByUsername( $_POST['user_name']);
    
        if($userData){
            $enteredPwdEncoded=encodePwd($_POST['pwd']);
            if($userData['pwd']==$enteredPwdEncoded){
                $token = hash('sha256', random_bytes(32));
                echo '</br></br>Mon token : </br>';
                
                var_dump($token);
                

                echo " le bon mot de passe est correct";
                $data=[
                    'user_name'=>$userData['user_name'],
                    'token'=>$token
                ];
                $updateToken=updateUser($data);

                $_SESSION['authentification']=[
                    'id'=>$userData['id'],
                    'role_id'=>$userData['role_id'],
                    'token'=>$token

                ];
                var_dump($_SESSION['authentification']);

            
            }else { 
                
                $_SESSION['errorLogin'] =[
                    'user_name' => $userName['message'],
                    'pwd' => 'Mot de passe incorrect '];
                    
                    $url='../pages/loginUp.php';
                    header('location:'.$url);

            
            
            }
        }
    }else{
         $_SESSION['errorLogin'] =[
            'user_name' => $userName['message'],
            'pwd' => 'Mot de passe incorrect '];
             $url='../pages/loginUp.php';
             header('location:'.$url);
    }
} else{
   
    $url='../pages/loginUp.php';
    header('location:'.$url);
}

?>
<a href="../pages/accuiel.php"> ACCUIEL</a>