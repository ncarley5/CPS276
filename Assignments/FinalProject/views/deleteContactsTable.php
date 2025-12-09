<?php
require_once __DIR__ . "/../classes/Pdo_methods.php";
require_once __DIR__ . "/../includes/security.php";

$pdo = new PdoMethods();
$contacts = $pdo->selectNotBinded("SELECT * FROM contacts");
?>
<?php include __DIR__ . "/../includes/navigation.php"; ?>

<div class="container mt-4">
    <h2>Delete Contacts</h2>

    <?php if (!$contacts): ?>
        <p>There are no records to display.</p>
    <?php else: ?>

        <form method="post" action="index.php?page=deleteContacts">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['fname']) ?></td>
                            <td><?= htmlspecialchars($contact['lname']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td><?= htmlspecialchars($contact['phone']) ?></td>
                            <td>
                                <input type="checkbox" name="delete_ids[]" value="<?= $contact['id'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </form>

    <?php endif; ?>
</div>
