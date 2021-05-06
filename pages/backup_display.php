<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../header.php"; ?>
</head>
<body style="font-family:'Poppins', sans-serif;">
    <?php include_once "../navBar.php" ?>
    <div class='text-center my-5'>
        <h1>We Make Backups every day, and here they are.</h1>
        <h4 class='text-muted'>With Great Power Comes Great Responsibility</h4>
    </div>
    <div class='container'>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Backup Name</th>
                    <th scope="col">Backup File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Day 1 Backup</td>
                    <td><a href="/backups/2021-05-06_11-16-19.xlsx">Backup File</a></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
