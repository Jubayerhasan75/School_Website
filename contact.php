<?php 
include 'config/db.php';
$msg_status = "";
if(isset($_POST['send_msg'])) {
    $n = mysqli_real_escape_string($conn, $_POST['name']);
    $c = mysqli_real_escape_string($conn, $_POST['contact']);
    $m = mysqli_real_escape_string($conn, $_POST['message']);
    mysqli_query($conn, "INSERT INTO messages (name, contact, message) VALUES ('$n', '$c', '$m')");
    $msg_status = "বার্তা সফলভাবে পাঠানো হয়েছে!";
}
include 'includes/header.php'; 
?>
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div class="bg-white p-12 rounded-[50px] shadow-sm border">
                <h3 class="text-2xl font-bold mb-8">বার্তা পাঠান</h3>
                <?php if($msg_status != ""): ?>
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold"><?php echo $msg_status; ?></div>
                <?php endif; ?>
                <form action="" method="POST" class="space-y-8">
                    <input type="text" name="name" class="w-full px-8 py-5 rounded-3xl bg-slate-50 outline-none ring-1 ring-slate-100" placeholder="আপনার নাম" required>
                    <input type="text" name="contact" class="w-full px-8 py-5 rounded-3xl bg-slate-50 outline-none ring-1 ring-slate-100" placeholder="ইমেল বা ফোন নম্বর" required>
                    <textarea name="message" rows="5" class="w-full px-8 py-5 rounded-3xl bg-slate-50 outline-none ring-1 ring-slate-100" placeholder="বার্তা লিখুন..." required></textarea>
                    <button type="submit" name="send_msg" class="w-full bg-blue-600 text-white font-black py-6 rounded-3xl">বার্তা পাঠান</button>
                </form>
            </div>
            <div class="space-y-10">
                <div class="bg-gradient-to-br from-blue-700 to-indigo-800 p-12 rounded-[50px] text-white shadow-2xl">
                    <h3 class="text-2xl font-bold mb-8">স্কুল লোকেশন</h3>
                    <p class="text-xl font-bold mb-4">৫৬/১, উত্তর মুগদা (ঝিলপাড়), ঢাকা - ১২১৪</p>
                    <p class="text-xl font-bold">+৮৮০ ১৭১২-৩৪৫৬৭৮</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>