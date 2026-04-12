<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_POST['teacher_id']) ? intval($_POST['teacher_id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);

if ($id == 0) {
    header("Location: manage_teachers.php");
    exit();
}

$msg = "";

if (isset($_POST['update_teacher'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $joggota = mysqli_real_escape_string($conn, $_POST['joggota']);

    $img_query = "";
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../assets/images/teachers/";
        
        if(!is_dir($target)) {
            mkdir($target, 0777, true);
        }
        
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target . $image)){
            $img_query = ", image='$image'";
        } else {
            $msg = "<div class='bg-red-100 text-red-800 p-4 rounded-xl mb-6 font-bold border border-red-200'>নতুন ছবি আপলোডে সমস্যা হয়েছে!</div>";
        }
    }

    if($msg == "") {
        $sql = "UPDATE teachers SET name='$name', designation='$designation', phone='$phone', email='$email', joggota='$joggota' $img_query WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_teachers.php");
            exit();
        } else {
            $msg = "<div class='bg-red-100 text-red-800 p-4 rounded-xl mb-6 font-bold border border-red-200'>ডাটাবেস এরর: " . mysqli_error($conn) . "</div>";
        }
    }
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE id=$id"));
if(!$data) {
    header("Location: manage_teachers.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>শিক্ষক তথ্য সংশোধন</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-12 rounded-[40px] shadow-2xl max-w-3xl w-full border">
        <h2 class="text-3xl font-black mb-8">শিক্ষক তথ্য সংশোধন</h2>
        
        <?php echo $msg; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" name="teacher_id" value="<?php echo $id; ?>">
            
            <input type="text" name="name" placeholder="শিক্ষকের নাম" value="<?php echo $data['name'] ?? ''; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
            <input type="text" name="designation" placeholder="পদবি" value="<?php echo $data['designation'] ?? ''; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
            <input type="text" name="phone" placeholder="ফোন নম্বর" value="<?php echo $data['phone'] ?? ''; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
            <input type="email" name="email" placeholder="ইমেইল অ্যাড্রেস" value="<?php echo $data['email'] ?? ''; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200" required>
            <input type="text" name="joggota" placeholder="শিক্ষাগত যোগ্যতা" value="<?php echo $data['joggota'] ?? ''; ?>" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200 md:col-span-2" required>
            <input type="file" name="image" class="w-full p-4 bg-slate-50 rounded-2xl outline-none ring-1 ring-slate-200 md:col-span-2">
            
            <div class="flex gap-4 md:col-span-2 mt-4">
                <button type="submit" name="update_teacher" class="flex-1 bg-blue-600 text-white font-black py-4 rounded-2xl">আপডেট করুন</button>
                <a href="manage_teachers.php" class="flex-1 bg-slate-100 text-slate-600 text-center font-black py-4 rounded-2xl leading-loose">বাতিল</a>
            </div>
        </form>
    </div>
</body>
</html>