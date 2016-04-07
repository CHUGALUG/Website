<?php include dirname(__FILE__).'/../header.php';?>


<h2>Linux and Scientific Computing</h2>
<p>Date: March 19th, 2009</p>

<p>Again, attendance at this meeting was relatively high.   Hopefully that means we are talking about interesting things and have some return visitors who think this stuff is interesting</p>

<p>Lachele's presentation comprised of two main parts:</p>
<ol>
    <li><strong>Compiling applications from source</strong>
        <p>She demonstrated the common steps for compiling an application from source, including some tips such as creating an &quot;installer&quot; user to prevent accidental mistakes.   Applications have widely varying degrees of 'user friendliness', so it pays to be careful when extracting and compiling a new program. </p>
        <p>This led well into the second part of her presentation which focused on scientific computing applications which often need to be compiled from source</p>
    </li>
    <li><strong>Scientific computing</strong>
        <p>Lachele works in the <a href="http://glycam.com">GlyCam lab</a> which does complex analyses of carbohydrate molecules.  Scientists often use several specialized programs to perform different pieces of the analysis.  Many of the programs are written by scientists (not programmers), so they often have to be compiled from source, and aren't generally portable.  They often need specific versions of libraries and have other complications.</p>
        <p>These different programs that rely on data in different formats.   Lachele spends a lot of time converting data from one format to another and has developed her own C-based library to assist in performing many of these data transformations.   She has released her library at <a href="http://glycam.com/glylib">http://glycam.com/glylib</a>.  It makes use of <a href="http://www.doxygen.org/">Doxygen</a> for automating some documentation.
    </li>
</ol>

<h3>Presentation Download</h3>
<a href="presentations/20090319_CHUGALUG_Installing_from_Sources_topost.odp">Installing From Source</a> (OpenOffice .odp format)<br />
<a href="presentations/20090319_CHUGALUG_Linux_Scientific_Computing_topost.sxi.odp">Linux Scientific Computing</a> (OpenOffice .odp format)<br />

<?php include dirname(__FILE__).'/../footer.php';?>
