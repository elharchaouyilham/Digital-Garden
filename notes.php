<?php
$conn = new mysqli("localhost", "root", "", "notes_app");
if ($conn->connect_error) die("Erreur: " . $conn->connect_error);

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $theme_id = $_POST['theme_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $importance = $_POST['importance'];

    if ($_POST['action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO notes (theme_id, title, content, importance) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $theme_id, $title, $content, $importance);
        $stmt->execute();
    } elseif ($_POST['action'] === 'edit') {
        $note_id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE notes SET theme_id=?, title=?, content=?, importance=? WHERE id=?");
        $stmt->bind_param("issii", $theme_id, $title, $content, $importance, $note_id);
        $stmt->execute();
    }
    header("Location: notes.php");
    exit;
}

if ($action === 'delete' && $id) {
    $stmt = $conn->prepare("DELETE FROM notes WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: notes.php");
    exit;
}

$notes = $conn->query("SELECT n.id, n.title, n.content, n.importance, n.created_at, t.name as theme_name FROM notes n JOIN themes t ON n.theme_id=t.id ORDER BY n.created_at DESC");
$themes = $conn->query("SELECT * FROM themes");
?>


<main class="main">
    <div class="notes-page">
        <div class="notes-header">
            <h1>📝 Gestion des Notes</h1>
            <a href="?action=add" class="notes-btn">+ Ajouter une note</a>
        </div>

<?php if ($action === 'add' || ($action === 'edit' && $id)): 
    $note = ['id'=> '', 'theme_id'=>'', 'title'=>'', 'content'=>'', 'importance'=>''];
    if ($action === 'edit') {
        $stmt = $conn->prepare("SELECT * FROM notes WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $note = $stmt->get_result()->fetch_assoc();
    }
?>
    <form method="POST" class="note-form">
        <h2><?= $action === 'add' ? "Ajouter une note" : "Modifier la note" ?></h2>
        <label>Thème</label>
        <select name="theme_id" required>
            <option value="">Sélectionner</option>
            <?php while($t = $themes->fetch_assoc()): ?>
                <option value="<?= $t['id'] ?>" <?= $t['id']==$note['theme_id']?'selected':'' ?>><?= $t['name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label>Titre</label>
        <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>

        <label>Importance (1-5)</label>
        <input type="number" name="importance" min="1" max="5" value="<?= $note['importance'] ?>" required>

        <label>Contenu</label>
        <textarea name="content" required><?= htmlspecialchars($note['content']) ?></textarea>

        <input type="hidden" name="action" value="<?= $action ?>">
        <?php if($action==='edit'): ?>
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
        <?php endif; ?>
        <button type="submit"><?= $action==='add' ? "Ajouter" : "Mettre à jour" ?></button>
    </form>
<?php else: ?>
    <?php if($notes->num_rows>0): ?>
        <?php while($n = $notes->fetch_assoc()): ?>
            <div class="note-card">
                <div class="note-left">
                    <div class="note-title"><?= htmlspecialchars($n['title']) ?></div>
                    <div class="note-meta">
                        <span class="importance"><?= $n['importance'] ?> ⭐</span>
                        <span>Thème: <?= htmlspecialchars($n['theme_name']) ?></span> |
                        <span>Créé: <?= date("d/m/Y", strtotime($n['created_at'])) ?></span>
                    </div>
                    <div class="note-content"><?= htmlspecialchars(substr($n['content'],0,100)) ?>...</div>
                </div>
                <div class="note-actions">
                    <a href="?action=edit&id=<?= $n['id'] ?>" class="note-edit">Modifier</a>
                    <a href="?action=delete&id=<?= $n['id'] ?>" class="note-delete" onclick="return confirm('Supprimer cette note ?')">Supprimer</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="themes-empty">Aucune note n’a encore été créée.</div>
    <?php endif; ?>
<?php endif; ?>

    </div>
</main>

