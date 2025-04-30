<?php
require 'session.php';
require 'db_connect.php';
require 'css/header.php';

$title = $author = $genre = $cover = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $newCover = null;

    if (!empty($_FILES['cover']['name'])) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['cover']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
            $newCover = $fileName;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO books (title, author, genre, cover) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $author, $genre, $newCover]);

    header("Location: dashboard.php");
    exit;
}
?>

<main>
    <form method="POST" enctype="multipart/form-data">
        <h2>Add Book</h2>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" placeholder="Title" required>
        <input type="text" name="author" value="<?= htmlspecialchars($author) ?>" placeholder="Author" required>
        <input type="text" name="genre" value="<?= htmlspecialchars($genre) ?>" placeholder="Genre" required>
        <input type="file" name="cover">
        <button type="submit">Save Book</button>
        <a href="dashboard.php" class="button cancel-button">Cancel</a>
    </form>
</main>

<?php require 'css/footer.php'; ?>
