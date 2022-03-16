<?php $page = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo-trudas.png" alt="Logo TRUDAS" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?= $page == "index" ? 'active' : ''; ?>" aria-current="page" href="index.php">Data Acquisition System</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == "configuration" ? 'active' : ''; ?>" href="configuration.php">Configurations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == "sensors" ? 'active' : ''; ?>" href="sensors.php">Sensors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == "logs" ? 'active' : ''; ?>" href="logs.php">Logs</a>
            </li>
        </ul>
        </div>
    </div>
</nav>