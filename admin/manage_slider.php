<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_slide'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image']['name'];
    $target = "../assets/images/slider/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        mysqli_query($conn, "INSERT INTO slider (title, image) VALUES ('$title', '$image')");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $res = mysqli_query($conn, "SELECT image FROM slider WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    unlink("../assets/images/slider/" . $row['image']);
    mysqli_query($conn, "DELETE FROM slider WHERE id=$id");
    header("Location: manage_slider.php");
}

$slides = mysqli_query($conn, "SELECT * FROM slider ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Slider Manage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3 text-slate-400">Dashboard</a>
            <a href="manage_slider.php" class="block p-3 bg-blue-600 rounded-xl font-bold">Slider Manage</a>
            <a href="logout.php" class="block p-3 text-red-400">Logout</a>
        </nav>
    </aside>

    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black mb-10">Slider Image Add Korun</h1>
        <div class="bg-white p-10 rounded-[40px] shadow-sm mb-12 border">
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="text" name="title" placeholder="Slider Title (Optional)" class="w-full p-4 bg-gray-50 rounded-2xl outline-none border">
                <input type="file" name="image" class="w-full p-4 bg-gray-50 rounded-2xl border" required>
                <button type="submit" name="add_slide" class="bg-blue-600 text-white font-bold px-10 py-4 rounded-2xl">Upload Slide</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php while($row = mysqli_fetch_assoc($slides)): ?>
            <div class="bg-white rounded-[30px] overflow-hidden shadow-sm border">
                <img src="../assets/images/slider/<?php echo $row['image']; ?>" class="h-48 w-full object-cover">
                <div class="p-6 flex justify-between items-center">
                    <span class="font-bold"><?php echo $row['title']; ?></span>
                    <a href="manage_slider.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold">Delete</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>