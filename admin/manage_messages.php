<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM messages WHERE id=$id");
    header("Location: manage_messages.php");
}
$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>ইউজার মেসেজ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3">ড্যাশবোর্ড</a>
            <a href="manage_notices.php" class="block p-3 text-slate-400">নোটিশ ম্যানেজ</a>
            <a href="manage_messages.php" class="block p-3 bg-blue-600 rounded-xl font-bold">ইউজার মেসেজ</a>
            <a href="logout.php" class="block p-3 text-red-400 mt-8">লগআউট</a>
        </nav>
    </aside>
    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black mb-10">মেসেজসমূহ</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white p-8 rounded-3xl shadow-sm border relative">
                <h3 class="text-xl font-bold text-slate-800"><?php echo $row['name']; ?></h3>
                <p class="text-blue-600 font-bold mb-4"><?php echo $row['contact']; ?></p>
                <p class="text-slate-600 bg-slate-50 p-4 rounded-xl mb-6"><?php echo $row['message']; ?></p>
                <a href="manage_messages.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold">ডিলিট করুন</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>