<?php 
include 'config/db.php';
include 'includes/header.php'; 

$slider_res = mysqli_query($conn, "SELECT * FROM slider ORDER BY id DESC");
$notices = mysqli_query($conn, "SELECT * FROM notices ORDER BY date DESC LIMIT 5");
$parties = mysqli_query($conn, "SELECT * FROM class_parties ORDER BY id DESC LIMIT 2");
$adm_text = mysqli_fetch_assoc(mysqli_query($conn, "SELECT content FROM admission_info LIMIT 1"));
?>

<section class="relative h-[400px] md:h-[550px] overflow-hidden">
    <div id="slider" class="flex transition-transform duration-700 h-full">
        <?php if(mysqli_num_rows($slider_res) > 0): ?>
            <?php while($slide = mysqli_fetch_assoc($slider_res)): ?>
            <div class="min-w-full h-full relative">
                <img src="assets/images/slider/<?php echo $slide['image']; ?>" class="w-full h-full object-cover">
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="min-w-full h-full relative">
                <img src="assets/images/slider/slide1.png" class="w-full h-full object-cover">
            </div>
        <?php endif; ?>
    </div>
    <button onclick="prevSlide()" class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 bg-white/20 p-3 md:p-4 rounded-full text-white backdrop-blur-md shadow-lg">❮</button>
    <button onclick="nextSlide()" class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 bg-white/20 p-3 md:p-4 rounded-full text-white backdrop-blur-md shadow-lg">❯</button>
</section>

<section class="py-12 max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
    <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-blue-500 text-center">
        <div class="text-3xl mb-4">🎓</div>
        <h3 class="text-xl font-bold mb-3">গুণগত শিক্ষা</h3>
        <p class="text-gray-600 text-sm md:text-base">আধুনিক পদ্ধতিতে পাঠদান নিশ্চিত করা হয়।</p>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-green-500 text-center">
        <div class="text-3xl mb-4">👩‍🏫</div>
        <h3 class="text-xl font-bold mb-3">দক্ষ শিক্ষিকা</h3>
        <p class="text-gray-600 text-sm md:text-base">স্নেহশীল শিক্ষিকারা শিক্ষার্থীদের যত্ন নেন।</p>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-orange-500 text-center">
        <div class="text-3xl mb-4">🎨</div>
        <h3 class="text-xl font-bold mb-3">সহ-শিক্ষা</h3>
        <p class="text-gray-600 text-sm md:text-base">সাংস্কৃতিক অনুষ্ঠান ও ক্লাস পার্টির আয়োজন।</p>
    </div>
</section>

<section class="py-10 max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-12">
    <div class="lg:col-span-2 space-y-16">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-800 mb-10 border-l-8 border-blue-600 pl-4 uppercase">ক্লাস পার্টিসমূহ</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while($party = mysqli_fetch_assoc($parties)): ?>
                <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="assets/images/gallery/<?php echo $party['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-8">
                        <h4 class="font-bold text-slate-800 text-xl mb-3"><?php echo $party['class_name']; ?></h4>
                        <p class="text-slate-500 text-sm leading-relaxed"><?php echo $party['description']; ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="bg-indigo-600 p-8 md:p-12 rounded-[40px] md:rounded-[50px] text-white shadow-2xl">
            <h2 class="text-2xl md:text-3xl font-black mb-4">ভর্তি তথ্য</h2>
            <p class="mb-8 text-indigo-100 text-base md:text-lg leading-relaxed"><?php echo $adm_text['content']; ?></p>
            <a href="admission.php" class="bg-white text-indigo-600 px-8 py-3 md:px-10 md:py-4 rounded-2xl font-black inline-block shadow-lg">বিস্তারিত দেখুন</a>
        </div>
    </div>

    <div class="bg-white p-8 md:p-10 rounded-[40px] md:rounded-[50px] shadow-sm border border-slate-100 h-fit sticky top-24">
        <h3 class="text-2xl font-black mb-8 flex items-center gap-3 text-slate-800">
            <span class="w-4 h-4 bg-red-500 rounded-full"></span>
            জরুরি নোটিশ
        </h3>
        <div class="space-y-8">
            <?php if(mysqli_num_rows($notices) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($notices)): ?>
                <div class="border-b border-slate-100 pb-6 last:border-0">
                    <p class="text-xs font-black text-blue-600 mb-2 uppercase tracking-widest"><?php echo date('d M, Y', strtotime($row['date'])); ?></p>
                    <h4 class="font-bold text-slate-800 text-lg leading-tight mb-2"><?php echo $row['title']; ?></h4>
                    <p class="text-slate-500 text-sm leading-relaxed"><?php echo $row['description']; ?></p>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-slate-400 text-center py-10 font-medium tracking-tight">বর্তমানে কোনো নোটিশ নেই</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="assets/js/main.js"></script>
<?php include 'includes/footer.php'; ?>