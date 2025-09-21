<?php
echo <<<HTML
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
    
    <label for="publisher_id">Publisher (id)</label>
    <input type="text" name="publisher_id" id="publisher_id" value="{$book->publisher_id}"><br>
    <label for="cover_url">Cover URL</label>
    <input type="url" name="cover_url" id="cover_url" value="{$book->cover_url}"><br>          
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
</fieldset>
</form>
<form method='post' action='/books'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;

/*<!--<label for="genre_id">Genre (id)</label>
    <input type="text" name="genre_id" id="genre_id" value="{$book->genre_id}"><br>
    <label for="author_id">Author (id)</label>
    <input type="text" name="author_id" id="author_id" value="{$book->author_id}"><br>-->
*/