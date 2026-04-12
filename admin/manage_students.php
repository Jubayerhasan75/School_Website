<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $roll = $_POST['roll'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "../assets/images/students/" . $image_name;

    if (move_uploaded_file($image_tmp, $image_folder)) {
        $sql = "INSERT INTO students (name, class, roll_no, image) VALUES ('$name', '$class', '$roll', '$image_name')";
        mysqli_query($conn, $sql);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: manage_students.php");
}

$selected_class = isset($_GET['filter_class']) ? $_GET['filter_class'] : '';

$query = "SELECT * FROM students";
if ($selected_class != '') {
    $query .= " WHERE class='$selected_class'";
}
$query .= " ORDER BY id DESC";

$result = mysqli_query($conn, $query);
$class_list = mysqli_query($conn, "SELECT DISTINCT class FROM students ORDER BY class");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>শিক্ষার্থী ম্যানেজমেন্ট</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3 text-slate-400">ড্যাশবোর্ড</a>
            <a href="manage_students.php" class="block p-3 bg-blue-600 rounded-xl font-bold">শিক্ষার্থী ম্যানেজ</a>
            <a href="manage_notices.php" class="block p-3 text-slate-400">নোটিশ ম্যানেজ</a>
            <a href="manage_messages.php" class="block p-3 text-slate-400">ইউজার মেসেজ</a>
            <a href="logout.php" class="block p-3 text-red-400 mt-8">লগআউট</a>
        </nav>
    </aside>

    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black mb-10">শিক্ষার্থী ম্যানেজমেন্ট</h1>
        
        <div class="bg-white p-8 rounded-3xl shadow-sm mb-12 border">
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="name" placeholder="শিক্ষার্থীর নাম" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="text" name="class" placeholder="শ্রেণি" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="text" name="roll" placeholder="রোল নম্বর" class="p-4 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <input type="file" name="image" class="p-3 bg-gray-50 rounded-xl outline-none ring-1 ring-gray-200" required>
                <button type="submit" name="add_student" class="md:col-span-2 bg-blue-600 text-white font-bold py-4 rounded-xl">নতুন শিক্ষার্থী যোগ করুন</button>
            </form>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">বর্তমান শিক্ষার্থী তালিকা</h2>
            <form method="GET" class="flex gap-4">
                <select name="filter_class" class="p-3 bg-white rounded-xl ring-1 ring-gray-200 outline-none font-bold text-slate-600">
                    <option value="">সকল শ্রেণি</option>
                    <?php while($c = mysqli_fetch_assoc($class_list)): ?>
                        <option value="<?php echo $c['class']; ?>" <?php if($selected_class == $c['class']) echo 'selected'; ?>><?php echo $c['class']; ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold">ফিল্টার</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden border">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="p-6">ছবি</th>
                        <th class="p-6">নাম</th>
                        <th class="p-6">শ্রেণি</th>
                        <th class="p-6">রোল</th>
                        <th class="p-6 text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="p-6"><img src="../assets/images/students/<?php echo $row['image']; ?>" class="h-12 w-12 rounded-xl object-cover"></td>
                        <td class="p-6 font-bold"><?php echo $row['name']; ?></td>
                        <td class="p-6"><?php echo $row['class']; ?></td>
                        <td class="p-6"><?php echo $row['roll_no']; ?></td>
                        <td class="p-6 text-center space-x-4">
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="text-blue-600 font-bold">এডিট</a>
                            <a href="manage_students.php?delete=<?php echo $row['id']; ?>" class="text-red-500 font-bold">ডিলিট</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>