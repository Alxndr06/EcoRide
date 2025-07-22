<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main class="dashboard">
    <div class="header-spacer"></div>
    <h2>Liste des employés</h2>

    <?php if (!empty($employees)): ?>
        <div class="employee-table-container">
            <table class="employee-table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th class="desktop-only">Adresse</th>
                    <th class="desktop-only">Date de naissance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= htmlspecialchars($employee['prenom']) ?> <?= htmlspecialchars($employee['nom']) ?></td>
                        <td><?= htmlspecialchars($employee['email']) ?></td>
                        <td class="desktop-only"><?= htmlspecialchars($employee['adresse']) ?></td>
                        <td class="desktop-only"><?= htmlspecialchars($employee['date_naissance']) ?></td>
                        <td>
                            <a class="btn-small" href="index.php?controller=admin&action=editEmployeeRole">✏️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>Aucun employé trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
