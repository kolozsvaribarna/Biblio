<?php

namespace App\Routing;

use App\Controllers\AuthorController;
use App\Controllers\HomeController;
use App\Controllers\BookController;

//use App\Controllers\ReservationController;
//use App\Controllers\RoomController;

use App\Controllers\PublisherController;
use App\Views\Display;

class Router
{
    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        // check override
        if ($method === 'POST' && isset($_POST["_method"])) {
            $method = $_POST["_method"];
        }

        // dispatch request
        $this->dispatch($method, $requestUri);
    }

    private function dispatch(string $method, string $requestUri): void
    {
        switch ($method) {
            case 'GET':
                $this->handleGetRequests($requestUri);
                break;
            case 'POST':
                $this->handlePostRequests($requestUri);
                break;
            case 'PATCH':
                $this->handlePatchRequests($requestUri);
                break;
            case 'DELETE':
                $this->handleDeleteRequests($requestUri);
                break;
            default:
                $this->methodNotAllowed();
        }
    }

    private function handleGetRequests(string $requestUri): void
    {
        switch ($requestUri) {
            case '/':
                HomeController::index();
                return;
            case '/books':
                $bookController = new BookController;
                $bookController->index();
                return;
            case '/authors':
                $authorController = new AuthorController;
                $authorController->index();
                return;
            case '/publishers':
                $publisherController = new PublisherController;
                $publisherController->index();
                return;

            default:
                $this->notFound();
        }
    }

    private function handlePostRequests(string $requestUri): void
    {
        $data = $this->filterPostData($_POST);
        $id = $data['id'] ?? null;

        switch ($requestUri) {
            case "/books":
                if (!empty($data)) {
                    $bookController = new BookController;
                    $bookController->save($data);
                }
                break;
            case "/books/create":
                $bookController = new BookController;
                $bookController->create();
                break;
            case "/books/edit":
                $bookController = new BookController;
                $bookController->edit($id);
                break;

            case "/publishers":
                if (!empty($data)) {
                    $publisherController = new PublisherController;
                    $publisherController->save($data);
                }
                break;
            case "/publishers/create":
                $publisherController = new PublisherController;
                $publisherController->create();
                break;
            case "/publishers/edit":
                $publisherController = new PublisherController;
                $publisherController->edit($id);
                break;

            default:
                $this->notFound();
                break;
        }
    }

    private function handlePatchRequests(string $requestUri): void
    {
        $data = $this->filterPostData($_POST);

        switch ($requestUri) {
            case "/books":
                $id = $data['id'] ?? null;
                $bookController = new BookController;
                $bookController->update($id, $data);
                break;

            case "/publishers":
                $id = $data['id'] ?? null;
                $publisherController = new PublisherController;
                $publisherController->update($id, $data);
                break;

            default:
                $this->notFound();
                break;
        }
    }

    private function handleDeleteRequests(string $requestUri): void
    {
        $data = $this->filterPostData($_POST);

        switch ($requestUri) {
            case "/books":
                $bookController = new BookController;
                $bookController->delete((int)$data['id']);
                break;

            case "/publishers":
                $publisherController = new PublisherController;
                $publisherController->delete((int)$data['id']);
                break;

            default:
                $this->notFound();
                break;
        }
    }

    private function methodNotAllowed(): void
    {
        header($_SERVER["SERVER_PROTOCOL"] . ' 405 Not Found');
        Display::message("405 Method not allowed", "error");
    }

    private function notFound(): void
    {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        Display::message("404 Not found", "error");
    }

    private function filterPostData(array $data): array
    {
        // Remove unnecessary keys in a clean and simple way
        $filterKeys = ['_method', 'submit', 'btn-del', 'btn-save', 'btn-edit', 'btn-plus', 'btn-update'];
        return array_diff_key($data, array_flip($filterKeys));
    }
}