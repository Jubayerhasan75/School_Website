<?php 
include 'config/db.php';
include 'includes/header.php'; 

$category_filter = isset($_GET['cat']) ? $_GET['cat'] : '';
if($category_filter) {
    $query = "SELECT * FROM gallery WHERE category='$category_filter' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM gallery ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16">
            <div>
                <h2 class="text-4xl font-black text-slate-900">ফটোগ্যালারি</h2>
                <p class="text-slate-500 mt-2">আমাদের স্কুলের সুন্দর মুহূর্তগুলো ও ক্লাস পার্টির স্মৃতি</p>
            </div>
            <div class="flex gap-3 mt-8 md:mt-0">
                <a href="gallery.php" class="px-6 py-2 rounded-xl font-bold transition <?php echo !$category_filter ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-white text-slate-600 border'; ?>">সব</a>
                <a href="gallery.php?cat=Class Party" class="px-6 py-2 rounded-xl font-bold transition <?php echo $category_filter == 'Class Party' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-white text-slate-600 border'; ?>">ক্লাস পার্টি</a>
                <a href="gallery.php?cat=Achievement" class="px-6 py-2 rounded-xl font-bold transition <?php echo $category_filter == 'Achievement' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'bg-white text-slate-600 border'; ?>">অর্জন</a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="relative h-80 rounded-[40px] overflow-hidden group shadow-sm hover:shadow-2xl transition duration-500">
                    <img src="assets/images/gallery/<?php echo $row['image']; ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="<?php echo $row['title']; ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-8">
                        <div>
                            <span class="text-blue-400 text-xs font-bold uppercase tracking-widest"><?php echo $row['category']; ?></span>
                            <p class="text-white font-bold text-xl mt-1"><?php echo $row['title']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-400 text-lg">এখনো কোনো ছবি আপলোড করা হয়নি।</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>