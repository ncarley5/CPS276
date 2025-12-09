<?php
require_once __DIR__ . "/security.php";

if (!isLoggedIn()) {
    return;
}

$status = $_SESSION['status'];
$name   = $_SESSION['name'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php?page=welcome">
            Welcome, <?= htmlspecialchars($name) ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

                <!-- Staff & Admin links -->
                <li class="nav-item">
                    <a href="index.php?page=addContact" class="btn btn-primary">Add Contact</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=deleteContacts">Delete Contacts</a>
                </li>

                <!-- Admin only -->
                <?php if ($status === 'admin'): ?>
                    <li class="nav-item">
                        <a href="index.php?page=addAdmin">Add Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=deleteAdmins">Delete Admin(s)</a>
                    </li>
                <?php endif; ?>

                <!-- Logout -->
                <li class="nav-item">
                    <a class="nav-link text-warning" href="../logout.php">Logout</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
