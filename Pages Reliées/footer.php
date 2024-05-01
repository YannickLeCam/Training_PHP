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
    $fichierVueAddr = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "vue.txt";
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
    $fichierVueAddr = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "vue.txt";
    $fichierVue = file($fichierVueAddr);
    $indexLigne = findIndex($lien,$fichierVue);
    $data = unserialize(rtrim($fichierVue[$indexLigne]));
    return $data[$lien];
}
addVue($_SERVER["SCRIPT_NAME"]);
$nb_vue = nbDeVue($_SERVER["SCRIPT_NAME"]);

?>

<footer>
    <div>
        <p>
            Cette page a été vu : <?= $nb_vue;?>
        </p>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
