<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
if (isset($_POST['cari'])) {
    $silacari = $_POST['sname'];
    $cmdselect = "SELECT * FROM nurse2 WHERE name LIKE '%$silacari%'";
} else {
    $cmdselect = "SELECT * FROM nurse2";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Nurse Records</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="">
                <li><a href="home.php">Home</a></li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Register
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="regdoc.php">Doctor</a>
                            <a href="regnurse.php">Nurse</a>
                        </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Records
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="docrec.php">Doctor</a>
                            <a href="nurserec.php">Nurse</a>
                        </div>
                </li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">logout</button>

            </ul>
        </nav>
    </header>
    <main>
        <h2 class="title">Nurse Records</h2>
        <form class="search-form" action="" method="post">
            <input class="search-input" type="search" placeholder="Enter Name" name="sname">
            <input class="search-submit" type="submit" name="cari" value="search">
        </form>

        <div class="tables">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Select record from table nurse2
                    $resultselect = $conn->query($cmdselect);

                    if (@$resultselect->num_rows > 0) {
                        // Display result
                        while ($data = $resultselect->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $data['id']; ?></td>
                                <td data-label="Name"><?= $data['username']; ?></td>
                                <td data-label="Email"><?= $data['email']; ?></td>
                                <td data-label="Password"><?= $data['password']; ?></td>
                                <td data-label="Actions">
                                    <div class="btndoc">
                                        <a class="" href="editdoc.php?stdid=<?= $data['id'] ?>"><img class="btnfrom"
                                                src="/fyp/img/edit.png" alt=""></a>
                                        <a href="removenurse.php?stdid=<?= $data['id'] ?>"
                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                            <img class="btnfrom" src="/fyp/img/remove.png" alt="">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 Qualitas Health Malaysia. All Rights Reserved.</p>
        <ul class="social-links">
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/facebook.png" width="40">
                </a>
            </li>
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/insta.png" width="40">
                </a>
            </li>
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/x.png" width="40">
                </a>
            </li>
        </ul>
    </div>
</footer>

</html>