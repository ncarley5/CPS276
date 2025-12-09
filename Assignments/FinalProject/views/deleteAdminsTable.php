<?php
require_once __DIR__ . "/../classes/Pdo_methods.php";

$pdo = new PdoMethods();
$admins = $pdo->selectNotBinded("SELECT id, name, email, status FROM admins");
?>
<?php include __DIR__ . "/../includes/navigation.php"; ?>

<div class="container mt-4">
    <h2>Delete Admins</h2>

    <?php if (!$admins): ?>
        <p>There are no records to display.</p>
    <?php else: ?>
        <form method="post" action="../index.php?page=deleteAdmins">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): 
                        $disabled = ($admin['id'] == $_SESSION['id']) ? "disabled" : "";
                        $note = ($admin['id'] == $_SESSION['id']) ? " (Cannot delete yourself)" : "";
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['name']) . $note ?></td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td><?= htmlspecialchars($admin['status']) ?></td>
                            <td>
                                <input type="checkbox" name="delete_ids[]" value="<?= $admin['id'] ?>" <?= $disabled ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </form>
    <?php endif; ?>
</div>
