<?php include dirname(__FILE__).'/../header.php';?>


<h2>Fun with MySQL 5</h2>
<p>Date: February 19th, 2009</p>

<p>This meeting was the most well-attended that we have had in recent memory</p>

<p><a href="http://www.brandonchecketts.com/">Brandon Checketts</a> spoke about some interesting things he had worked with recently using MySQL 5 including Circular Replication and MERGE tables.</p>
<p>He started off with two vanilla installations of MySQL server, and configured a standard Master/Slave environment.  Then converted that to circular replication where updates made on either server were propagated to the other server as well.</p>
<p>Note that this might not be suitable for all environments or all types of data.  It is important to understand your unique circumstances</p>

<p>He also demonstrated some of the useful concepts using MERGE tables.  They can be used to split up large tables into smaller sections to avoid having huge tables.  In the example, his data was split up by month, but any other logical way works as well.   Merge tables can then be created on the fly to query just part (or the entire) subset of tables</p>


<?php include dirname(__FILE__).'/../footer.php';?>
