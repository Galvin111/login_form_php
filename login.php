<?php
session_start();
include "cfg/dbconnect.php";

$email = "";
$password = "";
$err_msg = "";
$remember = "";

if (isset($_POST["submit"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (isset($_POST["remember"])) {
        $remember = $_POST["remember"];
    }

    if ($email == "" || $password == "") {
        $err_msg = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg = "Please enter a valid email address.";
    } else {
        $password = md5($password);

        // Basic security improvement: prepared statement
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["name"] = $row["name"];
                $_SESSION["email"] = $row["email"];

                if (isset($_POST["remember"])) {
                    setcookie(
                        "remember_email",
                        $email,
                        time() + 3600 * 24 * 365,
                        "/",
                    );
                    setcookie("remember", "1", time() + 3600 * 24 * 365, "/");
                } else {
                    setcookie("remember_email", "", time() - 3600, "/");
                    setcookie("remember", "", time() - 3600, "/");
                }

                header("Location: index.php");
                exit();
            } else {
                $err_msg = "Incorrect Email Id/Password";
            }

            mysqli_stmt_close($stmt);
        } else {
            $err_msg = "Something went wrong. Please try again.";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login | Assignment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 m-4">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Welcome Back</h2>
        <p class="text-slate-500 mt-2">Please enter your details to sign in</p>
    </div>

    <?php if ($err_msg != "") { ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6" role="alert">
            <p class="text-sm"><?php echo $err_msg; ?></p>
        </div>
    <?php } ?>

    <form action="login.php" method="post" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
            <input 
                type="email" 
                name="email" 
                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                placeholder="you@example.com"
                value="<?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : htmlspecialchars($email); ?>"
                required
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input 
                type="password" 
                name="password" 
                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                placeholder="••••••••"
                required
            >
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500" <?php if (isset($_COOKIE["remember"])) echo "checked"; ?>>
                <span class="ml-2 text-sm text-slate-600">Remember Me</span>
            </label>
            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
        </div>

        <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg">
            Sign In
        </button>

        <p class="text-center text-sm text-slate-500 mt-4">
            Don't have an account? <a href="#" class="text-blue-600 font-semibold hover:underline">Request access</a>
        </p>
    </form>
</div>

</body>
</html>
