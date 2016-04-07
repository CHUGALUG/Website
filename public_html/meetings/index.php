<?php include dirname(__FILE__).'/../header.php';?>
<h2>Past Meeting Notes</h2>
<ul>
<?php
$dir = opendir(dirname(__FILE__));
while ($file = readdir($dir)) {
    $files[] = $file;
}
closedir($dir);

// Sort the filenames so that they are in order by date
sort($files);
$sorted = array_reverse($files);

foreach ($sorted as $file) {
    if (preg_match("#^(\d{4}\-\d\d\-\d\d)\.php$#", $file, $date_matches)) {
        $date = $date_matches[1];
        $contents = file_get_contents($file);
        if (preg_match("#<h2>(.*?)</h2>#", $contents, $matches)) {
            $title = $matches[1];
?>
    <li><a href="<?php echo $file;?>"><?php echo $date;?> - <?php echo $title;?></a></li>
<?php   
        }
    }
}
?>
</ul>
<?php include dirname(__FILE__).'/../footer.php';?>
