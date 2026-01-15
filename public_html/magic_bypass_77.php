<?php
session_start();
// Simula que el pago se ha realizado
$_SESSION['premium_active'] = true;

// Redirige al dashboard de ejemplo (España)
header("Location: /country/spain");
exit;
