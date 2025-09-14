<?php
echo <<<HTML
<form method='post' action='/books'>
    <fieldset>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value=""><br>
    <label for="pages">Pages</label>
    <input type="number" min="1" name="pages" id="pages" value=""><br>
    <label for="ISBN">ISBN number</label>
    <input type="number" name="ISBN" id="ISBN" value="{"><br>
    <label for="release_year">Release year</label>
    <input type="number" name="release_year" id="release_year" value=""><br>
    <label for="language">Language</label>
    <input type="text" name="language" id="language" value=""><br>
    <label for="genre">Genre (id)</label>
    <input type="text" name="genre" id="genre" value=""><br>
    <label for="author_id">Author (id)</label>
    <input type="text" name="author_id" id="author_id" value=""><br>
    <label for="publisher_id">Publisher (id)</label>
    <input type="text" name="publisher_id" id="publisher_id" value=""><br>
    <label for="cover">Cover URL</label>
    <input type="url" name="cover" id="cover" value=""><br>           
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
</fieldset>
</form>

<form method='post' action='/books'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;