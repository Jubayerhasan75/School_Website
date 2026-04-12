<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

if (isset($_POST['add_party'])) {
    $cn = mysqli_real_escape_string($conn, $_POST['class_name']);
    $ds = mysqli_real_escape_string($conn, $_POST['description']);
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../assets/images/gallery/".$img);
    mysqli_query($conn, "INSERT INTO class_parties (class_name, description, image) VALUES ('$cn', '$ds', '$img')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM class_parties WHERE id=$id");
    header("Location: manage_class_party.php");
}
$list = mysqli_query($conn, "SELECT * FROM class_parties ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>ক্লাস পার্টি ম্যানেজ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed shadow-xl">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3 text-slate-400">ড্যাশবোর্ড</a>
            <a href="manage_class_party.php" class="block p-3 bg-orange-600 rounded-xl font-bold underline">ক্লাস পার্টি ম্যানেজ</a>
            <a href="logout.php" class="block p-3 text-red-400">লগআউট</a>
        </nav>
    </aside>
    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black text-slate-800 mb-10 uppercase tracking-tighter">নতুন ক্লাস পার্টি যোগ করুন</h1>
        <div class="bg-white p-10 rounded-[40px] shadow-sm mb-12 border border-slate-100">
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <input type="text" name="class_name" placeholder="ক্লাসের নাম (যেমন: পঞ্চম শ্রেণি)" class="p-5 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-100" required>
                <input type="file" name="image" class="p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-100" required>
                <textarea name="description" placeholder="পার্টি সম্পর্কে বিস্তারিত বর্ণনা" class="md:col-span-2 p-5 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-100" rows="3" required></textarea>
                <button type="submit" name="add_party" class="md:col-span-2 bg-orange-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-orange-100 transition active:scale-95">সেভ করুন</button>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while($row = mysqli_fetch_assoc($list)): ?>
            <div class="bg-white rounded-[35px] border border-slate-100 overflow-hidden shadow-sm flex flex-col">
                <img src="../assets/images/gallery/<?php echo $row['image']; ?>" class="h-40 w-full object-cover">
                <div class="p-6 flex-1">
                    <h4 class="font-bold text-slate-800 mb-2"><?php echo $row['class_name']; ?></h4>
                    <p class="text-slate-500 text-xs mb-6"><?php echo $row['description']; ?></p>
                    <a href="manage_class_party.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold hover:underline">ডিলিট করুন</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>