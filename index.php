<?php
session_start();

// Lista de palabras para el juego
$palabras = ['elefante', 'jirafa', 'hipopotamo', 'rinoceronte', 'cocodrilo', 'camello', 'chimpance', 'leon', 'tigre', 'zorro', 'pantera', 'antilope'];

// Inicializar el juego
if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = $palabras[array_rand($palabras)];
    $_SESSION['vidas'] = 6; // Número máximo de vidas
    $_SESSION['letras_acertadas'] = str_repeat('?', strlen($_SESSION['palabra']));
    $_SESSION['letras_usadas'] = [];
}

// Procesar la letra enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['letra'])) {
    $letra = strtolower($_POST['letra']);

    // Verificar si la letra ya se ha usado
    if (in_array($letra, $_SESSION['letras_usadas'])) {
        echo "Ya has usado la letra '$letra'. Intenta con otra.<br>";
    } else {
        // Añadir la letra a las usadas
        $_SESSION['letras_usadas'][] = $letra;

        // Verificar si la letra está en la palabra secreta
        if (strpos($_SESSION['palabra'], $letra) !== false) {
            for ($i = 0; $i < strlen($_SESSION['palabra']); $i++) {
                if ($_SESSION['palabra'][$i] == $letra) {
                    $_SESSION['letras_acertadas'][$i] = $letra;
                }
            }
        } else {
            $_SESSION['vidas']--;
        }
    }
}

// Comprobar si se ha ganado o perdido
if ($_SESSION['letras_acertadas'] == $_SESSION['palabra']) {
    $_SESSION['resultado'] = $_SESSION['palabra'];
    header("Location: ganado.php");
    exit();
} elseif ($_SESSION['vidas'] <= 0) {
    $_SESSION['resultado'] = $_SESSION['palabra'];
    header("Location: perdido.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ahorcado</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contenedor {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            width: 350px;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 1.1em;
            color: #555;
        }

        input[type="text"] {
            padding: 8px;
            width: 50px;
            text-align: center;
            font-size: 1.2em;
            border: 2px solid #74ebd5;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #ACB6E5;
        }

        button {
            background-color: #74ebd5;
            color: #333;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #ACB6E5;
        }

        p strong {
            font-weight: bold;
            color: #333;
        }

        p:nth-of-type(1) {
            font-size: 1.3em;
            letter-spacing: 3px;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h1>Juego del Ahorcado</h1>
    <p>Palabra secreta: <?php echo $_SESSION['letras_acertadas']; ?></p>
    <p>Vidas restantes: <?php echo $_SESSION['vidas']; ?></p>
    <form method="post">
        <label for="letra">Introduce una letra:</label>
        <input type="text" name="letra" id="letra" maxlength="1" required>
        <button type="submit">Adivinar</button>
    </form>
    <p>Letras usadas: <?php echo implode(', ', $_SESSION['letras_usadas']); ?></p>
</div>
</body>
</html>