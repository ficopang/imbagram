<?php
session_start();
session_unset();
session_destroy();

session_regenerate_id(true);

header('location: ../views/login.php');