<?php

class modelTasksService {

    /**
     * Adiciona uma nova tarefa à lista.
     *
     * @param string $description Descrição da nova tarefa.
     * @return void
     */
    public function addTask($description) {
        $this->startSession();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['tasks'])) {
                $_SESSION['tasks'] = [];
            }
            $task = [
                'id' => uniqid(),
                'description' => $description,
                'completed' => false,
            ];
            $_SESSION['tasks'][] = $task;
        }
        $this->endSession();
    }

    /**
     * Obtém todas as tarefas armazenadas na sessão.
     *
     * @return array Array contendo todas as tarefas.
     */
    public function getTasks() {
        $this->startSession();
        $tasks = $_SESSION['tasks'] ?? [];
        $this->endSession();
        return $tasks;
    }

    /**
     * Marca uma tarefa como concluída com base no ID da tarefa.
     *
     * @param string $taskId ID da tarefa a ser marcada como concluída.
     * @return void
     */
    public function markAsCompleted($taskId) {
        $this->startSession();
        $_SESSION['tasks'] = array_map(
            fn($task) => $task['id'] === $taskId ? ['id' => $task['id'], 'description' => $task['description'], 'completed' => true] : $task,
            $_SESSION['tasks'] ?? []
        );
        $this->endSession();
    }

    /**
     * Exclui uma tarefa com base no ID da tarefa.
     *
     * @param string $taskId ID da tarefa a ser excluída.
     * @return void
     */
    public function deleteTask($taskId) {
        $this->startSession();
        $_SESSION['tasks'] = array_filter($_SESSION['tasks'] ?? [], fn($task) => $task && array_key_exists('id', $task) && $task['id'] !== $taskId);
        $this->endSession();
    }
    
    /**
     * Inicia a sessão se ainda não estiver iniciada.
     *
     * @return void
     */
    private function startSession() {
        if (session_status() == PHP_SESSION_NONE) session_start();
    }

    /**
     * Encerra a sessão.
     *
     * @return void
     */
    private function endSession() {
        session_write_close();
    }

}