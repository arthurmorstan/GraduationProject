<?php 
require 'config/database.php';

$title = $_POST['title'];
$slug = strtolower($title);
$slug = str_replace(" ","-",$slug);
$slug = str_replace("'","",$slug);
// a
$slug = str_replace("á", "a", $slug);
$slug = str_replace("à", "a", $slug);
$slug = str_replace("ả", "a", $slug);
$slug = str_replace("ã", "a", $slug);
$slug = str_replace("ạ", "a", $slug);
$slug = str_replace("ă", "a", $slug);
$slug = str_replace("ắ", "a", $slug);
$slug = str_replace("ằ", "a", $slug);
$slug = str_replace("ẳ", "a", $slug);
$slug = str_replace("ẵ", "a", $slug);
$slug = str_replace("ặ", "a", $slug);
$slug = str_replace("â", "a", $slug);
$slug = str_replace("ấ", "a", $slug);
$slug = str_replace("ầ", "a", $slug);
$slug = str_replace("ẩ", "a", $slug);
$slug = str_replace("ẫ", "a", $slug);
$slug = str_replace("ậ", "a", $slug);
// d
$slug = str_replace("đ", "d", $slug);
$slug = str_replace("Đ", "d", $slug);

// e
$slug = str_replace("é", "e", $slug);
$slug = str_replace("è", "e", $slug);
$slug = str_replace("ẻ", "e", $slug);
$slug = str_replace("ẽ", "e", $slug);
$slug = str_replace("ẹ", "e", $slug);
$slug = str_replace("ê", "e", $slug);
$slug = str_replace("ế", "e", $slug);
$slug = str_replace("ề", "e", $slug);
$slug = str_replace("ể", "e", $slug);
$slug = str_replace("ễ", "e", $slug);
$slug = str_replace("ệ", "e", $slug);
// i
$slug = str_replace("í", "i", $slug);
$slug = str_replace("ì", "i", $slug);
$slug = str_replace("ỉ", "i", $slug);
$slug = str_replace("ĩ", "i", $slug);
$slug = str_replace("ị", "i", $slug);
// o
$slug = str_replace("ó", "o", $slug);
$slug = str_replace("ò", "o", $slug);
$slug = str_replace("ỏ", "o", $slug);
$slug = str_replace("õ", "o", $slug);
$slug = str_replace("ọ", "o", $slug);
$slug = str_replace("ô", "o", $slug);
$slug = str_replace("ố", "o", $slug);
$slug = str_replace("ồ", "o", $slug);
$slug = str_replace("ổ", "o", $slug);
$slug = str_replace("ỗ", "o", $slug);
$slug = str_replace("ộ", "o", $slug);
$slug = str_replace("ơ", "o", $slug);
$slug = str_replace("ớ", "o", $slug);
$slug = str_replace("ờ", "o", $slug);
$slug = str_replace("ở", "o", $slug);
$slug = str_replace("ỡ", "o", $slug);
$slug = str_replace("ợ", "o", $slug);
// u
$slug = str_replace("ú", "u", $slug);
$slug = str_replace("ù", "u", $slug);
$slug = str_replace("ủ", "u", $slug);
$slug = str_replace("ũ", "u", $slug);
$slug = str_replace("ụ", "u", $slug);
$slug = str_replace("ư", "u", $slug);
$slug = str_replace("ứ", "u", $slug);
$slug = str_replace("Ứ", "u", $slug);
$slug = str_replace("ừ", "u", $slug);
$slug = str_replace("ử", "u", $slug);
$slug = str_replace("ữ", "u", $slug);
$slug = str_replace("ự", "u", $slug);
// y
$slug = str_replace("ý", "y", $slug);
$slug = str_replace("ỳ", "y", $slug);
$slug = str_replace("ỷ", "y", $slug);
$slug = str_replace("ỹ", "y", $slug);
$slug = str_replace("ỵ", "y", $slug);
// ,.?
$slug = str_replace(",", "", $slug);
$slug = str_replace(".", "", $slug);
$slug = str_replace("?", "", $slug);


$res = mysqli_query($connection, "SELECT * FROM posts AS news_categories WHERE slug = '$slug'");
if(mysqli_num_rows($res) > 0) {
	$res = mysqli_query($connection, "SELECT max(id) AS id FROM posts");
	$row = mysqli_fetch_assoc($res);
	$id = $row['id'];
	$id++;
	$slug = $slug.'-'.$id;
}
echo $slug;
?>