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
        $authors = $this->model->all(['order_by' => ['author_id'], 'direction' => ['ASC']]);
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
        /*if (empty($data['title']) //empty($data['book_id'])
            || empty($data['isbn'])
            || empty($data['pages'])
            || empty($data['cover_url'])
            || empty($data['available_copies'])
            || empty($data['language'])
            || empty($data['release_year'])
            || empty($data['publisher_id']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books');
        }*/
        //$this->model->title = $data['title'];



        $this->model->create();
        $this->redirect('/authors');
    }

    public function update(int $id, array $data): void
    {
        /*
        $book = $this->model->find($id);
        if (!$book
            || empty($data['title'])
            || empty($data['isbn'])
            || empty($data['pages'])
            || empty($data['cover_url'])
            || empty($data['available_copies'])
            || empty($data['language'])
            || empty($data['release_year'])
            || empty($data['publisher_id']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books');
        }

        $book->book_id = $data['book_id'];
        $book->title = $data['title'];
        $book->isbn = $data['isbn'];
        $book->pages = $data['pages'];
        $book->cover_url = $data['cover_url'];
        $book->available_copies = $data['available_copies'];
        $book->language = $data['language'];
        $book->release_year = $data['release_year'];
        $book->publisher_id = $data['publisher_id'];

        $book->update();*/
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
