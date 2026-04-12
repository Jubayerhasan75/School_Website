<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM notices WHERE id=$id"));

if (isset($_POST['update_notice'])) {
    $t = mysqli_real_escape_string($conn, $_POST['title']);
    $d = mysqli_real_escape_string($conn, $_POST['description']);
    mysqli_query($conn, "UPDATE notices SET title='$t', description='$d' WHERE id=$id");
    header("Location: manage_notices.php");
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>নোটিশ এডিট</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-12 rounded-[40px] shadow-2xl max-w-2xl w-full border">
        <h2 class="text-3xl font-black mb-8">নোটিশ সংশোধন</h2>
        <form method="POST" class="space-y-6">
            <input type="text" name="title" value="<?php echo $data['title']; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
            <textarea name="description" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" rows="6" required><?php echo $data['description']; ?></textarea>
            <div class="flex gap-4">
                <button type="submit" name="update_notice" class="flex-1 bg-blue-600 text-white font-black py-4 rounded-2xl">আপডেট</button>
                <a href="manage_notices.php" class="flex-1 bg-slate-100 text-slate-600 text-center font-black py-4 rounded-2xl">বাতিল</a>
            </div>
        </form>
    </div>
</body>
</html>