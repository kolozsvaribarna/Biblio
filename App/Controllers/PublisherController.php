<?php
namespace App\Controllers;

use App\Models\PublisherModel;
use App\Views\Display;

class PublisherController extends Controller {

    public function __construct()
    {
        $publisher = new PublisherModel();
        parent::__construct($publisher);
    }

    public function index(): void
    {
        $publishers = $this->model->all(['order_by' => ['id'], 'direction' => ['ASC']]);
        $this->render('publishers/index', ['publishers' => $publishers]);
    }

    public function create(): void
    {
        $this->render('publishers/create');
    }
    public function edit(int $id): void
    {
        $publisher = $this->model->find($id);
        if (!$publisher) {
            $_SESSION['warning_message'] = "Publisher with the id $id can not be found.";
            $this->redirect('/publishers');
        }
        $this->render('publishers/edit', ['publisher' => $publisher]);
    }

    public function save(array $data): void
    {
        if (empty($data['name']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/publishers');
        }
        $this->model->name = $data['name'];

        $this->model->create();
        $this->redirect('/publishers');
    }

    public function update(int $id, array $data): void
    {
        $publisher = $this->model->find($id);
        if (!$publisher || empty($data['name']))
        {
            $_SESSION['warning_message'] = "All fields are required.";
            $this->redirect('/publishers');
        }
        
        $publisher->name = $data['name'];

        $publisher->update();
        $this->redirect('/publishers');
    }

    function show(int $id): void
    {
        $publisher = $this->model->find($id);
        if (!$publisher) {
            $_SESSION['warning_message'] = "Publisher with the id $id cannot be found.";
            $this->redirect('/publishers');
        }
        $this->render('publishers/show', ['publisher' => $publisher]);
    }

    function delete(int $id): void
    {
        $publisher = $this->model->find($id);
        if ($publisher) {
            $result = $publisher->delete();
            echo $result;
            if ($result) {
                $_SESSION['success_message'] = 'Publisher deleted successfully.';
            }
        }

        $this->redirect('/publishers');
    }

}
