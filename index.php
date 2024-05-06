<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <!-- TopicPick -->
        <div class="topicpick">
            <div class="list">
                <div class="item active">
                    <img src="images/PickNewsTopic/TinNong.png" alt="">
                    <div class="content">
                        <h2>Tin Nóng Y Tế</h2>
                        <p>Tin nóng y tế, tin thời sự ngành y tế hot nhất hôm nay</p>
                        <button class="more"><a href="TinNongYTe.php">Tìm Hiểu</a></button>
                    </div>
                </div>

                <div class="item">
                    <img src="images/PickNewsTopic/ThanhTuuYKhoa.png" alt="">
                    <div class="content">
                        <h2>Thành Tựu Y Khoa</h2>
                        <p>Những tin tức về thành tựu mà nền y tế Việt Nam đạt được</p>
                        <button class="more"><a href="ThanhTuuYKhoa.php">Tìm Hiểu</a></button>
                    </div>
                </div>

                <div class="item">
                    <img src="images/PickNewsTopic/HySinhThamLang.png" alt="">
                    <div class="content">
                        <h2>Sự Hi Sinh Thầm Lặng</h2>
                        <p>Những hành động cao đẹp, được thực hiện âm thầm, không mong đền đáp, vì lợi ích chung hoặc cho người khác.</p>
                        <button class="more">Tìm Hiểu</button>
                    </div>
                </div>

                <div class="item">
                    <img src="images/PickNewsTopic/BlogThayThuoc.png" alt="">
                    <div class="content">
                        <h2>Blog Thầy Thuốc</h2>
                        <p>Blog của thầy thuốc: Chia sẻ kiến thức y tế - Nâng cao chất lượng cuộc sống.</p>
                        <button class="more">Tìm Hiểu</button>
                    </div>
                </div>

                <div class="item">
                    <img src="images/PickNewsTopic/MeoSongKhoe.png" alt="">
                    <div class="content">
                        <h2>Mẹo Sống Khỏe</h2>
                        <p>Mẹo sống khỏe: Bí quyết sống vui sống khỏe mỗi ngày</p>
                        <button class="more">Tìm Hiểu</button>
                    </div>
                </div>
            </div>
            <div class="arrow">
                <button id="prev"><i class="fa-solid fa-arrow-left"></i></button>
                <button id="next"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
            <div class="img-track" id="img-track" data-mouse-down-at="0" data-prev-percentage="0">
                <div class="item active">
                    <img src="images/PickNewsTopic/TinNong.png" id="img" draggable="false" class="image">
                </div>
                <div class="item">
                    <img src="images/PickNewsTopic/ThanhTuuYKhoa.png" id="img" class="image" draggable="false">
                </div>
                <div class="item">
                    <img src="images/PickNewsTopic/HySinhThamLang.png" id="img" class="image" draggable="false">
                </div>
                <div class="item">
                    <img src="images/PickNewsTopic/BlogThayThuoc.png" id="img" class="image" draggable="false">
                </div>
                <div class="item">
                    <img src="images/PickNewsTopic/MeoSongKhoe.png" id="img" class="image" draggable="false">
                </div>
            </div>
        </div>
    </main>
    <script src="Javascript/main.js"></script>
</body>
</html>