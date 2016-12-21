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
        <div><strong>Year of parution: </strong><?= $movie->getYear() ?></div>
        <div><strong>Casting: </strong><?= $movie->getCast() ?></div>
        <div><p><strong>Abstract: </strong><?= $movie->getPlot() ?></p></div>
        <div><strong>Directors: </strong><?= $movie->getDirectors() ?></div>
        <div><strong>Writers: </strong><?= $movie->getWriters() ?></div>
        <div><strong>Rating: </strong><?= $movie->getRating() ?></div>
        <div><strong>Votes: </strong><?= $movie->getVotes() ?></div>
        <div><strong>Runtime: </strong><?= $movie->getRuntime() ?> minutes</div>
        <div><a href="<?= $movie->getTrailerUrl() ?>">trailer</a></div>
    </article>

</section>
