<?php include dirname(__FILE__).'/../header.php';?>

<div style="width:520px;">
<h2>Glory, glory to btrfs and to hell with LVM (and mdadm)</h2>
Jackson Argo</br>
<p>Date: Mar. 24, 2015</p>
<a href="http://chugalug.uga.edu/graphics/Meeting_flyer_btrfs_2015-03-24.png">Meeting Flyer</a>
<br></br>
<u>Introductory portion:</u>
</br>
We begin with a brief discussion about what a filesystem is, how they work, and why they are important. Next, I'll show a comparison of ext4, the most common Linux filesystem, with btrfs, a new and feature rich Linux filesystem. Finally, we'll look at installing and using the btrfs filesystem, along with some handy tips and tricks. 
</br>
<br></br>
<u>Advanced portion:</u>
</br>
We've all gotten many miles out of the e2 filesystem family, and even alternatives like reiserfs and xfs, but Linux finally has a native filesystem with a featureset similar to Oracle's zfs. We'll look at how btrfs fixes many of the problems of ext4 and the problems that it doesn't fix, and some indepth examples of common usage such as raid, quotas, snapshots, and online scrubbing. 
<br></br>
</div>

<?php include dirname(__FILE__).'/../footer.php';?>
