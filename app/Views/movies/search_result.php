<?php
            foreach($movies as $movie){
                echo view('movies/movie', ['movie'=>$movie]);
            }
        ?>