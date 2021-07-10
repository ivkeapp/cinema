<?php
    $this->extend('layout');
    $this->section('content');
?>

<div class="container masthead">
    <form action="<?= route_to('movies/create') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <h1>Add new movie</h1>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control <?php if(session('errors.title')) : ?>is-invalid<?php endif ?>"
                        name="title" aria-describedby="titleHelp" placeholder="Title" value="<?= old('title') ?>">
                    <small id="titleHelp" class="form-text text-muted">Movie title must be unique.</small>
                </div>

                <div class="form-group">
                    <label for="date">Start date</label>
                    <input type="date" class="form-control <?php if(session('errors.date')) : ?>is-invalid<?php endif ?>"
                        name="date" placeholder="Date" value="<?= old('date') ?>">
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <?php
                        foreach($genres as $g):?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?=$g->id?>" name="genres[]" id="<?=$g->name?>"/>
                                <label class="form-check-label" for="<?=$g->name?>"><?=$g->name?></label>
                            </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <label for="short_description">Short description</label>
                    <textarea rows="2" class="form-control <?php if(session('errors.short_description')) : ?>is-invalid<?php endif ?>"
                        name="short_description" placeholder="Short description"><?= old('short_description') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="4" class="form-control <?php if(session('errors.description')) : ?>is-invalid<?php endif ?>"
                        name="description" placeholder="Description"><?= old('description') ?></textarea>
                </div>


                <button type="submit" class="btn btn-primary btn-block">Add new movie</button>

            </div>
            <div class="col-sm-6 col-xs-12">
                <h1>Images</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <input id="poster_input" type="file" class="form-control <?php if(session('errors.poster')) : ?>is-invalid<?php endif ?>"
                                name="poster" aria-describedby="posterHelp" placeholder="Title" value="<?= old('poster') ?>">
                            <small id="posterHelp" class="form-text text-muted">Supported file types: jpg, png</small>
                        </div>
                        <img id="poster_preview" style="width: 100%;"/>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="poster_vertical">Poster - vertical</label>
                            <input type="file" class="form-control <?php if(session('errors.poster_vertical')) : ?>is-invalid<?php endif ?>"
                                name="poster_vertical" aria-describedby="poster_verticalHelp" placeholder="Title" value="<?= old('poster_vertical') ?>">
                            <small id="poster_verticalHelp" class="form-text text-muted">Supported file types: jpg, png</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script> 
    let inputElem = document.getElementById('poster_input');
    let previewElem = document.getElementById('poster_preview');

    inputElem.onchange = event => {
        const [file] = inputElem.files;
        if(file){
            previewElem.src = URL.createObjectURL(file);
        }
    };
</script>

<?php $this->endSection(); ?>