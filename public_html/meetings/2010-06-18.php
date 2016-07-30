<?php include dirname(__FILE__).'/../header.php';?>

<div style="width:520px;">
<h2>GNU Screen</h2>
<p>Date: May 20th, 2010</p>

<p>Mark Heiges gave a great presentation on <a href="http://www.gnu.org/software/screen/">GNU Screen</a>.  Many people have at least attempted to use screen an he demonstrated plenty of cases where it is useful.  </p>

<p>Some notes are presented below</p>


<pre>
Google: gnu screen

<a href="http://www.gnu.org/software/screen/">http://www.gnu.org/software/screen/</a>

comprehensive general info, screenrc samples
<a href="http://www.softpanorama.org/Utilities/screen.shtml">http://www.softpanorama.org/Utilities/screen.shtml</a>

general info, screenrc samples
<a href="http://polishlinux.org/howtos/screen-tips-tricks/#">http://polishlinux.org/howtos/screen-tips-tricks/#</a>
<a href="http://www.ibm.com/developerworks/aix/library/au-gnu_screen/index.html?ca=dgr-lnxw06GNU-Screen&S_TACT=105AGX59&S_CMP=grsitelnxw06">http://www.ibm.com/developerworks/aix/library/au-gnu_screen/index.html?ca=dgr-lnxw06GNU-Screen&S_TACT=105AGX59&S_CMP=grsitelnxw06</a>

Working with the Scrollback Buffer
<a href="http://www.samsarin.com/blog/2007/03/11/gnu-screen-working-with-the-scrollback-buffer/">http://www.samsarin.com/blog/2007/03/11/gnu-screen-working-with-the-scrollback-buffer/</a>
<a href="http://www.linuxscrew.com/2008/11/14/faq-how-to-scrollback-in-gnu-screen/">http://www.linuxscrew.com/2008/11/14/faq-how-to-scrollback-in-gnu-screen/</a>

Automatic Session Logging And Monitoring With GNU Screen For The Paranoid.
<a href="http://www.cmdln.org/2007/07/20/automatic-session-logging-and-monitoring-with-gnu-screen-for-the-paranoid/">http://www.cmdln.org/2007/07/20/automatic-session-logging-and-monitoring-with-gnu-screen-for-the-paranoid/</a>

Screen sharing
<a href="http://www.commandlinefu.com/commands/view/1700/share-a-terminal-screen-with-others">http://www.commandlinefu.com/commands/view/1700/share-a-terminal-screen-with-others</a>
<a href="http://hezmatt.org/~mpalmer/blog/knowledge/software/screen/">http://hezmatt.org/~mpalmer/blog/knowledge/software/screen/</a>


tmux
<a href="http://tmux.sourceforge.net/">http://tmux.sourceforge.net/</a>

byobu
<a href="https://launchpad.net/byobu">https://launchpad.net/byobu</a>
<a href="http://blog.dustinkirkland.com/search/label/Byobu">http://blog.dustinkirkland.com/search/label/Byobu</a>


--- screenrc used in sharing demo  (I forgot to point out that you can include another configuration file with 'source') --

multiuser on
acladd joeuser
aclchg joeuser +rx "#?"  # ro, all windows, execute all commands
aclchg joeuser -x "#,at,aclchg,acladd,acldel,quit" # except these
commands in all windows
acladd betty
aclchg betty +rwx "#?" # enable r/w access
aclchg betty -x "#,at,aclchg,acladd,acldel,quit"
source .screenrc 

</pre>


</div>


<?php include dirname(__FILE__).'/../footer.php';?>
