<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

if (isset($_POST['update_admission'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    mysqli_query($conn, "UPDATE admission_info SET content='$content' WHERE id=1");
    $msg = "ভর্তি তথ্য সফলভাবে আপডেট হয়েছে!";
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT content FROM admission_info WHERE id=1"));
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>ভর্তি তথ্য এডিট</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 h-screen bg-slate-900 text-white p-8 fixed">
        <nav class="space-y-4">
            <a href="dashboard.php" class="block p-3 text-slate-400">ড্যাশবোর্ড</a>
            <a href="manage_admission.php" class="block p-3 bg-indigo-600 rounded-xl font-bold underline">ভর্তি তথ্য এডিট</a>
            <a href="logout.php" class="block p-3 text-red-400">লগআউট</a>
        </nav>
    </aside>
    <div class="flex-1 ml-64 p-12">
        <h1 class="text-3xl font-black text-slate-800 mb-10 tracking-tight">ভর্তি তথ্য পরিবর্তন করুন</h1>
        <?php if(isset($msg)) echo "<p class='bg-green-100 text-green-700 p-5 rounded-2xl mb-8 font-bold'>$msg</p>"; ?>
        <div class="bg-white p-12 rounded-[50px] shadow-sm border border-slate-100">
            <form method="POST" class="space-y-8">
                <div>
                    <label class="block text-slate-400 font-bold uppercase text-xs mb-3 ml-2">হোম পেজের টেক্সট</label>
                    <textarea name="content" class="w-full p-8 bg-slate-50 rounded-[30px] outline-none ring-1 ring-slate-100 focus:ring-4 focus:ring-indigo-100 transition text-lg leading-relaxed" rows="8" required><?php echo $data['content']; ?></textarea>
                </div>
                <button type="submit" name="update_admission" class="bg-indigo-600 text-white font-black px-16 py-5 rounded-2xl shadow-xl shadow-indigo-100 active:scale-95 transition">আপডেট করুন</button>
            </form>
        </div>
    </div>
</body>
</html>