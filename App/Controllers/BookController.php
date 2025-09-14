<?php
namespace App\Controllers;
use App\Models\BooksModel;
//use App\Models\ReservationsModel;

use App\Views\Display;

class BookController extends Controller {

    public function __construct()
    {
        $book = new BooksModel;
        parent::__construct($book);
    }

    public function index(): void
    {
        $books = $this->model->all(['order_by' => ['id'], 'direction' => ['ASC']]);
        $this->render('books/index', ['books' => $books]);
    }

    public function create(): void
    {
        $this->render('books/create');
    }
    public function edit(int $id): void
    {
        $book = $this->model->find($id);
        if (!$book) {
            $_SESSION['warning_message'] = "Book with the id $id can not be found.";
            $this->redirect('/books');
        }
        $this->render('books/edit', ['book' => $book]);
    }

    public function save(array $data): void
    {
        if (empty($data['title'])
            || empty($data['pages'])
            || empty($data['ISBN'])
            || empty($data['release_year'])
            || empty($data['language'])
            || empty($data['genre_id'])
            || empty($data['author_id'])
            || empty($data['publisher_id'])
            || empty($data['cover']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->title = $data['title'];
        $this->model->pages = $data['pages'];
        $this->model->ISBN = $data['ISBN'];
        $this->model->release_year = $data['release_year'];
        $this->model->language = $data['language'];
        $this->model->genre_id = $data['genre_id'];
        $this->model->author_id = $data['author_id'];
        $this->model->publisher_id = $data['publisher_id'];
        $this->model->cover = $data['cover'];

        $this->model->create();
        $this->redirect('/books');
    }

    public function update(int $id, array $data): void
    {
        $book = $this->model->find($id);
        if (!$book
            || empty($data['id'])
            || empty($data['title'])
            || empty($data['pages'])
            || empty($data['ISBN'])
            || empty($data['release_year'])
            || empty($data['language'])
            || empty($data['genre_id'])
            || empty($data['author_id'])
            || empty($data['publisher_id'])
            || empty($data['cover']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books');
        }

        $book->id = $data['id'];
        $book->title = $data['title'];
        $book->pages = $data['pages'];
        $book->ISBN = $data['ISBN'];
        $book->release_year = $data['release_year'];
        $book->language = $data['language'];
        $book->genre_id = $data['genre_id'];
        $book->author_id = $data['author_id'];
        $book->publisher_id = $data['publisher_id'];
        $book->cover = $data['cover'];

        $book->update();
        $this->redirect('/books');
    }

    function show(int $id): void
    {
        $book = $this->model->find($id);
        if (!$book) {
            $_SESSION['warning_message'] = "Book with the id $id cannot be found.";
            $this->redirect('/books');
        }
        $this->render('books/show', ['book' => $book]);
    }

    function delete(int $id): void
    {
        $book = $this->model->find($id);
        if ($book) {
            $result = $book->delete();
            echo $result;
            if ($result) {
                $_SESSION['success_message'] = 'Book deleted successfully.';
            }
        }

        $this->redirect('/books');
    }

}
