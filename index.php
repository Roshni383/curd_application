<?php include('../constant.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>CRUD Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            margin: 5px 0;
            width: 200px;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Add New Book</h2>
    <form method="post" action="add_book.php">
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Published Year: <input type="number" name="published_year" required><br>
        <input type="submit" name="submit" value="Add Book">
    </form>

    <h2>List of Books</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Published Year</th>
            <th>Actions</th>
        </tr>
        <?php include 'read_books.php'; ?>
    </table>

    <h2>Update Book</h2>
    <form method="post" action="update_book.php">
        Book ID: <input type="number" name="id" required><br>
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Published Year: <input type="number" name="published_year" required><br>
        <input type="submit" name="update" value="Update Book">
    </form>

    <h2>Delete Book</h2>
    <form method="post" action="delete_book.php">
        Book ID: <input type="number" name="id" required><br>
        <input type="submit" value="Delete Book">
    </form>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD Application</title>
</head>

<body>
    <h2>Add New Book</h2>
    <form method="post" action="">
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Published Year: <input type="number" name="published_year" required><br>
        <input type="submit" name="submit" value="Add Book">
    </form>

    <h2>List of Books</h2>
    <?php include 'read_books.php'; ?>

    <h2>Update Book</h2>
    <form method="post" action="">
        Book ID: <input type="number" name="id" required><br>
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Published Year: <input type="number" name="published_year" required><br>
        <input type="submit" name="update" value="Update Book">
    </form>

    <h2>Delete Book</h2>
    <form method="get" action="">
        Book ID: <input type="number" name="delete" required><br>
        <input type="submit" value="Delete Book">
    </form>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $sql = "INSERT INTO books (title, author, published_year) VALUES ('$title', '$author', '$published_year')";

    if (mysqli_query($conn, $sql)) {
        echo "New book added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<?php
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Title: " . $row['title'] . "<br>";
        echo "Author: " . $row['author'] . "<br>";
        echo "Published Year: " . $row['published_year'] . "<br><br>";
    }
} else {
    echo "No books found.";
}
?>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $sql = "UPDATE books SET title='$title', author='$author', published_year='$published_year' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Book updated successfully!";
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
}
?>
<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM books WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Book deleted successfully!";
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
}
?>

