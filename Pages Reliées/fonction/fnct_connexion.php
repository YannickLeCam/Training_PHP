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
//Recuperer la liste des logs dans le fichier
function login (string $mail , string $password):bool{
    //Acces BDD
    //remplacement de la BDD par un tableau de données $BDD en attendant le Set Up de la BDD
    foreach($GLOBALS["BDD"] as $key => $id){
        if ($id["mail"]==$mail && $id["password"]==$password) {
            session_start();
            $_SESSION["mail"]=$mail;
            $_SESSION["id"]=$id["id"];
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
    $regex = $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/';
    
    // Vérifie si la chaîne correspond à l'expression régulière
    if (preg_match($regex, $password)) {
        return true; // Le mot de passe est fort
    } else {
        return false; // Le mot de passe est faible
    }
}


//Verification si le compte existe deja ... 
function register(string $username , string $mail , string $password , string $password_confirm){
    if (isEmail($mail) & isStrongPassword($password) & $username != "" & $password===$password_confirm) {
        $new_account=[];
        $new_account["id"] = $username;
        $new_account["mail"] = $mail;
        $new_account["password"] = hash("sha256",$password);
        $fileaddr = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "account.txt";
        $new_account = serialize($new_account) . "\n";
        file_put_contents($fileaddr, $new_account , FILE_APPEND);
        return true;
    }else {
        return false;
    }
}

?>