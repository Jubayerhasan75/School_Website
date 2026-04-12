<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if (isset($_POST['add_teacher'])) {
    $n = mysqli_real_escape_string($conn, $_POST['name']);
    $d = mysqli_real_escape_string($conn, $_POST['designation']);
    $p = mysqli_real_escape_string($conn, $_POST['phone']);
    $e = mysqli_real_escape_string($conn, $_POST['email']);
    $j = mysqli_real_escape_string($conn, $_POST['joggota']);
    
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $target = "../assets/images/teachers/";
    
    if(!is_dir($target)) {
        mkdir($target, 0777, true);
    }

    if (move_uploaded_file($tmp, $target . $img)) {
        $sql = "INSERT INTO teachers (name, designation, phone, email, joggota, image) VALUES ('$n', '$d', '$p', '$e', '$j', '$img')";
        if(mysqli_query($conn, $sql)){
            header("Location: manage_teachers.php");
            exit();
        } else {
            $msg = "<div class='bg-red-100 text-red-800 p-4 rounded-xl mb-6 font-bold border border-red-200'>ডাটাবেস এরর: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $msg = "<div class='bg-red-100 text-red-800 p-4 rounded-xl mb-6 font-bold border border-red-200'>ছবি আপলোড করতে সমস্যা হয়েছে!</div>";
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM teachers WHERE id=$id");
    header("Location: manage_teachers.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM teachers ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>শিক্ষক ম্যানেজমেন্ট</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3 text-slate-400">ড্যাশবোর্ড</a>
            <a href="manage_students.php" class="block p-3 text-slate-400">শিক্ষার্থী ম্যানেজ</a>
            <a href="manage_teachers.php" class="block p-3 bg-blue-600 rounded-xl font-bold">শিক্ষক ম্যানেজ</a>
            <a href="manage_notices.php" class="block p-3 text-slate-400">নোটিশ ম্যানেজ</a>
            <a href="logout.php" class="block p-3 text-red-400 mt-8">লগআউট</a>
        </nav>
    </aside>

    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black mb-10">শিক্ষক ম্যানেজমেন্ট</h1>

        <?php echo $msg; ?>

        <div class="bg-white p-8 rounded-3xl shadow-sm mb-12 border">
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="name" placeholder="শিক্ষকের নাম" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="text" name="designation" placeholder="পদবি" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="text" name="phone" placeholder="ফোন নম্বর" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="email" name="email" placeholder="ইমেইল অ্যাড্রেস" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="text" name="joggota" placeholder="শিক্ষাগত যোগ্যতা" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="file" name="image" class="p-3 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <button type="submit" name="add_teacher" class="md:col-span-2 bg-blue-600 text-white font-bold py-4 rounded-xl">নতুন শিক্ষক যোগ করুন</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden border">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="p-6">ছবি</th>
                        <th class="p-6">নাম ও পদবি</th>
                        <th class="p-6">যোগ্যতা</th>
                        <th class="p-6">যোগাযোগ</th>
                        <th class="p-6 text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="p-6"><img src="../assets/images/teachers/<?php echo $row['image'] ?? ''; ?>" class="h-12 w-12 rounded-xl object-cover"></td>
                        <td class="p-6">
                            <span class="font-bold block"><?php echo $row['name'] ?? ''; ?></span>
                            <span class="text-sm text-slate-500"><?php echo $row['designation'] ?? ''; ?></span>
                        </td>
                        <td class="p-6 font-medium text-slate-700"><?php echo $row['joggota'] ?? ''; ?></td>
                        <td class="p-6">
                            <span class="block text-sm text-blue-600 font-bold"><?php echo $row['phone'] ?? ''; ?></span>
                            <span class="block text-sm text-slate-500"><?php echo $row['email'] ?? ''; ?></span>
                        </td>
                        <td class="p-6 text-center space-x-4">
                            <a href="edit_teacher.php?id=<?php echo $row['id']; ?>" class="text-blue-600 font-bold">এডিট</a>
                            <a href="manage_teachers.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold">ডিলিট</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>