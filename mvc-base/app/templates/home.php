
<?php var_dump($_GET)?>
<nav class="form">
    <h2>Find a movie:</h2>
    <form action="" method="get">
        <div class="form-group">
            <label for="research">Research by Title</label>
            <input type="text" class="form-control" name="research" id="research" />
        </div>
        <div class="form-group">
            <label for="genre">Select genre:</label>
            <select class="form-control" name ="genre" id="genre">
                <option value=""></option>
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
        <div class="form-group">
            <label for="year">Select year:</label>
            <select class="form-control" name ="year" id="year">
                <option value=""></option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1962">1962</option>
                <option value="1966">1966</option>
                <option value="1971">1971</option>
                <option value="1973">1973</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
            </select>
        </div>
        <input type="submit" value="Find!"/>
    </form>
</nav>
<h2><?= $message ?></h2>
<?php if($message === null){ echo "<h2>The Best Rated Movies</h2>";} ?>
<main>

    <?php foreach($movies as $movie): ?>
        <figure class="thumbnail">
            <a href="<?= BASE_URL ?>details?id=<?= $movie->getId() ?>"><img src="<?= BASE_URL ?>public/posters/<?= $movie->getImdbId() ?>.jpg" alt="<?= $movie->getTitle() ?>" title="<?= $movie->getTitle() ?>"></a>
                <figcaption><?= $movie->getTitle() ?> <br><strong>Rating: </strong><?= $movie->getRating() ?>/10
                </figcaption>
        </figure>
    <?php endforeach; ?>
</main>