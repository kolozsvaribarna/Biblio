<?php

$tableBody = "";
foreach ($publishers as $publisher)
{
    $tableBody .= <<<HTML
            <tr>
                <td>{$publisher->publisher_id}</td>
                <td>{$publisher->name}</td>

                <td class='flex float-right'>
                    <form method='post' action='/publishers/edit'>
                        <input type='hidden' name='id' value='{$publisher->publisher_id}'>
                        <button type='submit' name='btn-edit' title='Edit'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/publishers'>
                        <input type='hidden' name='id' value='{$publisher->publisher_id}'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Delete'><i class='fa fa-trash trash'></i></button>
                    </form>

                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        
        <h2>Publishers</h2>
        
        <table id='' class='' border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>
                        <form method='post' action='/publishers/create'>
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