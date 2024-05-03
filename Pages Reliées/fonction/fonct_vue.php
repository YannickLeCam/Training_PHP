<?php
function findIndex(string $lien,array $file):int{
    foreach($file as $i => $data){
        $data = unserialize(rtrim($data));
        if (!empty($data[$lien])) {
            return $i;
        }
    }
    //if isn't in file 
    return -1;
}
function addVue(string $lien):bool {
    $fichierVueAddr = __DIR__ .DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "vue.txt";
    $fichierVue = file($fichierVueAddr);
    $indexLigne = findIndex($lien,$fichierVue);
    if ($indexLigne!== -1 ) {
        $data=unserialize(rtrim($fichierVue[$indexLigne]));
        $data[$lien]++;
        $fichierVue[$indexLigne] = serialize($data) . "\n";
    }elseif ($indexLigne == -2) {
        echo "Erreur : findIndex Error Critique";
        return false;
    }
    else {
        $fichierVue[]= serialize([$lien => 1])."\n";
        
    }
    file_put_contents($fichierVueAddr,$fichierVue);
    return true;
}

function nbDeVue (string $lien):int {
    $fichierVueAddr = __DIR__ . DIRECTORY_SEPARATOR .".." .DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "vue.txt";
    $fichierVue = file($fichierVueAddr);
    $indexLigne = findIndex($lien,$fichierVue);
    $data = unserialize(rtrim($fichierVue[$indexLigne]));
    return $data[$lien];
}


function nbDeVueJournalier (string $lien):int {
    
    $fichierVueAddr =  __DIR__ .DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR ."journalier". DIRECTORY_SEPARATOR . "vue-".date("Y-m-d").".txt";
    $fichierVue = file($fichierVueAddr);
    $indexLigne = findIndex($lien,$fichierVue);
    $data = unserialize(rtrim($fichierVue[$indexLigne]));
    return $data[$lien];
}
function addVueJournalier(string $lien):bool {
    $fichierVueAddr = __DIR__ .DIRECTORY_SEPARATOR ."..". DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR ."journalier". DIRECTORY_SEPARATOR . "vue-".date("Y-m-d").".txt";
    if (!file_exists($fichierVueAddr)) {
        file_put_contents($fichierVueAddr,serialize([$lien => 1])."\n");
    }else {
        $fichierVue = file($fichierVueAddr);
        $indexLigne = findIndex($lien,$fichierVue);
        if ($indexLigne!== -1 ) {
            $data=unserialize(rtrim($fichierVue[$indexLigne]));
            $data[$lien]++;
            $fichierVue[$indexLigne] = serialize($data) . "\n";
        }elseif ($indexLigne == -2) {
            echo "Erreur : findIndex Error Critique";
            return false;
        }
        else {
            $fichierVue[]= serialize([$lien => 1])."\n";
            
        }
        file_put_contents($fichierVueAddr,$fichierVue);
    }
    return true;
}

function nbVueTotal () : int {
    $fichierVueAddr = __DIR__ . DIRECTORY_SEPARATOR .".." .DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "vue.txt";
    $somme = 0;
    $fichierVue = file($fichierVueAddr);
    foreach($fichierVue as $ligne){
        $ligne = unserialize(rtrim($ligne));
        foreach ($ligne as $lien => $value) {
            $somme+= $value;
        }
    }

    return $somme;
       
}

function nbVueMois(int $annee=null , int $mois=null):array {
    if ($mois!= null) {
        $mois = str_pad($mois ,2, "0", STR_PAD_LEFT);
    }else {
        $mois = "*";
    }
    if ($annee== null) {
        $annee="*";
    }
    $fichierVueAddr = dirname(__DIR__). DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR ."journalier". DIRECTORY_SEPARATOR . "vue-".$annee."-".$mois ."-*.txt";
    $listfichier = glob($fichierVueAddr);
    $retour=[];
    $somme = 0;
    foreach($listfichier as $fichierAddr){
        $fichier=file($fichierAddr);
        foreach($fichier as $ligne){
            $ligne = unserialize(rtrim($ligne));
            foreach ($ligne as $lien => $vue){
                if (isset($retour[$lien])) {
                    $retour[$lien]+= $vue;
                }else {
                    $retour[$lien]=$vue;
                }
                $somme += $vue;

            }
        }
    }
    $retour["total"]=$somme;
    return $retour;
}
?>