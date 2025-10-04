<?php
namespace App\Controllers;
use App\Models\BooksModel;

class BookController extends Controller {

    public function __construct()
    {
        $book = new BooksModel;
        parent::__construct($book);
    }

    public function index(): void
    {
        $books = $this->model->all(['order_by' => ['title'], 'direction' => ['ASC']]);
        $this->render('books/index', ['books' => $books, 'title' => 'Biblio - Books']);
    }

    public function filter(): void
    {
        $filters = [];

        if (!empty($_GET['publisher'])) {
            $filters['publisher_id'] = (int) $_GET['publisher'];
        }

        if (!empty($_GET['authors']) && is_array($_GET['authors'])) {
            $authors = array_map('intval', $_GET['authors']);
            if (!empty($authors)) {
                $filters['author_id'] = $authors;
            }
        }

        if (!empty($_GET['genres']) && is_array($_GET['genres'])) {
            $genres = array_map('intval', $_GET['genres']);
            if (!empty($genres)) {
                $filters['genre_id'] = $genres;
            }
        }

        if (!empty($_GET['language'])) {
            $filters['language'] = strtoupper(substr($_GET['language'], 0, 2));
        }

        $books = $this->model->filter($filters, ['order_by' => ['title'], 'direction' => ['ASC']]);
        $this->render('books/index', ['books' => $books, 'title' => 'Biblio - Books']);
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
            || empty($data['isbn'])
            || empty($data['pages'])
            || empty($data['cover_url'])
            || empty($data['available_copies'])
            || empty($data['language'])
            || empty($data['release_year'])
            || empty($data['publisher_id'])
            || empty($data['authors'])
            || empty($data['genres']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books');
        }
        $this->model->title = $data['title'];
        $this->model->isbn = $data['isbn'];
        $this->model->pages = $data['pages'];
        $this->model->cover_url = $data['cover_url'];
        $this->model->available_copies = $data['available_copies'];
        $this->model->language = $data['language'];
        $this->model->release_year = $data['release_year'];
        $this->model->publisher_id = $data['publisher_id'];

        $bookId = $this->model->create();

        $this->model->saveBookAuthor($bookId, $data['authors']);
        $this->model->saveBookGenre($bookId, $data['genres']);

        $this->redirect('/books');
    }

    public function update(int $id, array $data): void
    {
        $book = $this->model->find($id);
        if (!$book
        || empty($data['title'])
        || empty($data['isbn'])
        || empty($data['pages'])
        || empty($data['cover_url'])
        || empty($data['available_copies'])
        || empty($data['language'])
        || empty($data['release_year'])
        || empty($data['publisher_id'])
        || empty($data['authors'])
        || empty($data['genres']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/books');
        }

        $book->id = $data['id'];
        $book->title = $data['title'];
        $book->isbn = $data['isbn'];
        $book->pages = $data['pages'];
        $book->cover_url = $data['cover_url'];
        $book->available_copies = $data['available_copies'];
        $book->language = $data['language'];
        $book->release_year = $data['release_year'];
        $book->publisher_id = $data['publisher_id'];

        $this->model->editBookAuthor($id, $data['authors']);
        $this->model->editBookGenre($id, $data['genres']);

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
