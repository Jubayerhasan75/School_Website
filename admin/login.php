<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "ভুল ইউজারনেম বা পাসওয়ার্ড!";
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অ্যাডমিন লগইন | শিশু বিদ্যা নিকেতন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Hind Siliguri', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-[40px] p-10 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-blue-600"></div>
            <div class="text-center mb-10">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">অ্যাডমিন প্যানেল</h2>
                <p class="text-slate-500 mt-2 font-medium">শিশু বিদ্যা নিকেতন</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-6 text-sm font-bold text-center border border-red-100">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">ইউজারনেম</label>
                    <input type="text" name="username" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600 outline-none transition duration-200" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">পাসওয়ার্ড</label>
                    <input type="password" name="password" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600 outline-none transition duration-200" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-5 rounded-2xl shadow-xl shadow-blue-100 hover:bg-blue-700 active:scale-[0.98] transition duration-200">লগইন করুন</button>
            </form>
        </div>
        <p class="text-center text-slate-500 mt-8 text-sm">© ২০২৬ শিশু বিদ্যা নিকেতন</p>
    </div>
</body>
</html>