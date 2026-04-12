<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

$msg = "";
if (isset($_POST['add_notice'])) {
    $t = mysqli_real_escape_string($conn, $_POST['title']);
    $d = mysqli_real_escape_string($conn, $_POST['description']);
    mysqli_query($conn, "INSERT INTO notices (title, description) VALUES ('$t', '$d')");
    $msg = "সফলভাবে নোটিশ যোগ হয়েছে!";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM notices WHERE id=$id");
    header("Location: manage_notices.php");
}
$result = mysqli_query($conn, "SELECT * FROM notices ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>নোটিশ ম্যানেজমেন্ট</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3">ড্যাশবোর্ড</a>
            <a href="manage_notices.php" class="block p-3 bg-blue-600 rounded-xl font-bold">নোটিশ ম্যানেজ</a>
            <a href="manage_messages.php" class="block p-3 text-slate-400">ইউজার মেসেজ</a>
            <a href="logout.php" class="block p-3 text-red-400 mt-8">লগআউট</a>
        </nav>
    </aside>
    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black mb-10">নোটিশ ম্যানেজমেন্ট</h1>
        <?php if($msg != ""): ?>
        <div class="bg-green-100 text-green-800 p-5 rounded-2xl mb-8 font-bold"><?php echo $msg; ?></div>
        <?php endif; ?>
        <div class="bg-white p-10 rounded-[30px] shadow-sm mb-12 border">
            <form action="" method="POST" class="space-y-6">
                <input type="text" name="title" placeholder="শিরোনাম" class="w-full p-4 bg-gray-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
                <textarea name="description" placeholder="বিস্তারিত" class="w-full p-4 bg-gray-50 rounded-2xl outline-none ring-1 ring-slate-200" rows="4" required></textarea>
                <button type="submit" name="add_notice" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold">পাবলিশ করুন</button>
            </form>
        </div>
        <div class="bg-white rounded-[30px] shadow-sm overflow-hidden border">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr><th class="p-6">শিরোনাম</th><th class="p-6 text-center">অ্যাকশন</th></tr>
                </thead>
                <tbody class="divide-y">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="p-6 font-bold"><?php echo $row['title']; ?></td>
                        <td class="p-6 text-center space-x-4">
                            <a href="edit_notice.php?id=<?php echo $row['id']; ?>" class="text-blue-600 font-bold">এডিট</a>
                            <a href="manage_notices.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold">ডিলিট</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>