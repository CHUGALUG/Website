<?php

## Redirect /index.php to /
if ($_SERVER['REQUEST_URI'] == '/index.php') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: http://chugalug.uga.edu/');
    exit;
}

## Redirect requests to /~chugalug to /chugalug
if (preg_match("#~chugalug/(.*)$#", $_SERVER['REQUEST_URI'], $matches)) {
    header('HTTP/1.1 301 Moved Permanently');
    header("Location: http://chugalug.uga.edu/{$matches[1]}");
    exit;
}

?><html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1" />
<meta NAME="Author" CONTENT="Vadim Omelchenko" />
<title>CHUGALUG - <?php echo (!empty($title)) ? $title : 'Classic Hackers UGA Linux User Group';?></title>
<link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>
<center>

<div style="width: 800px;">
    <table width="100%">
        <tr>
            <td>
                <a href="/index.php"><img src="/graphics/ch_logo52.jpg" height="106" width="318" border="0"></a><br />
            </td>
            <td>
                <p> If you're new to Linux this is the group for you!<br />
                Beginners are very welcome!  </p>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Welcome Athens Linux Users!</strong>
            </td>
            <td>
		<a href="https://twitter.com/ClassicHackers" class="twitter-follow-button" data-show-count="false">Follow @ClassicHackers</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> &nbsp;
		<a href="http://facebook.com/groups/chugalug"><img src="/graphics/FB-f-Logo__blue_29.png" height=18px></a> <a href="http://facebook.com/groups/chugalug"><sup>Join Group</sup></a>
            </td>
        </tr>
    </table>

    <hr />


    <table width="100%" id="leftside">
        <tr>
            <td valign="top" style="width: 240px;">
                <h3>What is CHUGALUG?</h3>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/name.php">Explanation of the name <i>CHUGALUG</i></a></li>
                    <li><a href="/mission.php">Mission</a></li>
                    <li><a href="/membership.php">Membership</a></li>
                    <li><a href="/upcoming.php">Upcoming Meetings</a></li>
                    <li><a href="/map.php">Meeting Location Map</a></li>
                    <li><a href="/meetings/index.php">Past Meetings</a></li>
                    <li><a href="/library.php">Library</a></li>
                    <li><a href="/lists.php">Mailing Lists</a></li>
                </ul>

<h3>Local Linux Resources</h3>
<ul>
    <li><a href="http://www.freeitathens.org/">Free IT Athens</a></li>
        <ul> <li><a href="http://www.freeitathens.org/contact-or-visit-us/">Location information for Free IT Athens</a>
        </ul>
    <li><a href="http://www.ale.org">Atlanta Linux Enthusiasts</a></li>
</ul>



<h3>World Wide Linux links</h3>

<ul>
    <li><a href="http://www.linux.org/">Linux.org</a></li>
    <li><a href="http://www.linux.com/">Linux.com</a></li>
    <li><a href="http://www.southeastlinuxfest.org">southeastlinuxfest.org </a></li>
    <li><a href="http://tldp.org/">Linux Documentation Project</a></li>
    <li><a href="http://wiht.co/linux-primer">A Linux Primer</a></li>
    <li><a href="https://www.rosehosting.com/blog">Linux Tutorials from RoseHosting.com</a></li>
    <li><a href="https://thishosting.rocks/centos-vs-ubuntu-server/">CentOS vs Ubuntu comparison</a></li>
</ul>


            <td valign="top" style="padding-left: 20px;">

