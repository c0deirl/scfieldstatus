<?php
session_start();
$data = json_decode(file_get_contents('../status_data.json'), true);
$pin = $data['pin'] ?? '1234';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputPin = $_POST['pin'] ?? '';
    if ($inputPin === $pin) {
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid PIN.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <style>
    /* Reset */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #444444;
      color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Header banner */
    header {
      background-color: #2b6cb0;
      color: white;
      padding: 1rem 2rem;
      font-size: 1.5rem;
      font-weight: 700;
      text-align: center;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      user-select: none;
      flex-shrink: 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    main {
      flex: 1 0 auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      text-align: center;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #ffffff;
      letter-spacing: 1px;
    }

    form {
      background: white;
      padding: 2rem 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 6px 12px rgb(0 0 0 / 0.1);
      width: 320px;
      max-width: 90vw;
    }

    input[type="text"] {
      font-size: 1.5rem;
      padding: 0.5rem 0.75rem;
      width: 100%;
      border: 2px solid #cbd5e0;
      border-radius: 0.5rem;
      text-align: center;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus {
      border-color: #2b6cb0;
      outline: none;
      box-shadow: 0 0 5px #2b6cb0aa;
    }

    button {
      margin-top: 1.5rem;
      width: 100%;
      font-size: 1.25rem;
      font-weight: 600;
      padding: 0.75rem;
      border: none;
      border-radius: 0.5rem;
      background-color: #2b6cb0;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      box-shadow: 0 4px 12px rgb(43 108 176 / 0.4);
    }
    button:hover,
    button:focus {
      background-color: #2c5282;
      transform: translateY(-2px);
      outline: none;
      box-shadow: 0 6px 18px rgb(44 82 130 / 0.6);
    }

    .error {
      color: #e53e3e;
      font-weight: 700;
      margin-bottom: 1rem;
      user-select: none;
    }

    p.back-link {
      margin-top: 1.5rem;
    }

    p.back-link a {
      color: #ffffff;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }
    p.back-link a:hover,
    p.back-link a:focus {
      color: #2c5282;
      outline: none;
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 2rem;
      }
      form {
        padding: 1.5rem 1.75rem;
        width: 90vw;
      }
      input[type="text"] {
        font-size: 1.25rem;
      }
      button {
        font-size: 1.1rem;
        padding: 0.6rem;
      }
    }
  </style>
</head>
<body>
  <header>
    RVSC Field Status Dashboard - Admin Login
  </header>
  <main>
    <h1>Login</h1>
    <?php if ($error): ?>
      <div class="error" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="" novalidate>
      <input type="text" name="pin" maxlength="4" pattern="\d{4}" placeholder="Enter 4-digit PIN" required autofocus autocomplete="off" inputmode="numeric" />
      <button type="submit">Login</button>
    </form>
    <p class="back-link"><a href="../index.php" aria-label="Back to System Status">Back to Status Page</a></p>
  </main>
</body>
</html>