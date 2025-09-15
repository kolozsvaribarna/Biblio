<?php

$tableBody = "";
foreach ($books as $book) {

    $publisher = $book->getPublisher();

    // TODO authors
    // TODO genres

    $tableBody .= <<<HTML
            <tr>
                <!--<td>{$book->book_id}</td>-->
                <td class="table-cover"><img src="{$book->cover_url}" alt="img"</td>
                <td>{$book->title}</td>
                <td>{$book->isbn}</td>
                <td>{$book->pages}</td>
                <td>{$book->available_copies}</td>
                <td>{$book->language}</td>
                <td>{$book->release_year}</td>
                <td>{$publisher->name}</td>

                <td class='flex float-right'>
                    <form method='post' action='/books/edit'>
                        <input type='hidden' name='id' value='{$book->book_id}'>
                        <button type='submit' name='btn-edit' title='Edit'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/books'>
                        <input type='hidden' name='id' value='{$book->book_id}'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Delete'><i class='fa fa-trash trash'></i></button>
                    </form>

                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        
        <h2>Books</h2>
        
        <table id='' class='index-table'>
            <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th><!--cover--></th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>pages</th>
                    <th>Copies av.</th>
                    <th>language</th>
                    <th>release year</th>
                    <th>Publisher</th>
                
                    <th>
                        <form method='post' action='/books/create'>
                            <button type="submit" name='btn-plus' title='New'>
                                <i class='fa fa-plus plus'></i></button>
                        </form>
                    </th>
                </tr>
            </thead>
             <tbody>%s</tbody>
            <tfoot>
            </tfoot>
        </table>
        HTML;

echo sprintf($html, $tableBody);
