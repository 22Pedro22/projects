<?php

namespace App\Controllers;

use App\Models\Transacao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TransacaoController {
    private $transacao;
    
    public function __construct() {
        $this->transacao = new Transacao();
    }
    
    public function criar(Request $request, Response $response) {
        try {
            $data = json_decode($request->getBody()->getContents(), true);
            
            // Verificar se JSON é válido
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $response->withStatus(400);
            }
            
            // Tentar criar a transação
            if ($this->transacao->criar($data)) {
                return $response->withStatus(201);
            } else {
                return $response->withStatus(422);
            }
            
        } catch (Exception $e) {
            return $response->withStatus(400);
        }
    }
    
    public function buscar(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $transacao = $this->transacao->buscarPorId($id);
        
        if ($transacao) {
            $response->getBody()->write(json_encode([
                'id' => $transacao['id'],
                'valor' => (float)$transacao['valor'],
                'dataHora' => $transacao['dataHora']
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            return $response->withStatus(404);
        }
    }
    
    public function deletarTodas(Request $request, Response $response) {
        $this->transacao->deletarTodas();
        return $response->withStatus(200);
    }
    
    public function deletarPorId(Request $request, Response $response, array $args) {
        $id = $args['id'];
        
        // Verificar se a transação existe
        if (!$this->transacao->buscarPorId($id)) {
            return $response->withStatus(404);
        }
        
        $this->transacao->deletarPorId($id);
        return $response->withStatus(200);
    }
    
    public function estatisticas(Request $request, Response $response) {
        $stats = $this->transacao->obterEstatisticas();
        
        $response->getBody()->write(json_encode($stats));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
