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
        /*if (empty($data['name']) || empty($data['age'])) {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/guests'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->name = $data['name'];
        $this->model->age = $data['age'];
        $this->model->create();*/
        $this->redirect('/books');
    }

    public function update(int $id, array $data): void
    {
        /*$guest = $this->model->find($id);
        if (!$guest || empty($data['name']) || empty($data['age'])) {
            $this->redirect('/guests');
        }
        $guest->name = $data['name'];
        $guest->age = $data['age'];
        $guest->update();*/
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
