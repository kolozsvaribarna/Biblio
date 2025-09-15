<?php
echo <<<HTML
<form method='post' action='/books'>
    <fieldset>   
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value=""><br>
        <label for="pages">Pages</label>
        <input type="number" min="1" name="pages" id="pages" value=""><br>
        <label for="isbn">ISBN number</label>
        <input type="number" name="isbn" id="isbn" value=""><br>
        <label for="available_copies">Available copies</label>
        <input type="number" name="available_copies" id="available_copies" value=""><br>
        <label for="release_year">Release year</label>
        <input type="number" name="release_year" id="release_year" value=""><br>
        <label for="language">Language</label>
        <input type="text" name="language" id="language" value=""><br>
        <label for="publisher_id">Publisher (id)</label>
        <input type="text" name="publisher_id" id="publisher_id" value=""><br>
        <label for="cover_url">Cover URL</label>
        <input type="url" name="cover_url" id="cover_url" value=""><br>    
        
        // TODO make publisher dropdown when typing (+ option to add new)
        // TODO: add AUTHOR and GENRE selection    
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
</fieldset>
</form>

<form method='post' action='/books'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;