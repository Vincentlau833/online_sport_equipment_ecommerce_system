<?php


$key = bin2hex(random_bytes(16));//generate random string
define('SESSION_KEY', '$key');

