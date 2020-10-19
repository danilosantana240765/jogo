<?php
require_once("config.php");

// Apagar a sala do banco
# Aqui estra um codigo

unset($_SESSION['sala']);

header("Location: index.php");