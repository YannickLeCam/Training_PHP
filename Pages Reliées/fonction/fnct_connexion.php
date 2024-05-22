<?php
$BDD = [
    [
        "id" => "admin",
        "mail"=>"admin@admin.fr",
        "password"=>"admin"
    ],
    [
        "id" => "client",
        "mail"=>"client@client.fr",
        "password"=>"client"
    ]
];

function getAccountArray(){
    //faire toute les conditions de possible erreur..
    $PDO = new PDO("sqlite:data\account.db");
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    try {
        $query = $PDO->query("SELECT * FROM account");
        $data = $query->fetchAll(PDO::FETCH_NAMED);
        return $data;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}

function insertAccount(string $username , string $mail , string $password){
    $PDO = new PDO("sqlite:data\account.db");
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    try {
        $query = $PDO->prepare("INSERT INTO account (username, mail, password) VALUES (:username, :mail, :password)");
        $query->bindParam(":username", $username);
        $query->bindParam(":mail", $mail);
        $query->bindParam(":password", $password);
        if($query->execute()){
            return true;
        }else {
            return false;
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
        return $error;
    }
}
//Cette fonction prends le mail et le mot de passe d'un utilisateur le compare dans la BDD si il correspond alors il renvois un tableau avec son id et son mail son renvois un tableau Vide
function isExistAccount($mail , $password):array{
    $fileaddr = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "account.txt";
    $file=getAccountArray();
    $password=hash("sha256",$password);
    foreach($file as $ligne){
        if ($password == $ligne["password"] & $mail == $ligne["mail"]) {
            $retour = [];
            $retour["id"]= $ligne["username"];
            $retour["mail"]= $ligne["mail"];
            $retour["isadmin"]=$ligne["isadmin"];
            return $retour;
        }
    }
    return [];
}
//
//Cette fonction prend le mail , le password et son identifiant de la personne lorsque le compte veut etre créer si l'un des traits est identique alors cela renvoie true sinon false
function isExistAccountRegister($mail , $password , $id):bool{
    $fileaddr = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "account.txt";
    $file=getAccountArray();
    $password=hash("sha256",$password);
    foreach($file as $ligne){
        if ($password == $ligne["password"] | $mail == $ligne["mail"] | $id == $ligne["username"]) {
            return true;
        }
    }
    return false;
}

function isEmail(string $email) :bool {
    // Expression régulière pour valider une adresse e-mail
    $regex = "/^\S+@\S+\.\S+$/";
    
    // Vérifie si la chaîne correspond à l'expression régulière
    if (preg_match($regex, $email)) {
        return true; // L'adresse e-mail est valide
    } else {
        return false; // L'adresse e-mail est invalide
    }
}
function isStrongPassword($password) {
    // Expression régulière pour vérifier la force du mot de passe
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/';
    
    // Vérifie si la chaîne correspond à l'expression régulière
    if (preg_match($regex, $password)) {
        return true; // Le mot de passe est fort
    } else {
        return false; // Le mot de passe est faible
    }
}


//Verification si le compte existe deja ... 
function register(string $username , string $mail , string $password , string $password_confirm){
    //il faudrait split chaque condition pour retourner ce qu'il ne va pas a l'utilisateur ou le faire grace a JS avant le submit
    if (isEmail($mail) & isStrongPassword($password) & $username != "" & $password===$password_confirm & !isExistAccountRegister($mail,$password,$username)) {
        if(insertAccount($username, $mail , hash("sha256",$password))){
            return true;
        }else {
            //Probleme lors de l'insertion dans la BDD Voir pour en créer une exeption
            return false;
        }
    }else {
        return false;
    }
}

//Cette fonction prend le mail le mot de passe et si et seulement si le compte exist alors la fonction créer la session avec l'id et le mail stocker dans la session nous alons faire devoir faire une variante pour savoir si le compte est un compte admin
function login (string $mail , string $password):bool{
    //Acces BDD
    //remplacement de la BDD par un tableau de données $BDD en attendant le Set Up de la BDD
    $id=isExistAccount($mail, $password);
    if ($id != []) {
        session_start();
        $_SESSION["mail"]=$mail;
        $_SESSION["id"]=$id["id"];
        return true;
    }else {
        return false;
    }
}
?>