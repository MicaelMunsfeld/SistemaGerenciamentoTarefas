<?php

class ViewTasksService {

    /**
     * Renderiza a interface do gerenciador de tarefas.
     *
     * @param array $tasks Um array contendo as tarefas a serem exibidas. Cada tarefa é um array associativo com as chaves 'id', 'description', 'completed'.
     *
     * @return void
     */
    public function render($tasks) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gerenciador de Tarefas</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
        <div class="container">
            <h2>Gerenciador de Tarefas</h2>
            <?php if (!empty($message)): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form method="post" class="mb-3">
                <div class="input-group">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Adicionar nova tarefa" required>
                    <div class="input-group-append">
                        <button type="submit" name="action" value="add" class="btn btn-primary">Adicionar</button>
                    </div>
                </div>
            </form>
            <ul class="list-group">
                <?php foreach ($tasks as $task): ?>
                    <li class="list-group-item <?php echo $task['completed'] ? 'list-group-item-success' : ''; ?>">
                        <?php echo $task['description']; ?>
                        <div class="float-right">
                            <?php if (!$task['completed']): ?>
                                <button type="button" class="btn btn-success btn-sm" onclick="markCompleted('<?php echo $task['id']; ?>')">Concluir</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-danger btn-sm ml-2" onclick="deleteTask('<?php echo $task['id']; ?>')">Excluir</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form method="post" id="submitForm" style="display: none;">
            <input type="hidden" name="taskId" id="taskId">
            <input type="hidden" name="action" id="action">
            <button type="submit"></button>
        </form>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>

        </body>
        </html>
        <?php
    }

}