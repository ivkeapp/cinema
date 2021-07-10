<?php
    $this->extend('layout');
    $this->section('content');
?>

<div class="container masthead">
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <img class="movie-poster"
                src="<?=base_url('assets/img/movie/'. $movie->poster_vertical)?>"/>
        </div>
        <div class="col-sm-6 col-xs-12">
            <p class="movie-title"><?=$movie->title?></p>
            <p>Projection start date:
                <i class="movie-start-date"><?=$movie->start_date?></i>
            </p>
            <p class="movie-desc"><?=$movie->short_description?></p>
            <br>
            <b>Description:</b><br>
            <p class="movie-desc"><?=$movie->description?></p>
        </div>
        <div class="col-sm-3 col-xs-12 movie-details">
            <div id="movie-rating" class="rating">
                <?php
                    $rating = $movie->rating;
                    for($i=1; $i<=10; $i++):?>
                        <span class="fa<?=$i>$rating ? 'r' : 's' ?> fa-star"></span>
                <?php endfor; ?>
            </div>
            <p class="movie-genre"><?=$movie->genres?></p>
            <?php
                if(has_permission('movie_create')){
                    echo anchor('movies/delete/'.$movie->id, 'Delete movie', ['class' => 'btn btn-danger']);
                }
                echo anchor('movies/view/'.$movie->id, 'More info', ['class' => 'btn btn-primary ml-2']);

                // id = 3   =>    movies/view/3
            ?>
        </div>
    </div>
    <div class="row">
        <br><h4>Rating</h4><br>
        <div class="col-sm-3 rating">
            <?php
                for($i=1; $i<=10; $i++):?>
                    <span sequence="<?=$i?>" onmouseover="update(this)" class="far fa-star"></span>
            <?php endfor; ?>
            <br>
            <button class="btn btn-sm btn-primary" onclick="rate()">Rate movie</button>
        </div>

    </div>
</div>

<script>
    let currentRating = 0;

    function update(elem){
        currentRating = elem.getAttribute('sequence') - 0;
        //alert(currentRating);
        for(let i=0; i<10; i++){
            elem.parentNode.children[i].setAttribute('data-prefix',
                i<currentRating ? "fa" : "far");
        }
    }

    function rate(){
        let params = {
            movie_id: <?=$movie->id?>,
            rating: currentRating,
        };

        console.log(JSON.stringify(params));

        let url = "<?=site_url('movies/rate')?>";
        fetch(url,{
            method: 'POST',
            headers:{
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(params)
        })
        .then(response => {
            console.log(response);
            if(response.status == 403){
                alert('You need to wait a minute to rate a movie again.');
            }else{
                response.text()
                .then(text => {
                    //alert("Nova prosecna ocena: " + text);

                    let currentRating = text - '0';
                    let divRating = document.getElementById('movie-rating');
                    for(let i=0; i<10; i++){
                        divRating.children[i].setAttribute('data-prefix',
                            i<currentRating ? "fa" : "far");
                    }
                });
            }
        });
    }
</script>

<?php $this->endSection(); ?>
