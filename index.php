<?php

require_once 'controller/ControllerTasksService.php';

$oModelTasks      = new ModelTasksService();
$oControllerTasks = new ControllerTasksService($oModelTasks);
$oControllerTasks->handleRequest();