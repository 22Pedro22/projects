<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class Transacao {
    private $db;
    
    public function __construct() {
        $this->db = \Database::getInstance()->getConnection();
    }
    
    public function criar($data) {
        // Validações
        if (!$this->validarDados($data)) {
            return false;
        }
        
        // Verificar se ID já existe
        if ($this->buscarPorId($data['id'])) {
            return false;
        }
        
        $sql = "INSERT INTO transacoes (id, valor, dataHora) VALUES (:id, :valor, :dataHora)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':id' => $data['id'],
            ':valor' => $data['valor'],
            ':dataHora' => $data['dataHora']
        ]);
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT * FROM transacoes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch();
    }
    
    public function deletarTodas() {
        $sql = "DELETE FROM transacoes";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute();
    }
    
    public function deletarPorId($id) {
        $sql = "DELETE FROM transacoes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }
    
    public function obterEstatisticas() {
        // Transações dos últimos 60 segundos
        $dataLimite = date('Y-m-d H:i:s', time() - 60);
        
        $sql = "SELECT 
                    COUNT(*) as count,
                    COALESCE(SUM(valor), 0) as sum,
                    COALESCE(AVG(valor), 0) as avg,
                    COALESCE(MIN(valor), 0) as min,
                    COALESCE(MAX(valor), 0) as max
                FROM transacoes 
                WHERE dataHora >= :dataLimite";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':dataLimite' => $dataLimite]);
        
        $resultado = $stmt->fetch();
        
        // Se não há transações, retornar zeros
        if ($resultado['count'] == 0) {
            return [
                'count' => 0,
                'sum' => 0.0,
                'avg' => 0.0,
                'min' => 0.0,
                'max' => 0.0
            ];
        }
        
        return [
            'count' => (int)$resultado['count'],
            'sum' => (float)$resultado['sum'],
            'avg' => (float)$resultado['avg'],
            'min' => (float)$resultado['min'],
            'max' => (float)$resultado['max']
        ];
    }
    
    private function validarDados($data) {
        // Verificar se todos os campos obrigatórios estão presentes
        if (!isset($data['id']) || !isset($data['valor']) || !isset($data['dataHora'])) {
            return false;
        }
        
        // Validar UUID
        if (!Uuid::isValid($data['id'])) {
            return false;
        }
        
        // Validar valor (não negativo)
        if (!is_numeric($data['valor']) || $data['valor'] < 0) {
            return false;
        }
        
        // Validar data (não pode ser no futuro)
        $dataTransacao = strtotime($data['dataHora']);
        if (!$dataTransacao || $dataTransacao > time()) {
            return false;
        }
        
        return true;
    }
}
