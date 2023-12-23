<?php
//require("./utils/connexion.php");
// 
function createUser($data)
{
    global $conn;
var_dump('Dans mon create user');
    var_dump($data);

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO user (`user_name`, `email`, `pwd`, `fname`, `lname`, `billing_address_id`, `shipping_address_id`, `token`, `role_id`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_prepare($conn, $query);
   var_dump($stmt);
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param(
            $stmt,
            "sssssiisi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['fname'],
            $data['lname'],
            $data['billing_address_id'],
            $data['shipping_address_id'],
            $data['token'],
            $data['role_id']
        );

        
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            
            return 'Ca fonctionne!!!!!!!!!!';
        } else {
            
            return 'Erreur lors de l\'exécution de la requête : ' . mysqli_error($conn);
        }
        
        
        mysqli_stmt_close($stmt);
    } else {
    
        return 'Erreur lors de la préparation de la requête : ' . mysqli_error($conn);
    }
}

function updateUser($data) {
    global $conn;

    $query = "UPDATE user SET token=? WHERE user_name=?";
    
   
    if ($stmt = mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param($stmt, "ss", $data["token"], $data["user_name"]);


        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Modification réussie";
        } else {
           
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
        }

        
        mysqli_stmt_close($stmt);
    } else {
        
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($conn);
    }
}
    function updateUserByAdmin($data){
    global $conn;
    $query= "UPDATE user SET role_id=? WHERE user_name=?";
    if($stmt=mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param($stmt,"is", 
          $data["role_id"],
        $data["user_name"] );
        $result=mysqli_stmt_execute($stmt);
    echo "<br>";
    echo "modification reussie";
    var_dump($result);
    echo "<br>";
    }
    
    return $result;
    
    }
function getUserByUsername($user_name)
{
    global $conn;

    
    $query = "SELECT * FROM user WHERE user_name = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param($stmt, "s", $user_name);

       
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

       
        mysqli_stmt_close($stmt);

        return $data;
    } else {
        
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($conn);
        return null; 
}
}
function deleteUser($user_name){
    
    global $conn;
    $query= "DELETE FROM user WHERE user_name=?";
    if($stmt=mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt,
        "s",
        $user_name);

$result=mysqli_stmt_execute($stmt);
echo "<br>";
echo "supression  reussie";
var_dump($result);
echo "<br>";
}
return $result;
}
function getAllUser( )
{
    global $conn;

    $query = "SELECT * FROM user  ;";
    $result = mysqli_query($conn, $query);
   
    $data = mysqli_fetch_all($result);
    return $data;
}

    

    
    // products

function createProduct($data){
    global $conn;
    $query="INSERT into product VALUES(NUll,?,?,?,?,?)";
    $stmt= mysqli_prepare($conn,$query);
    var_dump($stmt);
printf("Error message: %s\n", mysqli_error($conn)); 
    if($stmt){

        mysqli_stmt_bind_param(
            $stmt,
            "sidss",
            $data['name'],
            $data['quantity'],
            $data['price'],
            $data['img_url'],
            $data['description']
        );
    $result = mysqli_stmt_execute($stmt);
    }
    return $result;
}
function getProductById( $id)
{
    global $conn;

    $query = "SELECT * FROM product WHERE id = '$id' ;";
    $result = mysqli_query($conn, $query);
    
    $data = mysqli_fetch_assoc($result);
    return $data;
}
function getProductByIdPannier($id)
{
    global $conn;
    $query = "SELECT * FROM product WHERE id = '$id' ;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}
 function updateProduct($data){
    global $conn;
    $query= "UPDATE product SET name=?,quantity=?,price=?,img_url=?,description=? WHERE id=?";
    if($stmt=mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param($stmt,"sidssi", 
       
        $data["name"],
         $data["quantity"],
         $data["price"],
         $data["img_url"],
         $data["description"],
         $data["id"]

         
         


        );
    
    // execution de la requete 
    $result=mysqli_stmt_execute($stmt);
    echo "<br>";
    echo "modification reussie";
    var_dump($result);
    echo "<br>";
    }
    return $result;
}

function afficher() {
    global $conn;

    // Vérifier la connexion
    if (!$conn) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Préparer la requête SQL
    $req = mysqli_prepare($conn, "SELECT * FROM product ORDER BY id DESC");

    // Vérifier si la préparation de la requête a échoué
    if (!$req) {
        die("Erreur de préparation de la requête : " . mysqli_error($conn));
    }

    // Exécution de la requête préparée
    mysqli_stmt_execute($req);

    $result = mysqli_stmt_get_result($req);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Fermer la requête préparée
    mysqli_stmt_close($req);

    // Fermer la connexion à la base de données
    mysqli_close($conn);

    return $data;
    var_dump($data);
}

function getProductByName( $name)
{
    global $conn;  

    $query = "SELECT * FROM product WHERE name = '$name' ;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result);
    return $data;
}

    function supprimer($id)
    {
        
        global $conn;
        $query= "DELETE FROM product WHERE id=?";
        if($stmt=mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id);
    
    
    // execution de la requete 
    $result=mysqli_stmt_execute($stmt);
    echo "<br>";
    echo "supression  reussie";
    var_dump($result);
    echo "<br>";
    }
    return $result;
    
    }

?>