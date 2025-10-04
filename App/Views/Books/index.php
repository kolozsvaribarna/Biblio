<?php

use App\Models\AuthorsModel;
use App\Models\GenreModel;
use App\Models\PublisherModel;

$activePublisher = $_GET['publisher'] ?? '';
$activeAuthors   = $_GET['authors'] ?? [];
$activeGenres    = $_GET['genres'] ?? [];
$activeLanguage  = strtoupper(trim($_GET['language'] ?? ''));

$publisherOptions = "";
$publisherModel = new PublisherModel();
$publishers = $publisherModel->all();
foreach ($publishers as $publisher) {
    if ($publisher->id == $activePublisher) {
        $publisherOptions .= "<option value='" . $publisher->id . "' selected>" . $publisher->name . "</option>";
    }
    else {
        $publisherOptions .= "<option value='" . $publisher->id . "'>" . $publisher->name . "</option>";
    }
}

$authorOptions = "";
$authorModel = new AuthorsModel();
$allAuthors = $authorModel->all();
foreach ($allAuthors as $author) {
    if (in_array($author->id, $activeAuthors)) {
        $authorOptions .= "<div class='checkbox-item'><input type='checkbox' id='a" . $author->id . "' name='authors[]' value='" . $author->id . "' checked><label for='a". $author->id ."'>". $author->first_name ." ". $author->last_name ."</label></div>";
    }
    else {
        $authorOptions .= "<div class='checkbox-item'><input type='checkbox' id='a" . $author->id . "' name='authors[]' value='" . $author->id . "'><label for='a" . $author->id . "'>" . $author->first_name . " " . $author->last_name . "</label></div>";
    }
}

$genreOptions = "";
$genreModel = new GenreModel();
$genres = $genreModel->all();
foreach ($genres as $genre) {
    if (in_array($genre->id, $activeGenres)) {
        $genreOptions .= "<div class='checkbox-item'><input type='checkbox' id='g" . $genre->id . "' name='genres[]' value='" . $genre->id . "' checked ><label for='g" . $genre->id . "'>" . $genre->name . "</label></div>";
    }
    else {
        $genreOptions .= "<div class='checkbox-item'><input type='checkbox' id='g" . $genre->id . "' name='genres[]' value='" . $genre->id . "'><label for='g" . $genre->id . "'>" . $genre->name . "</label></div>";
    }
}

$tableBody = "";
foreach ($books as $book) {

    $publisher = $book->getPublisher();
    $authors = $book->getAuthorsByBookId();
    $genres = $book->getGenresByBookId();

    $tableBody .=
        <<<HTML
    <div class="book-card">
        <img class="book-card-cover" src="{$book->cover_url}" alt="">
            <div class="book-card-info">
            <h2 class="book-card-title">{$book->title}</h2>
            <h5 class="book-card-authors">{$authors[0]['name']}</h5>
            <ul class="book-card-meta">
                <li><strong>Genres:</strong> {$genres[0]['genre']}</li>
                <li><strong>Pages:</strong> {$book->pages}</li>
                <li><strong>Language:</strong> {$book->language}</li>
                <li><strong>Release Year:</strong> {$book->release_year}</li>
                <li><strong>Publisher:</strong> {$publisher->name}</li>
                <li><strong>ISBN:</strong> {$book->isbn}</li>
                <li><strong>Available Copies:</strong> {$book->available_copies}</li>
            </ul>
        </div>
        <div class="book-card-actions">
        <form method="post" action="/books/edit">
          <input type="hidden" name="id" value="{$book->id}">
          <button type="submit" name="btn-edit" title="Edit">
            <i class="fa fa-edit"></i>
          </button>
        </form>
    
        <form method="post" action="/books">
          <input type="hidden" name="id" value="{$book->id}">
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" name="btn-del" title="Delete">
            <i class="fa fa-trash trash"></i>
          </button>
        </form>
      </div>
    </div>
HTML;
}

$html =
<<<HTML
    <h1>Books</h1>
    %s
    <table>
        <div class="table-header">
            <form method="post" action="/books/create">
                <button type="submit" name="btn-plus" title="New">
                    <i class="fa fa-plus plus"></i>
                </button>
            </form>
        </div>
        
        <tbody>
        <div class="book-card-grid">
        %s
        </div>
        </tbody>
    </table>
HTML;

$filterForm = <<<HTML
<button id="toggle-filters-btn" type="button">
    <i class="fa fa-search"></i> Show Filters
</button>
<form method="GET" id="filter-form" action="/books">
<div class="filter-group">
    <label for="publisher">Publisher: </label>
    <select name="publisher" id="publisher">
        <option value="" selected>All Publishers</option>
        %s <!-- publisherOptions -->
    </select>
    <br>
    <label for="language">Language: </label>
    <input type="text" name="language" id="language" maxlength="2" placeholder="EN/HU/..">
    </div>
    <div class="filter-group">
    <label>Authors: </label>
    <div class="checkbox-field">
        %s <!-- authors -->
    </div>
    </div>
    <div class="filter-group">
    <label>Genres: </label>
    <div class="checkbox-field">
        %s <!-- genres -->
    </div>
    </div>
    <div class="filter-actions">
        <input type="submit" value="Apply filters">
        <button type="button" class="clear-btn" onclick="window.location.href='/books'">Clear filters</button>
    </div>
    <!-- STYLE -->
    %s
</form>
HTML;

$noBooksFound = "<h2>No books found! :c</h2>";

$filterFormStyle = <<<HTML
<style>
#filter-form {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 1.5rem;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

#filter-form:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

#filter-form .filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    min-width: 200px;
}

#filter-form label {
    font-weight: 600;
    color: #333;
    font-size: 0.95rem;
}

#filter-form select,
#filter-form input[type="text"] {
    padding: 0.5rem 0.75rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.95rem;
    width: 100%;
    background-color: #fff;
    transition: border-color 0.2s, box-shadow 0.2s;
}

#filter-form select:focus,
#filter-form input[type="text"]:focus {
    border-color: #127e5f;
    box-shadow: 0 0 0 2px rgba(18, 126, 95, 0.2);
    outline: none;
}

#filter-form .checkbox-field {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem 1rem;
    max-width: 450px;
}

#filter-form .checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0.3rem 0.6rem;
    transition: background 0.2s, border-color 0.2s;
}

#filter-form .checkbox-item:hover {
    background: #a8f4ce;
    border-color: #127e5f;
}

#filter-form input[type="checkbox"]:checked + label {
    color: #127e5f;
    accent-color: #127e5f;
}

#filter-form input[type="checkbox"]:checked {
    accent-color: #127e5f;
}

#filter-form .filter-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: auto;
}

#filter-form input[type="submit"],
#filter-form .clear-btn {
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.1s;
}

#filter-form input[type="submit"] {
    background-color: #127e5f;
    color: white;
}

#filter-form input[type="submit"]:hover {
    background-color: #20c997;
    transform: translateY(-1px);
}

#filter-form .clear-btn {
    background-color: #f0f0f0;
    color: #333;
}

#filter-form .clear-btn:hover {
    background-color: #e0e0e0;
    transform: translateY(-1px);
}

#toggle-filters-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background-color: #127e5f;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.6rem 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.1s;
    margin-bottom: 1rem;
    margin-left: 2em;
}

#toggle-filters-btn:hover {
    background-color: #20c997;
    transform: translateY(-1px);
}

#toggle-filters-btn .fa-search {
    font-size: 1rem;
    color: #fff;
}

#filter-form {
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transform: scaleY(0.98);
    transform-origin: top;
    transition: max-height 0.4s ease, opacity 0s ease, transform 0.2s ease;
    margin-top: -4vh;
}

#filter-form.open {
    display: flex;
    max-height: 1000px;
    opacity: 1;
    transform: scaleY(1);
    
    margin-top: initial;
}

@media (max-width: 768px) {
    #filter-form {
        flex-direction: column;
    }
    #filter-form .filter-group {
        width: 100%;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-filters-btn');
    const filterForm = document.getElementById('filter-form');
    let isOpen = false;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;
        if (isOpen) {
            filterForm.classList.add('open');
            toggleBtn.innerHTML = '<i class="fa fa-search"></i> Hide Filters';
        } else {
            filterForm.classList.remove('open');
            toggleBtn.innerHTML = '<i class="fa fa-search"></i> Show Filters';
        }
    });
    // auto open if filters are active
    const urlParams = new URLSearchParams(window.location.search);
    if ([...urlParams.keys()].length > 0) {
        filterForm.classList.add('open');
        toggleBtn.innerHTML = '<i class="fa-solid fa-magnifying-glass"></i> Hide Filters';
        isOpen = true;
    }
});
</script>
HTML;

$filterFormString = sprintf($filterForm, $publisherOptions, $authorOptions, $genreOptions, $filterFormStyle);

if ($books) {
    echo sprintf($html, $filterFormString, $tableBody);
}
else {
    echo sprintf($html, $filterFormString, $noBooksFound);
}