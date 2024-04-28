<?php
$identifiant = null;
if (!empty($_POST["identifiant"])) {
    setcookie("identifiant", $_POST["identifiant"]);
//    if (empty($_COOKIE["identifiant"])) {
        
//    }else {
//       $_COOKIE["identifiant"]=$_POST["identifiant"];
 //   }
}
if (!empty($_COOKIE["identifiant"])) {
    $identifiant = htmlentities($_COOKIE["identifiant"]);
}

?>


<?php
require("./header.php");
require("./navigateur.php");
?>




<?php
    if (!empty($identifiant)) {
        echo "Vous êtes identifié en tant : " . $identifiant;
    }

?>
<form action="./SetCookie.php" method="post">
    <input type="text" name="identifiant" id="identifiant">
    <button type="submit">S'identifier</button>
</form>

<?php
var_dump($_COOKIE);
if (!empty($_COOKIE["identifiant"])) {
    echo "Hello ! ";
}

?>



<?php
require("./footer.php");

?>