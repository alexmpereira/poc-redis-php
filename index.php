<?php

$redis = new \Redis();
$redis->connect('redis', 6379);

$cacheKey = 'performance_poc_data';
$isCached = $redis->exists($cacheKey);

$start = microtime(true);

if ($isCached) {
    // Recupera do Redis
    $data = $redis->get($cacheKey);
    $source = "Redis Cache";
} else {
    // Simula uma consulta pesada de 2 segundos (ex: SQL complexo ou API externa)
    sleep(2);
    $data = "Dados processados em " . date('H:i:s');

    // Salva no Redis por 10 segundos
    $redis->setex($cacheKey, 10, $data);
    $source = "Processamento Pesado (DB Simulado)";
}

$executionTime = microtime(true) - $start;

echo "<h2>Fonte: $source</h2>";
echo "<p>Conteúdo: $data</p>";
echo "<p>Tempo de execução: <strong>" . number_format($executionTime, 4) . " segundos</strong></p>";
echo "<hr>";
echo "<a href='/'>Atualizar Página</a>";