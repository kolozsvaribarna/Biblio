<?php
echo <<<HTML
<form method='post' action='/publishers'>
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="{$publisher->id}">
    <fieldset>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="{$publisher->name}"><br>
        
        <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
    </fieldset>
</form>
<form method='post' action='/publishers'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;