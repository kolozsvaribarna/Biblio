<?php
echo <<<HTML
<div class="author-form-container">
    <h2>Edit Author</h2>
    <form method="post" action="/authors" class="author-form">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="{$author->id}">
        
        <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" name="first_name" id="first_name" value="{$author->first_name}">
        </div>

        <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" name="last_name" id="last_name" value="{$author->last_name}">
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" rows="5">{$author->bio}</textarea>
        </div>

        <div class="form-actions">
        <button type="submit" name="btn-update" class="btn-save">
            <i class="fa fa-save"></i>&nbsp;Save
        </button>
            
        </div>
    </form>
    
    <form method="POST" action="/authors" class="inline-form">
        <div class="form-actions">
            <input type="hidden" name="_method" value="GET">
            <button type="submit" name="btn-cancel" class="btn-cancel">
                <i class="fa fa-undo"></i>&nbsp;Back
            </button>
        </div>
    </form>
</div>
<style>
.author-form-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.author-form h2 {
    margin-bottom: 1rem;
    color: #333;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.5rem;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.inline-form {
    display: inline;
}

.btn-save,
.btn-cancel {
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.25s 
ease, color 0.25s 
ease;
    display: flex
;
    align-items: center;
    gap: 0.5rem;
}

.btn-save {
    background: #20c997;
    color: white;
}

.btn-cancel {
    background: #e0e0e0;
    color: #333;
}
</style>
HTML;
