<?php
namespace App\Controllers;
use App\Models\AuthorsModel;

use App\Views\Display;

class AuthorController extends Controller {

    public function __construct()
    {
        $author = new AuthorsModel;
        parent::__construct($author);
    }

    public function index(): void
    {
        $authors = $this->model->all(['order_by' => ['id'], 'direction' => ['ASC']]);
        $this->render('authors/index', ['authors' => $authors]);
    }

    public function create(): void
    {
        $this->render('authors/create');
    }
    public function edit(int $id): void
    {
        $author = $this->model->find($id);
        if (!$author) {
            $_SESSION['warning_message'] = "Author with the id $id can not be found.";
            $this->redirect('/authors');
        }
        $this->render('authors/edit', ['author' => $author]);
    }

    public function save(array $data): void
    {
        if (empty($data['first_name'])
            || empty($data['last_name'])
            || empty($data['bio']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/authors');
        }
        $this->model->first_name = $data['first_name'];
        $this->model->last_name = $data['last_name'];
        $this->model->bio = $data['bio'];

        $this->model->create();
        $this->redirect('/authors');
    }

    public function update(int $id, array $data): void
    {

        $author = $this->model->find($id);
        if (!$author
            || empty($data['first_name'])
            || empty($data['last_name'])
            || empty($data['bio']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/authors');
        }
        $author->first_name = $data['first_name'];
        $author->last_name = $data['last_name'];
        $author->bio = $data['bio'];

        $author->update();
        $this->redirect('/authors');
    }

    function show(int $id): void
    {
        $author = $this->model->find($id);
        if (!$author) {
            $_SESSION['warning_message'] = "Author with the id $id cannot be found.";
            $this->redirect('/authors');
        }
        $this->render('authors/show', ['author' => $author]);
    }

    function delete(int $id): void
    {
        $author = $this->model->find($id);
        if ($author) {
            $result = $author->delete();
            echo $result;
            if ($result) {
                $_SESSION['success_message'] = 'Author deleted successfully.';
            }
        }

        $this->redirect('/authors');
    }
}
