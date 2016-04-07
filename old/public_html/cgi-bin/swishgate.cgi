#!/usr/bin/perl

## Swishgate v1.1 by Dave Disser
## 
## A generic front-end to swish searches, for the purpose of providing search
## capability for end users.
##
## Copyright (C) 1994 by the Regents of the University of Michigan.
##
## User agrees to reproduce said copyright notice on all copies of the software
## made by the recipient.
##
## All Rights Reserved. Permission is hereby granted for the recipient to make
## copies and use this software for its own internal purposes only. Recipient of
## this software may not re-distribute this software outside of their own
## institution. Permission to market this software commercially, to include this
## product as part of a commercial product, or to make a derivative work for
## commercial purposes, is explicitly prohibited.  All other uses are also
## prohibited unless authorized in writing by the Regents of the University of
## Michigan.
##
## This software is offered without warranty. The Regents of the University of
## Michigan disclaim all warranties, express or implied, including but not
## limited to the implied warranties of merchantability and fitness for any
## particular purpose. In no event shall the Regents of the University of
## Michigan be liable for loss or damage of any kind, including but not limited
## to incidental, indirect, consequential, or special damages.
##
## $Log: swishgate,v $
# Revision 1.4  1995/05/05  19:25:16  disser
# resolvelink patch
#
# Revision 1.3  1995/04/18  15:59:07  disser
# minor change
#
# Revision 1.2  1995/04/11  20:19:43  disser
# Compatibility with swish 1.1
#
##

push (@INC,"/usr/local/lib/perl");

require 'shellwords.pl';	# Need this to parse swish output
require 'ctime.pl';		# For error reporting.

# No biggie if we're not at CAEN.
eval "require '/usr/caen/www/httpd/lib/www.pl'";
$CAEN++ unless $@; 

&www'settimelimit(60) if $CAEN;

###################################################################
## Site customization

# Only files that match this pattern after links resolved are valid.
$ValidSwishFile =
'.*\.swish$';

%SwishVersions = ('1.1', '/usr/local/bin/swish');

$WebMaster="<em i><a href=\"mailto:chugalug\@www.uga.edu\">" .
           "chugalug\@www.uga.edu</em></a>\n";
$MySite = 'http://www.uga.edu';
$MyURL = "$MySite/sites-bin/swishgate.cgi";
$MaxResults = 40;         # default; the user can override this

## End of site config
####################################################################

print "Content-Type: text/html\n\n";

## Set up the args

if ($ENV{'REQUEST_METHOD'} eq 'POST') {
    while (1) {
        $c=sysread(STDIN,$in,1024);
        $query .= $in;
        last if $c < 1024;
    }
    ($query =~ s/\n$//);

    for (split(/&/,$query)) {
       ($k,$v)=split(/=/,$_);

       $v=~s/\+/ /g;
       $v=~s/%(..)/pack("H2",$1)/ge;

       $f{$k}=$v;
    }

    $SearchKeys = $f{'search'};
    $MaxResults = $f{'maxresults'} if $f{'maxresults'};
    $SearchFlags = 'B' if $f{'body'};
    $SearchFlags .= 't' if $f{'title'};
    $SearchFlags .= 'h' if $f{'headers'};
    $SearchFlags = '' if $f{'all'};
} 


$SwishFile = $OSwishFile = $ENV{'PATH_TRANSLATED'};

##
## Check out the swish file.
##

&SwishHelp unless $SwishFile;
$SwishFile = &resolvelink($SwishFile); # Is the path good?
&error("$SwishFile ($OSwishFile) is not a valid path")     
  unless ($SwishFile =~ m@$ValidSwishFile@);
&error("$SwishFile does not exist")                # Does the file exist?
  unless (-f $SwishFile);

# Check the version of the swish file
open(F,"$SwishFile") || &error("Cannot read $SwishFile");
chop($header = <F>);
close(F);

if ($header =~ /format (\d+\.\d+)/) {
    $fileVersion = $1;
} else {
    &error("$SwishFile is not a valid swish file.");
}

# Do we support this version?
unless ($SwishProgram = $SwishVersions{$fileVersion}) {
    &error("This swish file is an unsupported version.");
}

##
## Do we search or make a form?
##

unless ($SearchKeys) { $SwishFile ? &PrintForm : &SwishHelp; }

##
## Let's do a search.
##

unless (open(F,'-|')) {
    local(@flags) = ('-t', $SearchFlags)
	if ($fileVersion eq '1.1' && $SearchFlags);
    exec($SwishProgram,'-f',$SwishFile,'-w',$SearchKeys,'-m',$MaxResults, 
	 @flags);
    die "Can't exec $SwishProgram: $!";
}

@results=<F>;
close(F);

shift(@results) while($results[0] =~ /^(search words|#)/);
pop @results;

print "<h1>Search Results for \"$SearchKeys\"</h1>\n";

if ($results[0] =~ /^err:/) {
    print $results[0];
} else {
    for (@results) {
        ($score, $url, $title, $size) = &shellwords;
        next if ($docs{"$title$score$size"}++); # Don't dup stuff.
#TOMHACK
        $pathToVirtual = "/icons";
        $pathToFile = "/opt/web/icons";
        ($url =~ m|.*/[^/]+\.(.*)$|) && ($extension = $1);
        $picfilename = "$extension.gif";
        if(!(-r "$pathToFile/$picfilename")) {
           $picURL = "/~chugalug/gifs/search.gif";
        }
        else {
           $picURL = "$pathToVirtual/$picfilename";
        }
	printf "<IMG SRC=\"$picURL\"> Score: %04d <a href=\"$url\">$title</a> (%1.1f Kb) <br>\n", $score, $size/1024;
	printf "<tt>  $url</tt><p>\n";
    }
}

&footer;

sub PrintForm {
    local($ops) = '<b>and</b> and </b>or</b>';
    if ($fileVersion eq '1.1') {
	$ops = '<b>and</b>, <b>or</b>, <b>not</b>, <b>(</b>, and <b>)</b>';
    }

    print <<EOM;
<h1>Swish Search</h1>
<form method="POST" action="$MyURL$ENV{'PATH_INFO'}">
To search the index at $MySite$ENV{'PATH_INFO'}, enter your search words
here.  You may use $ops as logical operators.<p>
Match no more than <input name="maxresults" value=40 size=4> documents.<p>
EOM

    if ($fileVersion eq '1.1') {
	print <<EOM;
<input name="all" type="checkbox" checked> Search everything<br>
<input name="title" type="checkbox"> Search title<br>
<input name="headers" type="checkbox"> Search headers<br>
<input name="body" type="checkbox"> Search body<br>
<p>
EOM
    }

    print <<EOM;
Search for <input name="search" size=40>
<input type="submit" name="Submit Query">
</form>
EOM
    &footer;
    exit;
}

sub error {
    print "<h1>Error</h1>\n",@_,".<br>\nPlease report any problems to $WebMaster\n";
    local($date,$host);
    chop($date=&ctime(time));
    ($host=$ENV{'REMOTE_HOST'}) || ($host=$ENV{'REMOTE_ADDR'})
	|| ($host='unknown');
    print STDERR "[$date] swishgate: @_ from $host\n";
    exit 1;
}

sub resolvelink {
        local($path) = @_;

        return('/') if $path eq '/';

        local(@path) = split(m@/@, $path);
        chop($path=`pwd`);
        local(@outpath) = split(m@/@, $path);
        shift(@outpath);

        while(@path) {
                $component = shift @path;
                if ($component eq '') {
                        @outpath=();
                } elsif ($component eq '..') {
                        pop(@outpath);
                } elsif ($component eq '.') {
                } else {
                        $curpath = join('/','',@outpath,'/',$component);
                        $linktext = readlink($curpath);
                        if (defined($linktext)) {
                                unshift(@path, split(m@/@, $linktext));
                        } else {
                                push(@outpath, $component);
                        }
                }

        }
        '/' . join('/',@outpath);
}

sub SwishHelp {
    local($k,$v);
    print <<EOM;
<title>SwishGate Help</title>
<h1>SwishGate Help</h1>
SwishGate is a utility that allows users to create their own searchable indices
of web documents without assistance from the Web administrator.  It is based
on the <a href="http://www.eit.com/software/swish/swish.html">swish</a> 
from <a href="http://www.eit.com/">EIT</a>.

<h2>Creating a Swish index</h2>
Please see the excellent documentation on
<a href="http://www.eit.com/software/swish/swish.html#4">indexing with swish
</a>.  Note that we've a added the <b>-l</b> flag and <b>FollowLinks</b>
keyword to cause swish to follow symbolic links when indexing.  After you have created an index file, make sure it ends with 
<b>.swish</b> and resides somewhere in your <b>~/Public/html</b> directory.
Now you're ready to search!

<h2>Searching a Swish index</h2>
You can search your swish index by accessing the URL 
$MyURL/<i>~loginid/file.swish</i>, where you substitute your login id and 
the path to your swish file, starting from your ~/Public/html directory.

<h2>Making your own Search Forms</h2>
With your favorite Web browser, save the default search form as an html file,
then modify it with your own customizations.

<h2>How to get SwishGate</h2>
SwishGate is available via the URL
<a href="http://www-personal.engin.umich.edu/~disser/devel/swishgate.pl">
http://www-personal.engin.umich.edu/~disser/devel/swishgate.pl</a>.

<h2>Copyright</h2>
Copyright (C) 1994,1995 by the Regents of the University of Michigan.

User agrees to reproduce said copyright notice on all copies of the software
made by the recipient.<p>

All Rights Reserved. Permission is hereby granted for the recipient to make
copies and use this software for its own internal purposes only. Recipient of
this software may not re-distribute this software outside of their own
institution. Permission to market this software commercially, to include this
product as part of a commercial product, or to make a derivative work for
commercial purposes, is explicitly prohibited.  All other uses are also
prohibited unless authorized in writing by the Regents of the University of
Michigan.<p>

This software is offered without warranty. The Regents of the University of
Michigan disclaim all warranties, express or implied, including but not
limited to the implied warranties of merchantability and fitness for any
particular purpose. In no event shall the Regents of the University of
Michigan be liable for loss or damage of any kind, including but not limited
to incidental, indirect, consequential, or special damages.
<hr>

<A HREF="http://www.engin.umich.edu/htdocs/credits.html">
CAENweb</A>: Computer Aided
Engineering Network<BR>University of Michigan College of Engineering --
1994</H5><p>
EOM
    exit;
}

sub footer {
	print <<EOM;
<hr>
<A HREF="http://www.engin.umich.edu/htdocs/credits.html">
CAENweb</A>: Computer Aided
Engineering Network<BR>University of Michigan College of Engineering --
1994</H5><p>
<a href="$MyURL">Online help</a> is available for swishgate.
EOM
}

