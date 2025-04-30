<?php
require 'session.php';
require 'db_connect.php';
require 'css/header.php';

 
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'css/header.php';  
?>

<h2>Book Catalog</h2>

<a href="add_item.php"> Add New Book</a> |
<a href="logout.php"> Logout</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Cover</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= htmlspecialchars($book['genre']) ?></td>
        <td>
            <?php if (!empty($book['cover'])): ?>
                <img src="uploads/<?= htmlspecialchars($book['cover']) ?>" alt="Cover" width="60">
            <?php else: ?>
                No cover
            <?php endif; ?>
        </td>
        <td>
            <a href="add_item.php?id=<?= $book['id'] ?>"> Edit</a> |
            <a href="delete_item.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure you to want to delete this book?')"> Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require 'css/footer.php'; ?>
