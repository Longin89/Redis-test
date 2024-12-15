<?php

//  Подключаем файл с функциями

require_once'functions.php';

if (!isRunning($redis)) {

    // Если процесс redis не запущен - запускаем его

    runFoo($redis);
} else {

    // Иначе - показываем пользователю альтернативный текст с просьбой подождать

    waitFoo();
}
