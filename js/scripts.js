/**
 * Marca uma tarefa como concluída e envia o formulário.
 *
 * @param {string} taskId - ID da tarefa a ser marcada como concluída.
 * 
 * @return {void}
 */
function markCompleted(taskId) {
    document.getElementById('taskId').value = taskId;
    document.getElementById('action').value = 'markCompleted';
    document.getElementById('submitForm').submit();
}

/**
 * Exclui uma tarefa e envia o formulário.
 *
 * @param {string} taskId - ID da tarefa a ser excluída.
 * 
 * @return {void}
 */
function deleteTask(taskId) {
    document.getElementById('taskId').value = taskId;
    document.getElementById('action').value = 'delete';
    document.getElementById('submitForm').submit();
}