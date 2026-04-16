# POC: PHP + Redis Performance Cache

Este projeto demonstra como reduzir drasticamente o tempo de resposta de uma aplicação PHP utilizando o Redis como camada de cache in-memory.

## Conceito
O Redis atua como um banco de dados de chave-valor em memória. Nesta POC, simulamos uma operação "custosa" (como uma query complexa ou integração de API) que leva 2 segundos.

- Na primeira requisição, o PHP processa os dados e os armazena no Redis.

- Nas requisições seguintes (até o cache expirar), o PHP recupera os dados do Redis instantaneamente, sem repetir o processamento pesado.

## Pontos Positivos
- Baixíssima Latência: Por rodar em RAM, as leituras são feitas em milissegundos.

- Escalabilidade: Reduz a carga no banco de dados principal (Postgres/MySQL).

- Flexibilidade: Suporta expiração automática de dados (TTL).

## Pontos Negativos
- Volatilidade: Se o Redis reiniciar sem persistência configurada, os dados em memória são perdidos.

- Custo de Memória: RAM é mais cara que disco; é preciso gerenciar o que deve ou não ser cacheado.

- Complexidade de Invalidação: Garantir que o cache seja atualizado quando o dado original mudar (o famoso "problema difícil da computação").

## Como Rodar
- Certifique-se de ter o Docker e Docker Compose instalados.

- No terminal, execute:
```bash
docker-compose up -d
```

- Acesse no navegador: http://localhost:8080

## Como Testar
- Primeiro acesso: A página demorará cerca de 2 segundos para carregar. O status indicará "Processamento Pesado".

- Refresh (F5): O carregamento será instantâneo (menos de 0.005s). O status indicará "Redis Cache".

- Expiração: Aguarde 10 segundos e atualize novamente. O ciclo se repetirá, pois o cache terá expirado.

## Painel redis

1. Acesse no seu navegador: http://localhost:5540.

2. Ao abrir, clique em "Add Redis Database".

3. No campo Host, digite redis (o nome do serviço definido no docker-compose).

4. No campo Port, mantenha 6379.

5. Dê um nome para a conexão (ex: "POC Cache") e clique em Add Redis Database.