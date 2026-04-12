<?php
session_start();
include '../config/db.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

$s = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM students"));
$t = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM teachers"));
$n = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM notices"));
$p = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM class_parties"));
$sl = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM slider"));
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ড্যাশবোর্ড | শিশু বিদ্যা নিকেতন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-slate-50">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white fixed h-full p-8 shadow-2xl z-50">
            <h2 class="text-xl font-black text-blue-400 mb-10 text-center uppercase tracking-widest">অ্যাডমিন প্যানেল</h2>
            <nav class="space-y-2">
                <a href="dashboard.php" class="block p-4 bg-blue-600 rounded-2xl font-bold shadow-lg shadow-blue-900/50">ড্যাশবোর্ড</a>
                <a href="manage_students.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">শিক্ষার্থী ম্যানেজ</a>
                <a href="manage_teachers.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">শিক্ষক ম্যানেজ</a>
                <a href="manage_slider.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">স্লাইডার ম্যানেজ</a>
                <a href="manage_gallery.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">গ্যালারি ম্যানেজ</a>
                <a href="manage_notices.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">নোটিশ ম্যানেজ</a>
                <a href="manage_admission.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">ভর্তি তথ্য এডিট</a>
                <a href="manage_class_party.php" class="block p-4 hover:bg-slate-800 rounded-2xl transition text-slate-400 hover:text-white">ক্লাস পার্টি ম্যানেজ</a>
                <a href="logout.php" class="block p-4 text-red-400 font-bold mt-8 hover:bg-red-500/10 rounded-2xl transition">লগআউট</a>
            </nav>
        </aside>

        <main class="flex-1 ml-64 p-8 md:p-12">
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">সিস্টেম ওভারভিউ</h1>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border font-bold text-slate-500">অ্যাডমিন প্যানেল</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
                <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-100 text-center">
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">শিক্ষার্থী</p>
                    <h2 class="text-3xl font-black text-blue-600 mt-1"><?php echo $s; ?></h2>
                </div>
                <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-100 text-center">
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">শিক্ষক</p>
                    <h2 class="text-3xl font-black text-green-600 mt-1"><?php echo $t; ?></h2>
                </div>
                <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-100 text-center">
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">নোটিশ</p>
                    <h2 class="text-3xl font-black text-red-600 mt-1"><?php echo $n; ?></h2>
                </div>
                <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-100 text-center">
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">স্লাইডার</p>
                    <h2 class="text-3xl font-black text-purple-600 mt-1"><?php echo $sl; ?></h2>
                </div>
                <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-100 text-center">
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">ক্লাস পার্টি</p>
                    <h2 class="text-3xl font-black text-orange-600 mt-1"><?php echo $p; ?></h2>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-700 to-blue-800 p-10 md:p-12 rounded-[50px] text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-6">কুইক কন্ট্রোল প্যানেল</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="manage_slider.php" class="bg-white text-indigo-700 px-8 py-4 rounded-2xl font-black shadow-xl hover:bg-indigo-50 transition">স্লাইডার পরিবর্তন</a>
                        <a href="manage_notices.php" class="bg-indigo-500 text-white px-8 py-4 rounded-2xl font-black border border-indigo-400 shadow-xl hover:bg-indigo-400 transition">নোটিশ আপডেট</a>
                        <a href="manage_admission.php" class="bg-indigo-900 text-white px-8 py-4 rounded-2xl font-black shadow-xl hover:bg-indigo-950 transition">ভর্তি তথ্য এডিট</a>
                    </div>
                </div>
                <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            </div>
        </main>
    </div>
</body>
</html>