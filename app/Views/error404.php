<?php
    $this->extend('layout');
    $this->section('content');
?>

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        
        <i class="fas fa-exclamation-triangle" style="color:white;font-size:150px"></i><br><br>
        <h1 class="masthead-heading text-uppercase mb-0">
            404 - <?=lang('Home.error404')?>
        </h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">
            <?php if (! empty($message) && $message !== '(null)') : ?>
				<?= nl2br(esc($message)) ?>
			<?php else : ?>
				Sorry! Cannot seem to find the page you were looking for.
			<?php endif ?>
        </p>
    </div>
</header>
<?php $this->endSection(); ?>