<?php
session_start();

if (!isset($_SESSION["name"]) || !isset($_SESSION["email"])) {
    header("location:login.php");
    exit();
}

$name = $_SESSION["name"];
$email = $_SESSION["email"];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen">

<?php include "header.php"; ?>

<div class="flex items-center justify-center p-6 mt-10">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700"></div>
        
        <div class="px-8 pb-8">
            <div class="mt-8"> 
                <h2 class="text-3xl font-bold text-slate-800">Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
                <p class="text-slate-500">You are successfully authenticated.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Display Name</p>
                    <p class="text-lg font-medium text-slate-700"><?php echo htmlspecialchars($name); ?></p>
                </div>
                
                <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email Address</p>
                    <p class="text-lg font-medium text-slate-700"><?php echo htmlspecialchars($email); ?></p>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="flex items-center text-sm text-green-600 font-medium">
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse mr-2"></span>
                    System Online
                </span>
                <a href="logout.php" class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-6 py-2 rounded-lg transition duration-200 border border-red-200">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
