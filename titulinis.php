<h3 class="pb-4 mb-4 fst-italic border-bottom">
        Pavadinimas
    </h3>

<?php

$sth = $DB->query(
    "SELECT straipsnis.*, rubrika.rpavadinimas AS rubrika
    FROM straipsnis 
    JOIN rubrika 
    ON rubrika.rid = straipsnis.rid
    ORDER BY straipsnis.laikas DESC;
    ");

while($straipsnis = $sth->fetch(PDO::FETCH_ASSOC)){
    $pavadinimas = $straipsnis["pavadinimas"];
    $paveiksliukas = $straipsnis["paveiksliukas"];
    $nuoroda = "?straipsnis=". $straipsnis["nuoroda"];
    $date = date("Y-m-d H:i", strtotime($straipsnis["laikas"]));
    
    $aprasymas = explode(" ", $straipsnis["aprasymas"]);
    
    if(count($aprasymas)>10){
        $aprasymas = array_slice($aprasymas, 0, 10);
        $aprasymas = implode(" ", $aprasymas);
        $aprasymas .= "...";
    }else{
        $aprasymas = $straipsnis["aprasymas"];
    }
    
    $rubrika = $straipsnis["rubrika"];

    if($straipsnis["paveiksliukas"]){
        $paveiksliukas = '<img src="img/"' . $straipsnis["paveiksliukas"] . '">';
    } else {

        $paveiksliukas = '<svg class="bd-placeholder-img" 
                width="200" 
                height="250" 
                xmlns="http://www.w3.org/2000/svg" 
                role="img" 
                aria-label="Placeholder: Thumbnail" 
                preserveAspectRatio="xMidYMid slice" 
                focusable="false">
                    <title>' . $pavadinimas. '</title>
                    <image
                        href="IMG/"'. $straipsnis["paveiksliukas"]. '
                        width="100%"
                        height="100%"
                    >
                <rect width="100%" height="100%" fill="#55595c"/>
                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Paveiksliukas</text>
            </svg>';
    }

}
?>    
<div class="row mb-2">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?php echo $rubrika ?></strong>
            <h3 class="mb-0"><?php echo $pavadinimas ?></h3>
            <div class="mb-1 text-muted"><?php echo $date ?></div>
            <p class="card-text mb-auto"><?php echo $aprasymas ?></p>
            <a href="<?php echo $nuoroda?>" class="stretched-link">Skaitykite daugiau...</a>
        </div>
        <div class="col-auto d-none d-lg-block">
        </div>
    </div>
</div>