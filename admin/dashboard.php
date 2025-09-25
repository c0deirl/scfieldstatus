<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$dataFile = '../status_data.json';
$data = json_decode(file_get_contents($dataFile), true);

$status = $data['field1'] ?? 'closed';
$fields = $data['field2'] ?? 'closed';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = false;

    if (isset($_POST['field1']) && in_array($_POST['field1'], ['open', 'closed'])) {
        $data['field1'] = $_POST['field1'];
        $status = $_POST['field1'];
        $updated = true;
    }
    if (isset($_POST['field2']) && in_array($_POST['field2'], ['open', 'closed'])) {
        $data['field2'] = $_POST['field2'];
        $fields = $_POST['field2'];
        $updated = true;
    }

    if ($updated) {
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        $message = "Statuses updated.";
    } else {
        $message = "Invalid status value(s).";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
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
    .card {
      background: white;
      padding: 2rem 2.5rem;
      border-radius: 2rem;
      box-shadow: 0 6px 12px rgb(0 0 0 / 0.1);
      width: 100%;
      max-width: 90vw;
      user-select: none;
    }
    .status-display {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      background: #f7fafc;
      margin-bottom: 2rem;
      padding: 2rem 0; 
      box-shadow:
        0 4px 6px rgba(0, 0, 0, 0.1),
        inset 0 -4px 6px rgba(0,0,0,0.05);
      user-select: none;
      color: white;
      display: flex;
      border-radius: 2rem;
      justify-content: space-evenly;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;

    }
    .status-box {
      flex: 0 1 300px;
      padding: 2rem 2rem;
      min-height: 100px:
      border-radius: 4rem;
      color: white;
      font-weight: 700;
      user-select: none;
      box-shadow:
        0 4px 6px rgba(0, 0, 0, 0.1),
        inset 0 -4px 6px rgba(0,0,0,0.05);
      text-align: center;
      font-size: 1rem;
    }
    .status-box.system-open {
      background-color: #2f855a;
      border-radius: 2rem;
      box-shadow:
        0 4px 6px rgba(0, 0, 0, 0.1),
        inset 0 -4px 6px rgba(0,0,0,0.05);

    }
    .status-box.system-closed {
      background-color: #e53e3e;
      border-radius: 2rem;
    }
    .status-box.fields-open {
      background-color: #2f855a;
      border-radius: 2rem;
      box-shadow:
        0 4px 6px rgba(0, 0, 0, 0.1),
        inset 0 -4px 6px rgba(0,0,0,0.05);

    }
    .status-box.fields-closed {
      background-color: #e53e3e;
      border-radius: 2rem;
    }
    .message {
      color: #2f855a;
      font-weight: 700;
      margin-bottom: 1rem;
      min-height: 1.5em;
    }
    form {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .field-group {
      flex: 1 1 48%;
      background: #f7fafc;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    }
    .field-group h2 {
      margin-top: 0;
      margin-bottom: 1rem;
      font-size: 1.25rem;
      color: #2c5282;
    }
    .buttons {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }
    button {
      flex: 1 1 100px;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 0.75rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      box-shadow: 0 4px 12px rgb(43 108 176 / 0.4);
      transition: background-color 0.3s ease, transform 0.2s ease;
      color: white;
      user-select: none;
    }
    button.open {
      background-color: #2f855a;
    }
    button.open:hover,
    button.open:focus {
      background-color: #276749;
      outline: none;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgb(39 103 73 / 0.6);
    }
    button.closed {
      background-color: #e53e3e;
    }
    button.closed:hover,
    button.closed:focus {
      background-color: #9b2c2c;
      outline: none;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgb(155 44 44 / 0.6);
    }
    a.logout {
      display: inline-block;
      margin-top: 1rem;
      color: #888;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
      user-select: none;
    }
    a.logout:hover,
    a.logout:focus {
      color: #2b6cb0;
      outline: none;
    }
    @media (max-width: 480px) {
      h1 {
        font-size: 2rem;
      }
      .card {
        width: 90vw; 
        padding: 1.5rem 1.75rem;
      }
      .status-display {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 1rem;
      }
      .status-box {
        flex: 1 1 100%;
        font-size: 1rem;
        padding: 2rem;
        width: 100%;
      }
      .field-group {
        flex: 1 1 100%;
      }
      button {
        flex: 1 1 100%;
        font-size: 1.1rem;
        padding: 0.6rem;
      }
    }
  </style>
</head>
<body>
  <header>
    RVSC Field Status Dashboard - Admin
  </header>
  <main>
    <h1>Field Status</h1>
    <div class="card" role="region" aria-live="polite">
      <div class="status-display" aria-label="Current statuses">
        <div class="status-box system-<?= htmlspecialchars($status === 'open' ? 'open' : 'closed') ?>">
          Parkersburg: <?= strtoupper($status) ?>
        </div>
        <div class="status-box fields-<?= htmlspecialchars($fields === 'open' ? 'open' : 'closed') ?>">
          Williamstown: <?= strtoupper($fields) ?>
        </div>
      </div>
      <?php if ($message): ?>
        <div class="message" id="message"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>
      <form method="post" aria-label="Change system and fields status">
        <div class="field-group" aria-labelledby="system-status-label">
          <h2 id="system-status-label">Parkersburg Status</h2>
          <div class="buttons">
            <button type="submit" name="field1" value="open" class="open" aria-pressed="<?= $status === 'open' ? 'true' : 'false' ?>">Open</button>
            <button type="submit" name="field1" value="closed" class="closed" aria-pressed="<?= $status === 'closed' ? 'true' : 'false' ?>">Closed</button>
          </div>
        </div>
        <div class="field-group" aria-labelledby="fields-status-label">
          <h2 id="fields-status-label">Williamstown Status</h2>
          <div class="buttons">
            <button type="submit" name="field2" value="open" class="open" aria-pressed="<?= $fields === 'open' ? 'true' : 'false' ?>">Open</button>
            <button type="submit" name="field2" value="closed" class="closed" aria-pressed="<?= $fields === 'closed' ? 'true' : 'false' ?>">Closed</button>
          </div>
        </div>
      </form>
      <a href="logout.php" class="logout" aria-label="Logout from admin dashboard">Logout</a>
    </div>
  </main>
</body>
</html>