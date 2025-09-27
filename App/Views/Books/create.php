<?php

use App\Models\GenreModel;
use App\Models\PublisherModel;
use App\Models\AuthorsModel;

$html = <<<HTML
<div class="form-container">
    <h2>Add a New Book</h2>
    <form method='post' action='/books' class="edit-form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="">
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="pages">Pages</label>
                <input type="number" min="1" name="pages" id="pages" value="">
            </div>
            
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="number" name="isbn" id="isbn" value="">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="available_copies">Available Copies</label>
                <input type="number" name="available_copies" id="available_copies" value="">
            </div>
            
            <div class="form-group">
                <label for="release_year">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="language">Language</label>
                <input type="text" name="language" id="language" value="">
            </div>
            
            <div class="form-group">
                <label for="publisher_id">Publisher</label>
                <select name="publisher_id" id="publisher_id">
                    %s
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="cover_url">Cover URL</label>
            <input type="url" name="cover_url" id="cover_url" value="">
        </div>
        
        <div class="checkbox-group">
            <label>Authors:</label>
            <div class="checkbox-container">%s</div>
        </div>
        
        <div class="checkbox-group">
            <label>Genres:</label>
            <div class="checkbox-container">%s</div>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Save</button>
            <button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Back</button>
        </div>
    </form>
</div>
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
    $authorOptions .= "<div class='checkbox-item'><input type='checkbox' id='". $author->id ."' name='authors[]' value='". $author->id ."'><label for='". $author->id ."'>". $author->first_name ." ". $author->last_name ."</label></div>";
}

$genreOptions = "";
$genreModel = new GenreModel();
$genres = $genreModel->all();
foreach ($genres as $genre) {
    $genreOptions .= "<div class='checkbox-item'><input type='checkbox' id='". $genre->id ."' name='genres[]' value='". $genre->id ."'><label for='". $genre->id ."'>". $genre->name ."</label></div>";
}

printf($html, $publisherOptions, $authorOptions, $genreOptions);
?>

<style>
    /* FORM STYLING */
    .form-container {
        width: 95vw;
        margin: 2vh auto;
        padding: 1.5rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .form-container h2 {
        margin-top: 0;
        margin-bottom: 1.5rem;
        color: #3f3f3f;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.5rem;
    }

    .edit-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-row {
        display: flex;
        gap: 1rem;
    }

    .form-row .form-group {
        flex: 1;
    }

    label {
        font-weight: bold;
        color: #3f3f3f;
    }

    input[type="text"],
    input[type="number"],
    input[type="url"],
    select {
        padding: 0.6rem 0.8rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="url"]:focus,
    select:focus {
        outline: none;
        border-color: #20c997;
    }

    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .checkbox-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.5rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 6px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .checkbox-item input[type="checkbox"] {
        margin: 0;
    }

    .checkbox-item label {
        font-weight: normal;
        margin: 0;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-save, .btn-cancel {
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        transition: background 0.25s ease, color 0.25s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save {
        background: #20c997;
        color: white;
    }

    .btn-save:hover {
        background: #1aa87d;
    }

    .btn-cancel {
        background: #e0e0e0;
        color: #333;
    }

    .btn-cancel:hover {
        background: #d0d0d0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 1rem;
        }

        .checkbox-container {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-save, .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>