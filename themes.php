<?php include __DIR__ . '/includes/header.php'; ?>

<?php
$conn = new mysqli("localhost", "root", "", "garden");
if ($conn->connect_error) die("Erreur connexion");

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$error = "";


switch ($action) {

    case 'add':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST['name']);
            $color = $_POST['color'];
            $tags = trim($_POST['tags']);

            if (strlen($name) < 3) {
                $error = "Nom minimum 3 caractères";
            } else {
                $stmt = $conn->prepare(
                    "INSERT INTO themes (name, color, tags) VALUES (?, ?, ?)"
                );
                $stmt->bind_param("sss", $name, $color, $tags);
                $stmt->execute();
                header("Location: themes.php");
                exit;
            }
        }
        break;

    case 'edit':
        $stmt = $conn->prepare("SELECT * FROM themes WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $theme = $stmt->get_result()->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST['name']);
            $color = $_POST['color'];
            $tags = trim($_POST['tags']);

            $stmt = $conn->prepare(
                "UPDATE themes SET name=?, color=?, tags=? WHERE id=?"
            );
            $stmt->bind_param("sssi", $name, $color, $tags, $id);
            $stmt->execute();
            header("Location: themes.php");
            exit;
        }
        break;

    case 'delete':
        $stmt = $conn->prepare("DELETE FROM themes WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: themes.php");
        exit;

    default:
        $themes = $conn->query("
            SELECT t.*,
            (SELECT COUNT(*) FROM notes n WHERE n.theme_id = t.id) AS notes_count
            FROM themes t
        ");
}
?>



<main class="main">
    <div class="themes-page">

        <div class="themes-header">
            <h1>🌱 Gestion des Thèmes</h1>
            <a href="themes.php?action=add" class="themes-btn">+ Ajouter un thème</a>
        </div>

        <?php if ($action === 'add' || $action === 'edit'): ?>

            <div class="form-container">
                <h2><?= $action === 'add' ? 'Ajouter' : 'Modifier' ?> un thème</h2>

                <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>

                <form method="POST">
                    <input class="input-field" type="text" name="name"
                           value="<?= $theme['name'] ?? '' ?>" required>

                    <input class="input-field" type="color" name="color"
                           value="<?= $theme['color'] ?? '#22c55e' ?>" required>

                    <input class="input-field" type="text" name="tags"
                           value="<?= $theme['tags'] ?? '' ?>">

                    <button class="btn">Enregistrer</button>
                </form>
            </div>

        <?php else: ?>

            <?php if ($themes->num_rows === 0): ?>
                <div class="themes-empty">Aucun thème n’a encore été créé.</div>
            <?php endif; ?>

            <?php while ($row = $themes->fetch_assoc()): ?>
                <div class="theme-card">
                    <div class="theme-left">
                        <div class="theme-name"><?= htmlspecialchars($row['name']) ?></div>
                        <span class="badge-color" style="background:<?= $row['color'] ?>">
                            <?= $row['color'] ?>
                        </span>

                        <div class="tags">
                            <?php if ($row['tags']): ?>
                                <?php foreach (explode(',', $row['tags']) as $tag): ?>
                                    <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="notes-count"><?= $row['notes_count'] ?> notes</div>
                    </div>

                    <div class="theme-actions">
                        <a href="themes.php?action=edit&id=<?= $row['id'] ?>" class="theme-edit">Modifier</a>
                        <a href="themes.php?action=delete&id=<?= $row['id'] ?>"
                           class="theme-delete"
                           onclick="return confirm('Supprimer ce thème ?')">Supprimer</a>
                    </div>
                </div>
            <?php endwhile; ?>

        <?php endif; ?>

    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>