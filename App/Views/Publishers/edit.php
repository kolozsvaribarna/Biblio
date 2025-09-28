<?php
echo <<<HTML
<div class="publisher-form-container">
    <h2>Edit Publisher</h2>

    <form method="post" action="/publishers" class="publisher-form">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="{$publisher->id}">

        <div class="form-group">
            <label for="name">Publisher Name</label>
            <input type="text" name="name" id="name" value="{$publisher->name}">
        </div>

        <div class="form-actions">
            <button type="submit" name="btn-update" class="btn-save">
                <i class="fa fa-save"></i>&nbsp;Save
            </button>
        </div>
    </form>

    <form method="post" action="/publishers" class="publisher-form">
        <input type="hidden" name="_method" value="GET">
        <div class="form-actions">
            <button type="submit" name="btn-cancel" class="btn-cancel">
                <i class="fa fa-undo"></i>&nbsp;Back
            </button>
        </div>
    </form>
</div>
<style>
.publisher-form-container {
    max-width: 500px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.publisher-form h2 {
    margin-bottom: 1rem;
    color: #333;
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
</style>
HTML;
