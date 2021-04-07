<?php
require_once './autoload/Autoload.php';
Session::forget("auth");
Redirect::url('index.php');
