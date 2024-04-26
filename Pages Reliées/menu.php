<?php
require("./header.php");
require("./navigateur.php");

/**
 * Le but de cette page est de présenter un menu claire d'un restaurant fictif créer par mes soin dans le format dans un premier temps tsv puis csv, puis mettre en code html le tout pour l'afficher comme il se doit
 * file() me parrait etre le plus optimiser pour ce type de main d'oeuvre fopen semble etre un outil trop puissant pour cette tache
 */

function tsvToHtml ( string $menu = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "menu.tsv"):string {
    if (file_exists($menu)) {
        $html ="";
        $lignes = file($menu);
        foreach($lignes as $k => $ligne){
            //Explode permet de décomposer un str en array selon un séparateur 
            //trim permete d'enlever les char vide tel que ""
            $lignes[$k] = explode("\t" , trim($ligne));
            if (count($lignes[$k])===1) {
                $html .= "<br> <strong><h3>".$lignes[$k][0]."</h3></strong> <br>";
            }elseif (count($lignes[$k])===3){
                $html .= "<div class =\"row\">" . "<div class =\"col-sm-8\"> ";
                $html .= "<p><strong>".$lignes[$k][0]. "</strong> <br>" .$lignes[$k][1]."</p>" ;
                $html .="</div>";
                $html .= "<div class =\"col-sm-4\"> ";
                $html .= "<strong><p>".$lignes[$k][2]."</p></strong>";
                $html .="</div>"."</div>";
            }
        }
        return $html;
    }else {
        return "Probleme de lecture ... ";
    }
}

function csvToHtml ( string $menu = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "menu.csv"):string {
    if (file_exists($menu)) {
        $html ="";
        $lignes = file($menu);
        foreach($lignes as $k => $ligne){
            //trim permete d'enlever les char vide tel que ""
            //str_getcsv permet de gérer les fichiers csv plus facilement et rapidement que explode 
            $lignes[$k]=str_getcsv(trim($ligne," \t\n\r\0\x0B,"));

            if (count($lignes[$k])===1) {
                $html .= "<br> <strong><h3>".$lignes[$k][0]."</h3></strong> <br>";
            }elseif (count($lignes[$k])===3){
                $html .= "<div class =\"row\">" . "<div class =\"col-sm-8\"> ";
                $html .= "<p><strong>".$lignes[$k][0]. "</strong> <br>" .$lignes[$k][1]."</p>" ;
                $html .="</div>";
                $html .= "<div class =\"col-sm-4\"> ";
                $html .= "<strong><p>".$lignes[$k][2]."</p></strong>";
                $html .="</div>"."</div>";
            }
        }
        return $html;
    }else {
        return "Probleme de lecture ... ";
    }
}


?>



<h1>Menu</h1>
<?php 
    echo csvToHtml();
?>

<?php
require("./footer.php");
?>