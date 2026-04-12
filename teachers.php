<?php 
include 'config/db.php';
include 'includes/header.php'; 
$result = mysqli_query($conn, "SELECT * FROM teachers ORDER BY id DESC");
?>
<header class="bg-gradient-to-r from-blue-800 to-indigo-900 py-24 text-center relative overflow-hidden">
    <div class="relative z-10">
        <h1 class="text-5xl font-black text-white mb-4">আমাদের শিক্ষকবৃন্দ</h1>
    </div>
</header>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 p-8 flex flex-col md:flex-row items-center gap-10 relative overflow-hidden">
            <div class="absolute -top-16 -right-16 w-48 h-48 bg-slate-50 rounded-full"></div>
            
            <div class="w-48 h-48 shrink-0 relative z-10">
                <img src="assets/images/teachers/<?php echo $row['image'] ?? 'default.png'; ?>" class="w-full h-full object-cover rounded-3xl shadow-md">
            </div>
            
            <div class="flex-1 relative z-10 w-full">
                <h3 class="text-3xl font-black text-slate-900 mb-1"><?php echo $row['name'] ?? ''; ?></h3>
                <p class="text-blue-600 font-bold text-lg mb-8"><?php echo $row['designation'] ?? ''; ?></p>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl font-bold w-24 text-center mr-4">ফোন:</span>
                        <span class="font-bold text-slate-700"><?php echo $row['phone'] ?? ''; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl font-bold w-24 text-center mr-4">ইমেল:</span>
                        <span class="font-bold text-slate-700"><?php echo $row['email'] ?? ''; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl font-bold w-24 text-center mr-4">যোগ্যতা:</span>
                        <span class="font-bold text-slate-700"><?php echo $row['joggota'] ?? ''; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>