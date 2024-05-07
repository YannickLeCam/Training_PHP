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

?>