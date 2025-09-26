<?php
echo <<<HTML
<form method='post' action='/genres'>
    <fieldset>
        <label for="name">Genre:</label><br>
        <input type="text" name="name" id="name" value=""><br>
        
        <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
    </fieldset>
</form>
<form method='post' action='/genres'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;