<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 19:25
 */
?>
<section class="form">
    <h2>Create a new movie:</h2>
    <div><h3><?= $message ?></h3></div> <!--confirmation si le film a bien été crée-->
    <!--affichage des erreurs-->
    <?php
    if(!empty($postErrors)){
        foreach ($postErrors as $error){
            echo '<div class="glyphicon glyphicon-warning-sign"> ' . $error . '</div><br>';
        }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value=""/>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" class="form-control" name="year" id="year" value=""/>
        </div>
        <div class="form-group">
            <label for="cast">Cast</label>
            <input type="text" class="form-control" name="cast" id="cast" value=""/>
        </div>
        <div class="form-group">
            <label for="directors">Directors</label>
            <input type="text" class="form-control" name="directors" id="directors" value=""/>
        </div>
        <div class="form-group">
            <label for="writers">Writers</label>
            <input type="text" class="form-control" name="writers" id="writers" value=""/>
        </div>
        <div class="form-group">
            <label for="plot">Plot</label>
            <input type="text" class="form-control" name="plot" id="plot" value=""/>
        </div>
        <div class="form-group">
            <label for="runtime">Runtime</label>
            <input type="text" class="form-control" name="runtime" id="runtime" value=""/>
        </div>
        <div class="form-group">
            <label for="trailerUrl">trailer URL</label>
            <input type="text" class="form-control" name="trailerUrl" id="trailerUrl" value=""/>
        </div>
        <div class="form-group">
            <label for="imdbId">Image</label>
            <input type="file" class="form-control" name="imdbId" id="imdbId" />
        </div>
        <div class="form-group">
            <label for="genre">Genre</label><br>
            <?php foreach($genres as $genre): ?> <!--je boucle pour afficher tous les genres-->
            <input type="checkbox" name="genre[]" value="<?= $genre->getId() ?>"/> <?= $genre->getName() ?><br>
            <?php endforeach; ?>
        </div>

        <input type="submit" name="inscription" value="envoyez"/>
    </form>
</section>
