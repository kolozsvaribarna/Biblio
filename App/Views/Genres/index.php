<?php

$genreCards = "";
foreach ($genres as $genre) {
    $genreCards .= <<<HTML
    <div class="author-card">
        <!-- Info -->
        <div class="author-card-info">
            <h2 class="author-card-name">{$genre->name}</h2>
        </div>

        <!-- Actions -->
        <div class="author-card-actions">
            <form method="post" action="/genres/edit">
                <input type="hidden" name="id" value="{$genre->id}">
                <button type="submit" name="btn-edit" title="Edit"><i class="fa fa-edit"></i></button>
            </form>
            <form method="post" action="/genres">
                <input type="hidden" name="id" value="{$genre->id}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="btn-del" title="Delete"><i class="fa fa-trash trash"></i></button>
            </form>
        </div>
    </div>
    HTML;
}

$html = <<<HTML
    <div class="authors-header">
        <h2>Genres</h2>
        <form class="table-header" method="post" action="/genres/create">
            <button type="submit" name="btn-plus" title="New">
                <i class="fa fa-plus plus"></i>
            </button>
        </form>
    </div>

    <div class="authors-grid">
        %s
    </div>
HTML;

echo sprintf($html, $genreCards);
