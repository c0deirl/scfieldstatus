<?php
$data = json_decode(file_get_contents('status_data.json'), true);
$status = $data['status'] ?? 'closed';
$fields = $data['fields'] ?? 'closed';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>System Status</title>
  <style>
    /* (Keep existing CSS from previous index.php with header image) */
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
      color: #ffffff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    header {
      flex-shrink: 0;
      top: 0;
      z-index: 1000;
      background-color: #444444;
      user-select: none;
      text-align: center;
      
    }
    header img {
      max-height: 200px;
      width: 100%;
      vertical-align: middle;
    }
    main {
      flex: 1 0 auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      text-align: center;
      gap: 2rem;
    }
    h1 {
      font-size: 2.5rem;
      margin-bottom: 0.25em;
      letter-spacing: 1px;
      color: #ffffff;
    }
.flex-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.flex-container > div {
 
  margin: 5px;
 
  min-width: 20%;
  font-size: 20px;
  align-content: center;
  align-items: center;
  padding: 1rem 1rem;

}

    .status-container {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      width: 100%;
      max-width: 600px;
    }
    .status-box {
      flex: 1 1 250px;
      font-size: 3.5rem;
      font-weight: 700;
      text-transform: uppercase;
      border-radius: 1rem;
      padding: 1.5rem 2rem;
      box-shadow:
        0 4px 6px rgba(0, 0, 0, 0.1),
        inset 0 -4px 6px rgba(0,0,0,0.05);
      user-select: none;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-width: 200px;
    }
    .status-box.status-open {
      background-color: #2f855a; /* Green */
      box-shadow:
        0 4px 6px rgba(47, 133, 90, 0.4),
        inset 0 -4px 6px rgba(47, 133, 90, 0.6);
    }
    .status-box.status-closed {
      background-color: #e53e3e; /* Red */
      box-shadow:
        0 4px 6px rgba(229, 62, 62, 0.4),
        inset 0 -4px 6px rgba(229, 62, 62, 0.6);
    }
    .status-label {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #e2e8f0;
      user-select: text;
    }
    a {
      display: inline-block;
      text-decoration: none;
      font-weight: 600;
      background-color: #444444;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      transition: background-color 0.3s ease, transform 0.2s ease;
      box-shadow: 0 2px 6px rgb(4 4 4 / 0.4);
      margin-top: 2rem;
    }
    a:hover,
    a:focus {
      background-color: #444444;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgb(4 4 4 / 0.6);
      outline: none;
    }
    @media (max-width: 480px) {
      h1 {
        font-size: 2rem;
      }
      .status-box {
        font-size: 2.5rem;
        min-width: 140px;
        padding: 0rem 1.5rem;
      }
.flex-container {
        flex-direction: column;
        padding: 0.2rem 0.5rem;
}
.flex-container > div {
        min-width: 140px;
        flex-direction: column;
padding: 0.2rem 0.5rem;
        }

      a {
        padding: 0.6rem 1.2rem;
        font-size: 1rem;
      }
      main {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <header>
   <a href="https://rvscwv.com"> <img src="FieldStatusBanner.png" alt="Field Status Banner"; /> </a>
  </header>
  <main>
    
<div class="flex-container">
  <div><h2>Parkersburg Fields</h2> <p>
403 Buckeye St <br>
Parkersburg, WV 26101</p>

</div>
  <div><h2>Williamstown Fields</h2><p>
300 Morris St<br>
Williamstown, WV 26187</p>

</div>
    
</div>
    <div class="status-container">
      <div class="status-box status-<?= htmlspecialchars($status === 'open' ? 'open' : 'closed') ?>">
        <div class="status-label">Parkersburg</div>
        <?= htmlspecialchars(strtoupper($status)) ?>
      </div>
      <div class="status-box status-<?= htmlspecialchars($fields === 'open' ? 'open' : 'closed') ?>">
        <div class="status-label">Williamstown</div>
        <?= htmlspecialchars(strtoupper($fields)) ?>
      </div>
    </div>
    <a href="admin/login.php" style="background-color:#000000" aria-label="Go to Admin Login">Admin Login</a>
  </main>
</body>
</html>