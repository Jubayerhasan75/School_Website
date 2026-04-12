<?php 
include 'config/db.php';
include 'includes/header.php'; 

$id = $_GET['id'];
$teacher = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE id=$id"));
?>
<section class="py-32 flex justify-center px-4 bg-slate-50 min-h-[80vh]">
    <div class="bg-white max-w-4xl w-full p-12 rounded-[50px] shadow-sm flex flex-col md:flex-row gap-12 items-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/5 rounded-bl-full"></div>
        <img src="assets/images/teachers/<?php echo $teacher['image']; ?>" class="w-72 h-72 rounded-[40px] object-cover shadow-2xl rotate-2">
        <div class="flex-1">
            <h1 class="text-4xl font-black text-slate-900 mb-2"><?php echo $teacher['name']; ?></h1>
            <p class="text-xl text-blue-600 font-bold mb-10"><?php echo $teacher['designation']; ?></p>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-600 font-bold">ফোন:</div>
                    <div class="text-lg font-bold text-slate-700"><?php echo $teacher['phone']; ?></div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-600 font-bold">ইমেল:</div>
                    <div class="text-lg font-bold text-slate-700"><?php echo $teacher['email']; ?></div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-600 font-bold">যোগ্যতা:</div>
                    <div class="text-lg font-bold text-slate-700"><?php echo $teacher['qualification']; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>