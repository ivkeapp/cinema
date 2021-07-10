<div class="row movie">
    <div class="col-sm-3 col-xs-12">
        <img class="movie-poster"
            src="<?=base_url('assets/img/movie/'. $movie->poster)?>"/>
    </div>
    <div class="col-sm-6 col-xs-12">
        <p class="movie-title"><?=$movie->title?></p>
        <p>Projection start date:
            <i class="movie-start-date"><?=$movie->start_date?></i>
        </p>
        <p class="movie-desc"><?=$movie->short_description?></p>
    </div>
    <div class="col-sm-3 col-xs-12 movie-details">
        <div class="rating">
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