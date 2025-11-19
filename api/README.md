# API de Transações

Esta é uma API REST desenvolvida em PHP com Slim Framework para gerenciamento de transações e cálculo de estatísticas.

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Composer

## Instalação

1. Clone o repositório:
```bash
git clone [seu-repositorio]
cd transacao-api
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o banco de dados:
   - Crie um banco MySQL chamado `transacoes_db`
   - Execute o script SQL em `database.sql`
   - Ajuste as credenciais em `config/database.php` se necessário

4. Configure o servidor web para apontar para a pasta `public/`

## Estrutura do Projeto

```
├── config/
│   └── database.php          # Configuração do banco (Singleton)
├── src/
│   ├── Controllers/
│   │   └── TransacaoController.php
│   └── Models/
│       └── Transacao.php
├── public/
│   └── index.php            # Ponto de entrada da aplicação
├── composer.json
├── database.sql
└── README.md
```

## Endpoints da API

### POST /transacao
Cria uma nova transação.

**Corpo da requisição:**
```json
{
  "id": "550e8400-e29b-41d4-a716-446655440000",
  "valor": 123.45,
  "dataHora": "2025-06-02T10:30:00Z"
}
```

**Respostas:**
- `201 Created`: Transação criada com sucesso
- `422 Unprocessable Entity`: Dados inválidos
- `400 Bad Request`: JSON inválido

### GET /transacao/{id}
Busca uma transação pelo ID.

**Resposta (200 OK):**
```json
{
  "id": "550e8400-e29b-41d4-a716-446655440000",
  "valor": 123.45,
  "dataHora": "2025-06-02T10:30:00"
}
```

**Respostas:**
- `200 OK`: Transação encontrada
- `404 Not Found`: Transação não encontrada

### DELETE /transacao
Remove todas as transações.

**Respostas:**
- `200 OK`: Todas as transações foram removidas

### DELETE /transacao/{id}
Remove uma transação específica.

**Respostas:**
- `200 OK`: Transação removida com sucesso
- `404 Not Found`: Transação não encontrada

### GET /estatistica
Retorna estatísticas das transações dos últimos 60 segundos.

**Resposta (200 OK):**
```json
{
  "count": 5,
  "sum": 617.25,
  "avg": 123.45,
  "min": 50.00,
  "max": 200.00
}
```

## Validações Implementadas

- **ID**: Deve ser um UUID válido e único
- **Valor**: Deve ser numérico e maior ou igual a zero
- **Data/Hora**: Deve estar no formato ISO 8601 e não pode ser no futuro
- **JSON**: Deve ser válido e conter todos os campos obrigatórios

## Design Patterns Utilizados

- **Singleton**: Implementado na classe `Database` para garantir uma única instância da conexão
- **MVC**: Separação entre Models, Controllers e configuração

## Testando a API

Use Postman, Insomnia ou curl para testar os endpoints:

```bash
# Criar transação
curl -X POST http://localhost/transacao \
  -H "Content-Type: application/json" \
  -d '{"id":"550e8400-e29b-41d4-a716-446655440000","valor":100.50,"dataHora":"2025-06-02T10:30:00Z"}'

# Buscar transação
curl -X GET http://localhost/transacao/550e8400-e29b-41d4-a716-446655440000

# Ver estatísticas
curl -X GET http://localhost/estatistica

# Deletar transação
curl -X DELETE http://localhost/transacao/550e8400-e29b-41d4-a716-446655440000

# Deletar todas as transações
curl -X DELETE http://localhost/transacao
```

## Commits Recomendados

1. `feat: configuração inicial do projeto com Slim`
2. `feat: implementação do endpoint POST /transacao`
3. `feat: implementação do endpoint GET /transacao/{id}`
4. `feat: implementação dos endpoints DELETE`
5. `feat: implementação do endpoint GET /estatistica`

## Tecnologias Utilizadas

- PHP 7.4+
- Slim Framework 4
- MySQL
- Composer
- ramsey/uuid (para geração/validação de UUIDs)
