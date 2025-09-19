<?php

$tableBody = "";
foreach ($books as $book) {

    $publisher = $book->getPublisher();
    $authors = $book->getAuthorsByBookId();
    $genres = $book->getGenresByBookId();

    // TODO genres

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
              <input type="hidden" name="id" value="{$book->book_id}">
              <button type="submit" name="btn-edit" title="Edit">
                <i class="fa fa-edit"></i>
              </button>
            </form>
        
            <form method="post" action="/books">
              <input type="hidden" name="id" value="{$book->book_id}">
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
        <table>
            <div class="table-header">
                <form method="post" action="/books/create">
                    <button type="submit" name="btn-plus" title="New">
                        <i class="fa fa-plus plus"></i>
                    </button>
                </form>
            </div>
            <tbody>
            <div class="book-card-grid">%s</div>
            </tbody>
        </table>
HTML;

echo sprintf($html, $tableBody);
