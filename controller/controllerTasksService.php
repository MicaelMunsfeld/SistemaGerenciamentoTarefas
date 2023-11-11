<?php

include 'model/ModelTasksService.php';
include 'view/ViewTasksService.php';

class controllerTasksService {

    /**
     * Instância do serviço de tarefas.
     *
     * @var modelTasksService
     */
    private $tasksService;

    /**
     * Instância da visualização de tarefas.
     *
     * @var ViewTasksService
     */
    private $tasksView;

    /**
     * Construtor da classe.
     *
     * @param modelTasksService $tasksService Instância do serviço de tarefas.
     * @return void
     */
    public function __construct(modelTasksService $tasksService) {
        $this->tasksService = $tasksService;
        $this->tasksView = new ViewTasksService();
    }

    /**
     * Manipula a requisição HTTP.
     *
     * @return void
     */
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        }
        $this->render();
    }

    /**
     * Manipula as requisições POST.
     *
     * @return void
     */
    private function handlePost() {
        if(!empty($_POST['action'])) {
            $actions = [
                'add' => function () {
                    if (!empty($_POST['description'])) {
                        $this->tasksService->addTask($_POST['description']);
                    }
                },
                'markCompleted' => function () {
                    if (!empty($_POST['taskId'])) {
                        $this->tasksService->markAsCompleted($_POST['taskId']);
                    }
                },
                'delete' => function () {
                    if (!empty($_POST['taskId'])) {
                        $this->tasksService->deleteTask($_POST['taskId']);
                    }
                },
            ];
            $action = $_POST['action'];
            $actions[$action]();
        }
    }

    /**
     * Renderiza a interface com base nas tarefas obtidas.
     *
     * @return void
     */
    private function render() {
        $this->tasksView->render($this->tasksService->getTasks());
    }

}