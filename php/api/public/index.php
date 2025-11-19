<?php

require_once '../vendor/autoload.php';
require_once '../config/database.php';

use Slim\Factory\AppFactory;
use App\Controllers\TransacaoController;

// Criar aplicação Slim
$app = AppFactory::create();

// Middleware para parsing do JSON
$app->addBodyParsingMiddleware();

// Middleware para erros
$app->addErrorMiddleware(true, true, true);

// Instanciar controller
$transacaoController = new TransacaoController();

// Definir rotas
$app->post('/transacao', [$transacaoController, 'criar']);
$app->get('/transacao/{id}', [$transacaoController, 'buscar']);
$app->delete('/transacao', [$transacaoController, 'deletarTodas']);
$app->delete('/transacao/{id}', [$transacaoController, 'deletarPorId']);
$app->get('/estatistica', [$transacaoController, 'estatisticas']);

// Executar aplicação
$app->run();
