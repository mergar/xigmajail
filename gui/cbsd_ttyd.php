<?php
require_once 'auth.inc';
require_once 'guiconfig.inc';
require_once("cbsd_manager-lib.inc");

if($_GET):
	if(isset($_GET['jid'])):
		$jid=$_GET['jid'];
	else:
		die();
	endif;
else:
	echo "No jid";
	die();
//	endif;
endif;

//echo "Starting terminal...";

//exec("/bin/pkill -9 ttyd; ttyd -c root:test1 -p 7681 /usr/sbin/jexec ${jid} /bin/csh;",$output,$return_val);
$cmd="ttyd --writable -c root:test1 -p 7681 /usr/sbin/jexec ${jid} /bin/csh";
//exec("/bin/pkill -9 ttyd;  tmux -2 -u new -d -s \"cbsd-${jname}\" \"${cmd}\" ;",$output,$return_val);
exec("/bin/pkill -9 ttyd; /usr/sbin/daemon -f ${cmd};",$output,$return_val);
//$output = shell_exec("/bin/pkill -9 ttyd; /usr/sbin/daemon -f ttyd -c root:test1 -p 7681 /usr/sbin/jexec ${jid} /bin/csh; sleep 2;");
if ( $return_val == 0 ):
	$url="http://root:test1@xigma:7681";
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\" />";
else:
	print_r($output);
endif;


//echo "COOL";
die();

include 'fend.inc';
