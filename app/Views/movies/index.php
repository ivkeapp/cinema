<?php
    $this->extend('layout');
    $this->section('content');
?>

<div class="container masthead">
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <h1>Movies</h1>
        </div>
        <div class="col-sm-4 col-xs-12" style="text-align: right;">
            <?php
                if(logged_in() && has_permission('movie_create')){
                    echo anchor('movies/create', 'Add new movie', ['class' => 'btn btn-success']);
                }
            ?>
        </div>
    </div>
    <div class="row">
        <?php
            foreach($movies as $movie){
                echo view('movies/movie', ['movie'=>$movie]);
            }
        ?>
    </div>
</div>

<?php $this->endSection(); ?>
