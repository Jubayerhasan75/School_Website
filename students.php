<?php 
include 'config/db.php';
include 'includes/header.php'; 

$selected_class = isset($_GET['class']) ? $_GET['class'] : '';

$query = "SELECT * FROM students";
if ($selected_class != '') {
    $query .= " WHERE class='$selected_class'";
}
$query .= " ORDER BY class ASC, roll_no ASC";

$result = mysqli_query($conn, $query);
$class_list = mysqli_query($conn, "SELECT DISTINCT class FROM students ORDER BY class");
?>

<header class="bg-gradient-to-r from-blue-800 to-indigo-900 py-24 text-center relative overflow-hidden">
    <div class="relative z-10">
        <h1 class="text-5xl font-black text-white mb-4">আমাদের শিক্ষার্থীবৃন্দ</h1>
        <p class="text-blue-100 text-lg font-medium">শ্রেণি অনুযায়ী শিক্ষার্থীদের তথ্য দেখুন</p>
    </div>
</header>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex justify-center mb-12">
        <form method="GET" class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
            <span class="font-bold text-slate-600">শ্রেণি নির্বাচন করুন:</span>
            <select name="class" onchange="this.form.submit()" class="p-3 bg-gray-50 rounded-xl ring-1 ring-gray-200 outline-none font-bold text-blue-600 min-w-[200px]">
                <option value="">সকল শিক্ষার্থী</option>
                <?php while($c = mysqli_fetch_assoc($class_list)): ?>
                    <option value="<?php echo $c['class']; ?>" <?php if($selected_class == $c['class']) echo 'selected'; ?>><?php echo $c['class']; ?></option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white rounded-[30px] shadow-sm overflow-hidden text-center p-6 border border-slate-100 group hover:shadow-xl transition duration-300 relative">
                <div class="w-32 h-32 mx-auto overflow-hidden rounded-full mb-6 ring-4 ring-slate-50 group-hover:ring-blue-100 transition duration-300">
                    <img src="assets/images/students/<?php echo $row['image']; ?>" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-1"><?php echo $row['name']; ?></h3>
                <p class="text-blue-600 font-bold text-sm">শ্রেণি: <?php echo $row['class']; ?></p>
                <p class="text-slate-500 font-bold text-sm mb-4">রোল: <?php echo $row['roll_no']; ?></p>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center">
                <div class="text-6xl mb-6">📂</div>
                <h2 class="text-2xl font-bold text-slate-400">এই শ্রেণির কোনো শিক্ষার্থীর তথ্য পাওয়া যায়নি</h2>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>