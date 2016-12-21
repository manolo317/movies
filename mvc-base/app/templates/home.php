
<?php var_dump($_GET)?>
<nav class="form">
    <h2>Find a movie:</h2>
    <form action="" method="get">
        <div class="form-group">
            <label for="genre">Select list:</label>
            <select class="form-control" name ="genre" id="genre">
                <option value="1">Action</option>
                <option value="2">Adventure</option>
                <option value="3">Animation</option>
                <option value="4">Biography</option>
                <option value="5">Comedy</option>
                <option value="6">Crime</option>
                <option value="7">Drama</option>
                <option value="8">Family</option>
                <option value="9">Fantasy</option>
                <option value="10">History</option>
                <option value="11">Horror</option>
                <option value="12">Music</option>
                <option value="13">Musical</option>
                <option value="14">Mystery</option>
                <option value="15">Romance</option>
                <option value="16">Sport</option>
                <option value="17">Thriller</option>
                <option value="18">War</option>
                <option value="19">Western</option>
            </select>
        </div>
        <input type="submit" value="Find!"/>
    </form>
</nav>
<h2>The Best Rated Movies</h2>
<main>

    <?php foreach($movies as $movie): ?>
        <figure class="thumbnail">
            <a href="<?= BASE_URL ?>details?id=<?= $movie->getId() ?>"><img src="<?= BASE_URL ?>public/posters/<?= $movie->getImdbId() ?>.jpg" alt="<?= $movie->getTitle() ?>" title="<?= $movie->getTitle() ?>"></a>
                <figcaption><?= $movie->getTitle() ?> <br><strong>Rating: </strong><?= $movie->getRating() ?>/10
                </figcaption>
        </figure>
    <?php endforeach; ?>
</main>