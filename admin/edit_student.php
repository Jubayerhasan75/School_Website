<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id=$id"));

if (isset($_POST['update_student'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $roll = $_POST['roll'];
    
    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/students/" . $image);
        $sql = "UPDATE students SET name='$name', class='$class', roll_no='$roll', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE students SET name='$name', class='$class', roll_no='$roll' WHERE id=$id";
    }
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_students.php");
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>শিক্ষার্থী তথ্য সংশোধন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-12 rounded-[40px] shadow-2xl max-w-2xl w-full border border-slate-100">
        <h2 class="text-3xl font-black mb-8 text-slate-800">শিক্ষার্থী তথ্য সংশোধন</h2>
        
        <form method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label class="block text-xs font-bold text-slate-400 mb-2 uppercase">নাম</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600" required>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2 uppercase">শ্রেণি</label>
                    <input type="text" name="class" value="<?php echo $data['class']; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2 uppercase">রোল</label>
                    <input type="text" name="roll" value="<?php echo $data['roll_no']; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 mb-2 uppercase">নতুন ছবি (পরিবর্তন না করতে চাইলে খালি রাখুন)</label>
                <input type="file" name="image" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200">
            </div>
            <div class="flex gap-4 pt-6">
                <button type="submit" name="update_student" class="flex-1 bg-blue-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-100">আপডেট করুন</button>
                <a href="manage_students.php" class="flex-1 bg-slate-100 text-slate-600 text-center font-black py-4 rounded-2xl">বাতিল</a>
            </div>
        </form>
    </div>
</body>
</html>