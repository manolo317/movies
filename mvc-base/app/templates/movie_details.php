<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 21/12/2016
 * Time: 11:24
 */
?>
<section>
    <h1>Movie | <?= $movie->getTitle() ?></h1>


    <article>
        <h3><?= $movie->getTitle() ?></h3>
        <img src="<?= BASE_URL ?>public/posters/<?= $movie->getImdbId() ?>.jpg" alt="<?= $movie->getTitle() ?>" title="<?= $movie->getTitle() ?>" class="movie_details">
        <div class="movie_details"><strong>Year of parution: </strong><?= $movie->getYear() ?></div>
        <div class="movie_details"><strong>Casting: </strong><?= $movie->getCast() ?></div>
        <div class="movie_details"><strong>Abstract: </strong><?= $movie->getPlot() ?></div>
        <div class="movie_details"><strong>Genre: </strong><?= $genre['genre'] ?></div>
        <div class="movie_details"><strong>Directors: </strong><?= $movie->getDirectors() ?></div>
        <div class="movie_details"><strong>Writers: </strong><?= $movie->getWriters() ?></div>
        <div class="movie_details"><strong>Rating: </strong><?= $movie->getRating() ?>/10</div>
        <div class="movie_details"><strong>Votes: </strong><?= $movie->getVotes() ?></div>
        <div class="movie_details"><strong>Runtime: </strong><?= $movie->getRuntime() ?>utes</div>
        <div class="movie_details"><a href="<?= $movie->getTrailerUrl() ?>">trailer</a></div>
        <form method="POST">
            <div><h3><?php
                    if(!empty($message)){
                        echo $message;
                    } ?></h3></div>
            <input type="hidden" name="wish" id="wish" value="<?= $movie->getId() ?>">
            <input type="submit" value="add to wishlist">
        </form>
    </article>

</section>
