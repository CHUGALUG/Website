set path=(. $HOME/bin /opt/SUNWspro/bin /usr/ucb /usr/local/bin /usr/openwin/bin /usr/bin /usr/sbin /bin /usr/ccs/bin /opt/SUNWspro/bin /usr/etc /opt/SUNWwabi/bin)

if ($?prompt) then
	set notify
	set history = 50
	setenv EDITOR vi
endif
