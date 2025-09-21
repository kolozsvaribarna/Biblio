<?php
echo <<<HTML
<form method='post' action='/authors'>
    <fieldset>   
        <label for="first_name">First name</label>
    <input type="text" name="first_name" id="first_name" value=""><br>
    <label for="last_name">Last name</label>
    <input type="text" name="last_name" id="last_name" value=""><br>
    <label for="bio">Bio</label>
    <input type="text" name="bio" id="bio" value=""><br>
        
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
</fieldset>
</form>

<form method='post' action='/authors'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
</form>
HTML;