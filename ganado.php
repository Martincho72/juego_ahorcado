<?php
session_start();
$palabra = $_SESSION['resultado'] ?? '';
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Has ganado!</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #A8E063, #56AB2F);
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
            color: #2e7d32;
        }
        p {
            font-size: 1.2em;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #56AB2F;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            background-color: #A8E063;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h1>🎉 ¡Has ganado! 🎉</h1>
    <p>La palabra era: <strong><?php echo htmlspecialchars($palabra); ?></strong></p>
    <a href="index.php">Jugar de nuevo</a>
</div>
</body>
</html>