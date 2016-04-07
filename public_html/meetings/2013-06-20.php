<?php include dirname(__FILE__).'/../header.php';?>

<div style="width:520px;">
<h2>Gearman</h2>
<p>Date: Jun. 20, 2013</p>

<p>Brandon Checketts gave a great talk about <a href="http://gearman.org">Gearman</a>.</p>

<b>Using Gearman Job Server</b> 
</br>
<blockquote>
<a href="http://gearman.org/">Gearman</a> is a cool job server that allows an application
much flexibility in determining where/when/how a job is run.
<br></br>
Learn how an application can use gearman to:
<ul>
 <li> Run jobs in the background
 <li> Distribute workload over multiple machines
 <li> Run multiple jobs simultaneously
 <li> Run jobs written in other languages
</ul>
Use Case Examples:
<ul>
 <li> Your web application needs to perform OCR an image, but you don't want to
install the OCR software on your web server.
 <li> Hitting a web page does something that takes a long time, but you don't want
to wait for it to finish before displaying the page.
 <li> You need to do a whole bunch of small jobs simultaneously on a bunch of machines.
</ul>
<blockquote>
</div>

<?php include dirname(__FILE__).'/../footer.php';?>
