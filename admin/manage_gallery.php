<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_gallery'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "../assets/images/gallery/" . $image_name;

    if (move_uploaded_file($image_tmp, $image_folder)) {
        $sql = "INSERT INTO gallery (title, image, category) VALUES ('$title', '$image_name', '$category')";
        mysqli_query($conn, $sql);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
    header("Location: manage_gallery.php");
}

$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>গ্যালারি ম্যানেজমেন্ট</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <div class="w-64 h-screen bg-slate-900 text-white p-8 sticky top-0">
            <h2 class="text-xl font-bold mb-10 text-blue-400">অ্যাডমিন প্যানেল</h2>
            <nav class="space-y-4">
                <a href="dashboard.php" class="block py-2 text-slate-400 hover:text-white">ড্যাশবোর্ড</a>
                <a href="manage_students.php" class="block py-2 text-slate-400 hover:text-white">শিক্ষার্থী ম্যানেজ</a>
                <a href="manage_teachers.php" class="block py-2 text-slate-400 hover:text-white">শিক্ষক ম্যানেজ</a>
                <a href="manage_gallery.php" class="block py-2 text-white font-bold underline">গ্যালারি ম্যানেজ</a>
                <a href="logout.php" class="block py-2 text-red-400 pt-10">লগআউট</a>
            </nav>
        </div>

        <div class="flex-1 p-10">
            <h1 class="text-3xl font-black mb-10 text-slate-800">গ্যালারিতে নতুন ছবি যোগ করুন</h1>
            
            <div class="bg-white p-8 rounded-3xl shadow-sm mb-12 border border-slate-200">
                <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="title" placeholder="ছবির শিরোনাম (যেমন: বার্ষিক ক্লাস পার্টি ২০২৬)" class="p-4 bg-gray-50 rounded-xl border-none ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <select name="category" class="p-4 bg-gray-50 rounded-xl border-none ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-600 outline-none" required>
                        <option value="General">সাধারণ</option>
                        <option value="Class Party">ক্লাস পার্টি</option>
                        <option value="Achievement">অর্জন</option>
                    </select>
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 mb-2 ml-1 uppercase">ছবি সিলেক্ট করুন</label>
                        <input type="file" name="image" class="w-full p-3 bg-gray-50 rounded-xl border-none ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-600 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    </div>
                    <button type="submit" name="add_gallery" class="md:col-span-2 bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition shadow-lg">ছবি আপলোড করুন</button>
                </form>
            </div>

            <h2 class="text-2xl font-bold mb-6 text-slate-800">গ্যালারির ছবিসমূহ</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="../assets/images/gallery/<?php echo $row['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-5">
                        <p class="text-xs font-bold text-blue-600 uppercase mb-1"><?php echo $row['category']; ?></p>
                        <h3 class="text-lg font-bold text-slate-800 mb-4"><?php echo $row['title']; ?></h3>
                        <a href="manage_gallery.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold hover:underline">ডিলিট করুন</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>