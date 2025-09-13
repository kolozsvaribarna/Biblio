<?php

$tableBody = "";
foreach ($books as $book) {
    $tableBody .= <<<HTML
            <tr>
                <!--<td>{$book->id}</td>-->
                <td class="table-cover"><img src="$book->cover" alt="img" <!--width="" height=""--></td>
                <td>{$book->title}</td>
                <td>$book->pages</td>
                <td>$book->ISBN</td>
                <td>$book->release_year</td>
                <td>$book->language</td>
                <td>$book->genre_id</td>
                <td>$book->author_id</td>
                <td>$book->publisher_id</td>

                <td class='flex float-right'>
                    <form method='post' action='/books/edit'>
                        <input type='hidden' name='id' value='{$book->id}'>
                        <button type='submit' name='btn-edit' title='Módosít'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/books'>
                        <input type='hidden' name='id' value='{$book->id}'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Töröl'><i class='fa fa-trash trash'></i></button>
                    </form>

                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        
        <h2>Books</h2>
        
        <table id='' class=''>
            <thead>
                <tr>
                    <!--<th>id</th>-->
                    <th class="table-cover"><!--cover--></th>
                    <th>title</th>
                    <th>pages</th>
                    <th>ISBN</th>
                    <th>release_year</th>
                    <th>language</th>
                    <th>genre_id</th>
                    <th>author_id</th>
                    <th>publisher_id</th>
                
                    <th>
                        <form method='post' action='/books/create'>
                            <button type="submit" name='btn-plus' title='Új'>
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
