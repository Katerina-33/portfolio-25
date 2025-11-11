<?php
foreach (glob(__DIR__ . "/functions/*.php") as $file) {
    require_once $file;
}