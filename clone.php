<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $token = trim($_POST['token']);
    $repoUrl = trim($_POST['repo_url']);

    if ($username && $token && $repoUrl) {
        $parsedUrl = parse_url($repoUrl);
        $host = $parsedUrl['host'];
        $path = $parsedUrl['path'];
        $authRepoUrl = "https://$username:$token@$host$path";
        $repoName = basename($path, ".git");
        if (is_dir($repoName)) {
            $error = "The repository '$repoName' already exists in this directory.";
        } else {
            $output = [];
            $status = 0;
            exec("git clone " . escapeshellarg($authRepoUrl) . " 2>&1", $output, $status);

            if ($status === 0) {
                $success = "Repository cloned successfully into '$repoName'.";
            } else {
                $error = "Failed to clone repository. Output:<br>" . implode("<br>", $output);
            }
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Clone GitHub Repo</title>
</head>

<body>
    <h2>Clone a GitHub Repository</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST">
        <label>GitHub Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Personal Access Token (PAT):</label><br>
        <input type="password" name="token" required><br><br>

        <label>Repository URL (e.g., https://github.com/user/repo.git):</label><br>
        <input type="text" name="repo_url" required><br><br>

        <button type="submit">Clone Repository</button>
    </form>
</body>

</html>
