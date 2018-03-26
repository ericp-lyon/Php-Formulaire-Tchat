<?php

use App\DBH;

require_once __DIR__ . '/../../vendor/autoload.php';

return Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(DBH::get());