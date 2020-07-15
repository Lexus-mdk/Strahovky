<?php
require 'rb.php';

R::setup('mysql:host=localhost;dbname=rtk_db', 'root', '');
session_start();