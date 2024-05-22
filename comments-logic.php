<?php

function setComments($connection)
{
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $query = "INSERT INTO comments (uid, date, message) VALUE ('$uid', '$date', '$message')";
        $result = mysqli_query($connection, $query);
    }
}

function getComments($connection)
{
    $query = "SELECT * FROM comments ORDER BY date DESC";
    $result = mysqli_query($connection, $query);
    while ($comment = mysqli_fetch_assoc($result)) {
        echo "<div class='comment-box'>";
        echo $comment['uid'] . "<br>";
        echo $comment['date'] . "<br>";
        echo nl2br($comment['message']);
        echo "

            <form class='delete-form' method='POST' action='". deleteComments($connection) ."'>
                <input type='hidden' name='cid' value='" . $comment['cid'] . "'>
                <button type='submit' name='commentDelete'>Xóa</button>
            </form>

            <form class='edit-form' method='POST' action='../editcomment.php'>
                <input type='hidden' name='cid' value='" . $comment['cid'] . "'>
                <input type='hidden' name='uid' value='" . $comment['uid'] . "'>
                <input type='hidden' name='date' value='" . $comment['date'] . "'>
                <input type='hidden' name='message' value='" . $comment['message'] . "'>
                <button>Chỉnh sửa</button>
            </form>
        </div>";
    }
}

function editComments($connection)
{
    if (isset($_POST['commentSubmit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $query = "UPDATE comments SET message='$message' WHERE cid= $cid ";
        $result = mysqli_query($connection, $query);
        // header("location: " . ROOT_URL . "index.php");
        // exit();
    }
}

function deleteComments($connection) {
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];

        $query = "DELETE FROM comments WHERE cid = $cid";
        $result = mysqli_query($connection, $query);
        header("Location: index.php");
    }
}   
