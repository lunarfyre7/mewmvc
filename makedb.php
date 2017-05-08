<?php
$CONF = include 'config.php';
function makedb ($type) {

    $sql = "
    CREATE TABLE pages(
        id INTEGER PRIMARY KEY,
        title VARCHAR,
        body TEXT,
        created DATETIME DEFAULT CURRENT_TIMESTAMP
    )
    ";
    switch($type) {
        case 'sqlite':
            $db = new PDO('sqlite:db.sqlite');
            $db->exec($sql);
        break;
    }
}

switch ($argv[1]) {
    case 'help':
        echo 'Available options:'
                .'create: (re)create db';
    case 'create': 
        makedb($CONF['db']['type']);
        echo 'DB created.';
}