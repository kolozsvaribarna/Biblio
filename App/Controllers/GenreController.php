<?php
namespace App\Controllers;

use App\Models\GenreModel;
use App\Views\Display;

class GenreController extends Controller {

    public function __construct()
    {
        $genre = new GenreModel();
        parent::__construct($genre);
    }

    public function index(): void
    {
        $genres = $this->model->all(['order_by' => ['id'], 'direction' => ['ASC']]);
        $this->render('genres/index', ['genres' => $genres]);
    }

    public function create(): void
    {
        $this->render('genres/create');
    }
    public function edit(int $id): void
    {
        $genre = $this->model->find($id);
        if (!$genre) {
            $_SESSION['warning_message'] = "Genre with the id $id can not be found.";
            $this->redirect('/genres');
        }
        $this->render('genres/edit', ['genre' => $genre]);
    }

    public function save(array $data): void
    {
        if (empty($data['name']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/genres');
        }
        $this->model->name = $data['name'];

        $this->model->create();
        $this->redirect('/genres');
    }

    public function update(int $id, array $data): void
    {
        $genre = $this->model->find($id);
        if (!$genre || empty($data['name']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/genres');
        }

        $genre->name = $data['name'];

        $genre->update();
        $this->redirect('/genres');
    }

    function show(int $id): void
    {
        $genre = $this->model->find($id);
        if (!$genre) {
            $_SESSION['warning_message'] = "Genre with the id $id cannot be found.";
            $this->redirect('/genres');
        }
        $this->render('genres/show', ['genre' => $genre]);
    }

    function delete(int $id): void
    {
        $genre = $this->model->find($id);
        if ($genre) {
            $result = $genre->delete();
            echo $result;
            if ($result) {
                $_SESSION['success_message'] = 'Genre deleted successfully.';
            }
        }

        $this->redirect('/genres');
    }

}
