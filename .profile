#
# @(#)local.profile 1.4	93/09/15 SMI
#
stty istrip
PATH=$HOME/bin:/usr/ucb:/usr/local/bin:/usr/openwin/bin:/usr/bin:/usr/sbin:/bin:/usr/ccs/bin:/opt/SUNWspro/bin:/usr/etc:/opt/SUNWwabi/bin:.
export PATH

#
# If possible, start the windows system
#
if [ `tty` = "/dev/console" ] ; then
	if [ "$TERM" = "sun" -o "$TERM" = "AT386" ] ; then

		if [ ${OPENWINHOME:-""} = "" ] ; then
			OPENWINHOME=/usr/openwin
			export OPENWINHOME
		fi

		echo ""
		echo "Starting OpenWindows in 5 seconds (type Control-C to interrupt)"
		sleep 5
		echo ""
		$OPENWINHOME/bin/openwin

		clear		# get rid of annoying cursor rectangle
		exit		# logout after leaving windows system

	fi
fi

