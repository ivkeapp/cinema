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
        <form id="search_form" class="form-inline">
            <span>Order by: </span>
            <select name="orderBy" class="form-control">
                <option value="id">ID</option>
                <option value="title">Title</option>
                <option value="rating">Rating</option>
            </select>
            <select name="order" class="form-control">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
            <span>Per page: </span>
            <select name="orderBy" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <button onclick="search()" type="button" class="btn btn-primary">Search</button>
        </form>

        <div id="movies_list">

        </div>
    </div>
</div>

<script>
    function search(){

        

    }
</script>

<?php $this->endSection(); ?>
