<?php
session_start();
var_dump($_SESSION);
$user_name = '';
if (isset($_SESSION['signup_form']['user_name'])) {
    $user_name = $_SESSION['signup_form']['user_name'];
}
$email = '';
if (isset($_SESSION['signup_form']['email'])) {
    $email = $_SESSION['signup_form']['email'];
}
$pwd = '';
if (isset($_SESSION['signup_form']['pwd'])) {
    $pwd = $_SESSION['signup_form']['pwd'];
}

//Une autre façon d'écrire ce ternaire pour gagner du temps et des lignes de code :
//isset($_SESSION['pwd']) ? $pwd = $_SESSION['pwd'] : $pwd = '';
?>

<h2>S'enregistrer</h2>
<a href="../">Accueil</a>
<!-- Chaque formulaire a sa page de résultats -->
<!-- Todo : changer les types pour validation front -->
<form method="post" action="../results/signupResult.php">
    <div>
        <label for="user_name">UserName</label>
        <input id="user_name" type="text" name="user_name" value="<?php echo $user_name ?>">
        <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['user_name'])? $_SESSION['signup_errors']['user_name'] : '' ?></p>
    </div>
    

    <div>
        <label for="fname">firstName</label>
        <input id="fname" type="text" name="fname" value="<?php echo $f_Name ?>">
        <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['fname'])? $_SESSION['signup_errors']['fname'] : '' ?></p>
    </div>
    <div>
        <label for="lname">lastName</label>
        <input id="lname" type="text" name="lname" value="<?php echo $l_Name ?>">
        <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['lname'])? $_SESSION['signup_errors']['lname'] : '' ?></p>
    </div>
    
    <!-- utilisation possible du ternaire directement dans la balise : plus simple plus propre -->
    <!-- <input id="user_name" 
        type="text" 
        name="user_name" 
        value="<?php /* echo isset($_SESSION['pwd']) ? $_SESSION['pwd']: '' */ ?>"> -->
    <div>
    <label for="email">Courriel</label>
    <input id="email" type="text" name="email" value="<?php echo $email ?>">
    <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['email'])? $_SESSION['signup_errors']['email'] : '' ?></p>

    </div>
    <div>
    <label for="pwd">Mot de passe</label>
    <input id="pwd" type="text" name="pwd" value="<?php echo $pwd ?>">
    <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['pwd'])? $_SESSION['signup_errors']['pwd'] : '' ?></p>
 
    </div>
    
    
    <button type="submit">Soumettre mon enregistrement</button>
</form>