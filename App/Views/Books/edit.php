<?php

use App\Models\PublisherModel;
use App\Models\AuthorsModel;

$html = <<<HTML
<form method='post' action='/books'>
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="{$book->id}">
    <fieldset>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{$book->title}"><br>
    <label for="pages">Pages</label>
    <input type="number" min="1" name="pages" id="pages" value="{$book->pages}"><br>
    <label for="isbn">ISBN</label>
    <input type="number" name="isbn" id="isbn" value="{$book->isbn}"><br>
    <label for="release_year">Release year</label>
    <input type="number" name="release_year" id="release_year" value="{$book->release_year}"><br>
    <label for="language">Language</label>
    <input type="text" name="language" id="language" value="{$book->language}"><br>
    <label for="available_copies">Available copies</label>
    <input type="number" name="available_copies" id="available_copies" value="{$book->available_copies}"><br>
    
    <label for="publisher_id">Publisher</label>
    <select name="publisher_id" id="publisher_id">
        %s
    </select><br>
    <label for="cover_url">Cover URL</label>
    <input type="url" name="cover_url" id="cover_url" value="{$book->cover_url}">
    <br>          
    <label>Authors:</label>
    <div style="margin-left: 3vw;">%s</div>
    
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
    if ($publisher->id == $book->publisher_id) {
        $publisherOptions .= "<option value='" . $publisher->id . "' selected>" . $publisher->name . "</option>";
    }
    else {
        $publisherOptions .= "<option value='" . $publisher->id . "'>" . $publisher->name . "</option>";
    }
}

$authorOptions = "";
$authorModel = new AuthorsModel();
$allAuthors = $authorModel->all();

$bookAuthors = array_column($book->allAuthors(), 'author_id');

foreach ($allAuthors as $author) {
    if (in_array($author->id, $bookAuthors)) {
        $authorOptions .= "<input type='checkbox' id='". $author->id ."' name='authors[]' value='". $author->id ."' checked>";
    }
    else {
        $authorOptions .= "<input type='checkbox' id='" . $author->id . "' name='authors[]' value='" . $author->id . "'>";
    }
    $authorOptions .= "<label for='". $author->id ."'>". $author->first_name ." ". $author->last_name ."</label><br>";
}

printf($html, $publisherOptions, $authorOptions);