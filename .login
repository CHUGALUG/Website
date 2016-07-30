stty erase  kill ^U intr ^C
tset -I -Q
umask 022

setenv EXINIT 'set redraw wm=8 showmode'
setenv TERM vt100
setenv MAIL /var/mail/chugalug
date
stty intr  
alias dir ls -alF
alias del rm
alias md mkdir
alias rd rmdir
alias ren mv
alias cd cd
alias copy cp
cd .
