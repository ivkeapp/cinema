<?php
    $links = [
        lang('Home.home') => 'home/index',
        'Movies' => 'movies/index',
        //lang('Home.about') => 'home/index#about',
        //lang('Home.contact') => 'home/index#contact',
    ];

    if(logged_in()){
        //var_dump(lang('Home.logout', [user()->username]));
        $links[lang('Home.logout', [user()->username])] = 'logout';
?>

<script>
    let seconds = 5000;
    //alert('Automatic logout in ' + seconds + ' second(s)');
    setTimeout(function(){
        window.location = "<?=base_url('logout')?>";
    }, seconds * 1000);
</script>

<?php

    }else{
        $links[lang('Home.login')] = 'login';
    }

    foreach($links as $text => $url):?>
        <li class="nav-item mx-0 mx-lg-1">
            <?=anchor($url, $text, ['class'=>'nav-link py-3 px-0 px-lg-3 rounded'])?>
        </li>
<?php endforeach; ?>