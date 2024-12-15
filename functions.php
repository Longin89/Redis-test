<?php
require 'vendor/autoload.php';

use Predis\Client;

// Создаем экземпляр класса с настройками для подключения к redis

$redis = new Client([
    'host' => getenv('REDIS_HOST'),
    'port' => getenv('REDIS_PORT'),
]);

// Функция проверки запуска процесса в redis

function isRunning(object $redis): bool
{

// Проверяем, что c redis все в порядке, если нет - будет выведено соответствующее исключение

    try {
        return $redis->get('hello_lock') === 'running';
    } catch (\Exception $e) {
        echo ('Something goes wrong:' . ' ' . $e->getMessage());
        die();
    }
}

// Функция, выводящая сообщение сразу за счет flush(), занимает redis в течении 5 секунд

function runFoo(object $redis): void
{
    $redis->set('hello_lock', 'running');

    echo "Please, give me that job! ^_^\n";
    flush();

    sleep(5);
    $redis->del('hello_lock');
}

// Функция для вывода альтернативного сообщения

function waitFoo(): void
{
    echo "Job request already running, please wait 5 seconds ^_^\n";
}
