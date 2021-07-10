<?php

    if($page > 1):?>

        <button class="btn btn-primary" onclick="search(<?=$page-1?>)">
            Pervious
        </button>

<?php endif; ?>
        <button class="btn btn-primary" disabled>
            Page
        </button>
        <button class="btn btn-primary" onclick="search(<?=$page+1?>)">
            Next
        </button>
<?php
    foreach($movies as $movie){
        echo view('movies/movie', ['movie'=>$movie]);
    }
?>