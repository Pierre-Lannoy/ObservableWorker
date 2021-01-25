# ObservableWorker

ObservableWorker is an asynchronous event-driven PHP framework to build fast and scalable network applications. It is forked from [Workerman](https://github.com/walkor/Workerman) and now supports PSR-3 logging. 

## Requirements
- PHP 5.4 or higher.
- A POSIX compatible operating system (Linux, OSX, BSD).
- POSIX and PCNTL extensions.

## Recommended
- Event extension for better performance.
- [Monolog](https://github.com/Seldaek/monolog) for best-in-class logging.

## Installation

```
composer require observableworker/observableworker
```

## Basic Usage

### A websocket server with Monolog logging
```php
<?php

use ObservableWorker\Worker;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/vendor/autoload.php';

// Create a Websocket server
$ws_worker = new Worker('websocket://0.0.0.0:2346');

// 4 processes
$ws_worker->count = 4;

// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    echo "New connection\n";
};

// Emitted when data received
$ws_worker->onMessage = function ($connection, $data) {
    // Send hello $data
    $connection->send('Hello ' . $data);
};

// Emitted when connection closed
$ws_worker->onClose = function ($connection) {
    echo "Connection closed\n";
};

// create a Monolog channel
Worker::logger = new Logger('name');
Worker::logger->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// Run worker
Worker::runAll();
```