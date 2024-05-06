<?php
require_once("./fonction/fonct_vue.php");
addVueJournalier($_SERVER["SCRIPT_NAME"]);
$nb_vue_journalier = nbDeVueJournalier($_SERVER["SCRIPT_NAME"]);
addVue($_SERVER["SCRIPT_NAME"]);
$nb_vue = nbDeVue($_SERVER["SCRIPT_NAME"]);

?>

<footer>
    <div>
        <p>
            Cette page a été vu : <?= $nb_vue;?> et aujourd'hui <?= $nb_vue_journalier?>
        </p>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
