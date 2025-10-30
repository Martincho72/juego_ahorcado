<?php
session_start();
$palabra = $_SESSION['resultado'] ?? '';
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Has perdido</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .contenedor {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            width: 350px;
        }
        h1 {
            color: #b71c1c;
        }
        p {
            font-size: 1.2em;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #b71c1c;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            background-color: #ff7e5f;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h1>😞 Has perdido 😞</h1>
    <p>La palabra era: <strong><?php echo htmlspecialchars($palabra); ?></strong></p>
    <a href="index.php">Intentar de nuevo</a>
</div>
</body>
</html>