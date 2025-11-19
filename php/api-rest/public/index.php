<?php

date_default_timezone_set('America/Recife');

require_once '../vendor/autoload.php';
require_once '../config/database.php';

use Slim\Factory\AppFactory;
use App\Controllers\TransacaoController;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->addErrorMiddleware(true, true, true);

$transacaoController = new TransacaoController();

$app->post('/transacao', [$transacaoController, 'criar']);
$app->get('/transacao/{id}', [$transacaoController, 'buscar']);
$app->delete('/transacao', [$transacaoController, 'deletarTodas']);
$app->delete('/transacao/{id}', [$transacaoController, 'deletarPorId']);
$app->get('/estatistica', [$transacaoController, 'estatisticas']);

$app->run();
