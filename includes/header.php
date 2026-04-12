<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শিশু বিদ্যা নিকেতন | আদর্শ প্রাথমিক বিদ্যালয়</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Hind Siliguri', sans-serif; }
    </style>
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow-lg sticky top-0 z-[100]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="index.php" class="flex items-center gap-3">
                    <img src="assets/images/logo.png" alt="Logo" class="h-10 w-10 md:h-12 md:w-12">
                    <span class="text-xl md:text-2xl font-black bg-gradient-to-r from-blue-700 to-indigo-600 bg-clip-text text-transparent">শিশু বিদ্যা নিকেতন</span>
                </a>

                <div class="hidden md:flex space-x-8 font-bold text-gray-700">
                    <a href="index.php" class="hover:text-blue-600 transition">প্রচ্ছদ</a>
                    <a href="teachers.php" class="hover:text-blue-600 transition">শিক্ষকবৃন্দ</a>
                    <a href="students.php" class="hover:text-blue-600 transition">শিক্ষার্থী তথ্য</a>
                    <a href="admission.php" class="hover:text-orange-600 transition text-orange-600">ভর্তি তথ্য</a>
                    <a href="gallery.php" class="hover:text-blue-600 transition">গ্যালারি</a>
                    <a href="contact.php" class="hover:text-blue-600 transition">যোগাযোগ</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="toggle-btn" class="text-gray-700 hover:text-blue-600 focus:outline-none p-2 rounded-lg">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="icon-shape" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-box" class="hidden md:hidden bg-white border-t border-slate-100 shadow-2xl">
            <div class="px-4 py-6 space-y-2 font-bold text-gray-700">
                <a href="index.php" class="block py-3 px-4 rounded-xl hover:bg-blue-50">প্রচ্ছদ</a>
                <a href="teachers.php" class="block py-3 px-4 rounded-xl hover:bg-blue-50">শিক্ষকবৃন্দ</a>
                <a href="students.php" class="block py-3 px-4 rounded-xl hover:bg-blue-50">শিক্ষার্থী তথ্য</a>
                <a href="admission.php" class="block py-3 px-4 rounded-xl bg-orange-50 text-orange-600">ভর্তি তথ্য</a>
                <a href="gallery.php" class="block py-3 px-4 rounded-xl hover:bg-blue-50">গ্যালারি</a>
                <a href="contact.php" class="block py-3 px-4 rounded-xl hover:bg-blue-50">যোগাযোগ</a>
            </div>
        </div>
    </nav>

    <script>
        const btn = document.getElementById('toggle-btn');
        const box = document.getElementById('mobile-box');
        const icon = document.getElementById('icon-shape');

        btn.addEventListener('click', () => {
            box.classList.toggle('hidden');
            if (box.classList.contains('hidden')) {
                icon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    </script>