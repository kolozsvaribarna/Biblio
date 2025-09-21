<?php

$authorCards = "";
foreach ($authors as $author) {
    $authorCards .= <<<HTML
    <div class="author-card">
        <!-- Info -->
        <div class="author-card-info">
            <h2 class="author-card-name">{$author->first_name} {$author->last_name}</h2>
            <p class="author-card-bio">{$author->bio}</p>
        </div>

        <!-- Actions -->
        <div class="author-card-actions">
            <form method="post" action="/authors/edit">
                <input type="hidden" name="id" value="{$author->id}">
                <button type="submit" name="btn-edit" title="Edit"><i class="fa fa-edit"></i></button>
            </form>
            <form method="post" action="/authors">
                <input type="hidden" name="id" value="{$author->id}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="btn-del" title="Delete"><i class="fa fa-trash trash"></i></button>
            </form>
        </div>
    </div>
    HTML;
}

$html = <<<HTML
    <div class="authors-header">
        <h2>Authors</h2>
        <form class="table-header" method="post" action="/authors/create">
            <button type="submit" name="btn-plus" title="New">
                <i class="fa fa-plus plus"></i>
            </button>
        </form>
    </div>

    <div class="authors-grid">
        %s
    </div>
HTML;

echo sprintf($html, $authorCards);
