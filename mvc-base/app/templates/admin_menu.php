<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 16:17
 */
?>

<section>
    <h1>Admin | Menu</h1>

    <nav class="form">
        <h2>Find a movie:</h2>
        <form action="" method="get">
            <div class="form-group">
                <label for="research">Research:</label>
                <input type="text" class="form-control" name="research" id="research" />
            </div>
            <div class="form-group">
                <label for="genre">Select genre:</label>
                <select class="form-control" name ="genre" id="genre">
                    <option value=""></option>
                    <?php foreach($genres as $genre): ?> <!--je boucle pour afficher tous les genres-->
                        <option value="<?= $genre->getId() ?>"><?= $genre->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Select year:</label>
                <select class="form-control" name ="year" id="year">
                    <option value=""></option>
                    <?php foreach($years as $year): ?> <!--je boucle pour afficher toutes les années qui ont un film-->
                        <option value="<?= $year->getYear() ?>"><?= $year->getYear() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input class="find_button" type="submit" value="Find!"/>
        </form>
    </nav>

    <h2><?= $message ?></h2> <!--affichage message si pas de résultats-->
    <?php if($message === null){ /*si films trouvés j'affiche le titre et le nombre de films*/
        $countMovies = count($movies);
        echo "<h2>The Best Rated Movies</h2>";
        if($countMovies>1){
            echo "<h3>".$countMovies." movies found</h3>";
        }
        else{
            echo "<h3>".$countMovies." movie found</h3>";
        }
    }?>

    <?php foreach($movies as $movie): ?>
        <article>
            <ul>
                <li><?= $movie->getTitle() ?></li>
                <a href="<?= BASE_URL ?>details?id=<?= $movie->getId() ?>">Lire la suite</a>
                <a href="<?= BASE_URL ?>admin/articles/delete?id=<?=$movie->getId();?>" class="glyphicon glyphicon-trash" title="supprimer"></a>
                <a href="<?= BASE_URL ?>admin/articles/update?id=<?=$movie->getId();?>" class="glyphicon glyphicon-refresh" title="modifier"></a>
            </ul>
        </article>
    <?php endforeach; ?>
</section>
<a href="<?= BASE_URL ?>admin/movies/add">Create Film</a>
