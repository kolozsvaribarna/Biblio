<?php

namespace App\Routing;

use App\Controllers\HomeController;
use App\Controllers\BookController;
//use App\Controllers\ReservationController;

//use App\Controllers\RoomController;
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
            /*case '/guests':
                $guestController = new GuestController;
                $guestController->index();
                return;

            case '/rooms':
                $roomsController = new RoomController;
                $roomsController->index();
                return;
*/
            default:
                $this->notFound();
        }
    }

    private function handlePostRequests(string $requestUri): void
    {
        $data = $this->filterPostData($_POST);
        $id = $data['id'] ?? null;

        switch ($requestUri) {
            case "/guests":
                if (!empty($data)) {
                    $guestController = new GuestController;
                    $guestController->save($data);
                }
                break;
            case "/guests/create":
                $guestController = new GuestController;
                $guestController->create();
                break;
            case "/guests/edit":
                $guestController = new GuestController;
                $guestController->edit($id);
                break;

            case "/reservations":
                if (!empty($data)) {
                    $reservationController = new ReservationController;
                    $reservationController->save($data);
                }
                break;
            case "/reservations/create":
                $reservationController = new ReservationController;
                $reservationController->create();
                break;
            case "/reservations/edit":
                $reservationController = new ReservationController;
                $reservationController->edit($id);
                break;

            case "/rooms":
                if (!empty($data)) {
                    $roomController = new RoomController;
                    $roomController->save($data);
                }
                break;
            case "/rooms/create":
                $roomController = new RoomController;
                $roomController->create();
                break;
            case "/rooms/edit":
                $roomController = new RoomController;
                $roomController->edit($id);
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
            case "/guests":
                $id = $data['id'] ?? null;
                $guestController = new GuestController;
                $guestController->update($id, $data);
                break;

            case "/rooms":
                $id = $data['id'] ?? null;
                $roomController = new RoomController;
                $roomController->update($id, $data);
                break;

            case "/reservations":
                $id = $data['id'] ?? null;
                $reservationController = new ReservationController;
                $reservationController->update($id, $data);
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
            case "/guests":
                $guestController = new GuestController;
                $guestController->delete((int)$data['id']);
                break;

            case "/rooms":
                $roomController = new RoomController;
                $roomController->delete((int)$data['id']);
                break;

            case "/reservations":
                $reservationController = new ReservationController;
                $reservationController->delete((int)$data['id']);
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