<?php

use App\Models\PublisherModel;
use App\Models\AuthorsModel;

$html = <<<HTML
<form method='post' action='/books'>
    <fieldset>
        <legend>Add a new book</legend>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value=""><br>
        <label for="pages">Pages</label>
        <input type="number" min="1" name="pages" id="pages" value=""><br>
        <label for="isbn">ISBN</label>
        <input type="number" name="isbn" id="isbn" value=""><br>
        <label for="available_copies">Available copies</label>
        <input type="number" name="available_copies" id="available_copies" value=""><br>
        <label for="release_year">Release year</label>
        <input type="number" name="release_year" id="release_year" value=""><br>
        <label for="language">Language</label>
        <input type="text" name="language" id="language" value=""><br>
        <label for="cover_url">Cover URL</label>
        <input type="url" name="cover_url" id="cover_url" value=""><br>
        <label for="publisher_id">Publisher</label>
        <select name="publisher_id" id="publisher_id">
            %s
        </select><br>
        <label>Authors:</label>
        <div style="margin-left: 3vw;">%s</div>
        
        <!--TODO: add GENRE selection --> 
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
</fieldset>
</form>

<form method='post' action='/books'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;

$publisherOptions = "";
$publisherModel = new PublisherModel();
$publishers = $publisherModel->all();
foreach ($publishers as $publisher) {
    $publisherOptions .= "<option value='" . $publisher->id . "'>" . $publisher->name . "</option>";
}

$authorOptions = "";
$authorModel = new AuthorsModel();
$authors = $authorModel->all();
foreach ($authors as $author) {
    $authorOptions .= "<input type='checkbox' id='". $author->id ."' name='authors[]' value='". $author->id ."'>
    <label for='". $author->id ."'>". $author->first_name ." ". $author->last_name ."</label><br>";
}


printf($html, $publisherOptions, $authorOptions);