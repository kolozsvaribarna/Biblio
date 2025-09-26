<?php

$tableBody = "";
foreach ($genres as $genre)
{
    $tableBody .= <<<HTML
            <tr>
                <!--<td>{$genre->id}</td>-->
                <td>{$genre->name}</td>

                <td class='flex float-right'>
                    <form method='post' action='/genres/edit'>
                        <input type='hidden' name='id' value='{$genre->id}'>
                        <button type='submit' name='btn-edit' title='Edit'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/genres'>
                        <input type='hidden' name='id' value='{$genre->id}'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Delete'><i class='fa fa-trash trash'></i></button>
                    </form>

                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        
        <h2>Genres</h2>
        
        <table id='' class='' border="1">
            <thead>
                <tr>
                    <th>Genre</th>
                    <th>
                        <form method='post' action='/genres/create'>
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