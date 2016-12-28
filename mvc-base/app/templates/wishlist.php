<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 28/12/2016
 * Time: 09:36
 */
?>
<h2>Your wishlist</h2>
<main>

    <?php foreach($movies as $movie): ?> <!--affichage des films sélectionnés-->
        <figure class="thumbnail">
            <a href="<?= BASE_URL ?>details?id=<?= $movie->getId() ?>"><img src="<?= BASE_URL ?>public/posters/<?= $movie->getImdbId() ?>.jpg" alt="<?= $movie->getTitle() ?>" title="<?= $movie->getTitle() ?>"></a>
            <figcaption><?= $movie->getTitle() ?> <br><strong>Rating: </strong><?= $movie->getRating() ?>/10
                <a href="<?= BASE_URL ?>wishlist/remove?id=<?=$movie->getId();?>" class="glyphicon glyphicon-trash" title="remove"></a>
            </figcaption>
        </figure>
    <?php endforeach; ?>
</main>
