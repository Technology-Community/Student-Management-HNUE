<?php
/* Load Helper */

$loadHelper = [
    'Session',
    'Input',
    'Redirect',
    'Function',
    'Database',
    'Validator',
];

require_once './config/config.php';
foreach ($loadHelper as $item) {
    require_once "./helper/$item.php";
}

$DB = new Database();
