#!/usr/bin/php
<?php
# Copyright (c) 2013 .SE (The Internet Infrastructure Foundation).
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions
# are met:
# 1. Redistributions of source code must retain the above copyright
# notice, this list of conditions and the following disclaimer.
# 2. Redistributions in binary form must reproduce the above copyright
# notice, this list of conditions and the following disclaimer in the
# documentation and/or other materials provided with the distribution.
#
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
# IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
# WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
# ARE DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY
# DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
# DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
# GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
# INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
# IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
# OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN
# IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
#
# Written by Jan Saell <jan@irial.com>

// IREG .SE PDT backend logic class

print "EppDomCreate01 - test Create domain to tld epp server\n";

require_once('./lib/parseIniFile.php');
require_once('./lib/ireg.php');
require_once('./lib/ireg_obj.php');
require_once('./lib/ireg_lib.php');

// Parse argument
$args = getopt('c:h:p:st:');
foreach (array('c', 'h', 'p', 't') as $opt) {
	if (!array_key_exists($opt, $args)) {
		die("usage: pdtConnTest -c config_file -h epphost -p eppport [-s] -t timeout\n");
	}
}

$CONF_FILE = $args['c'];
if (file_exists($CONF_FILE)) {
	$config = parseIniFile($CONF_FILE, true);
} else {
	die ("Cant open ini file '".$CONF_FILE."'\n");
}

$registry = "tld";

$init = array(
	$registry => array(
		'epphost' => $args['h'],
		'eppport' => $args['p'],
		'epptimeout' => $args['t']
	)
);
if (array_key_exists('s', $args)) {
	$init[$registry]['eppssl'] = 'true';
} else {
	$init[$registry]['eppssl'] = 'false';
}

$registry	= "tld";
$phase		= "EppDomCreate01";

if (!isset($init[$registry])) {
	print $argv[0]." missing registry '".$registry."'\n";
	exit (2);
}
$EPP_USER	= $config['EppConnTest']['EppLoginId'];
$EPP_PWD	= $config['EppConnTest']['EppLoginPwd'];
$EPP_CERT_PATH	= $config['EppConnTest']['EppClientKeyPairPem'];
$EPP_CERT_PWD	= $config['EppConnTest']['EppClientKeyPairPwd'];

$con = new ireg($config, $phase, $EPP_USER, $EPP_PWD, $EPP_CERT_PATH, $EPP_CERT_PWD, $init);
ireg_epp_log_start($registry, $con);
//$con->debugOn("/tmp/js.txt");

$exCode=-1;

$domain = $config[$phase][$phase.'Name'];
$period = strtolower($config[$phase][$phase.'Period']);
$pno = $config[$phase][$phase.'PeriodValue'];
$registrant = $config[$phase][$phase.'RegistrantId'];
$admin = $config[$phase][$phase.'AdminId'];
$billing = $config[$phase][$phase.'BillingId'];
$tech = $config[$phase][$phase.'TechId'];
$authPw = $config[$phase][$phase.'AuthPw'];
$ns01 = $config[$phase][$phase.'Ns01'];
$ns02 = $config[$phase][$phase.'Ns02'];

#print "Dom:".$domain.".persio=".$period.",pno=".$pno.",registrant=".$registrant."\n";

$domCre = new ireg_domain;
$domCre->name = $domain;
$domCre->insCont('owner', $registrant);
if ($admin != "") {
	$domCre->insCont('admin', $admin);
}
if ($billing != "") {
	$domCre->insCont('billing', $billing);
}
if ($tech != "") {
	$domCre->insCont('tech', $tech);
}
$domCre->authPw = $authPw;
$domCre->insNs(array('name'=>$ns01, 'addr_v4'=>array(), 'addr_v6'=>array()));
$domCre->insNs(array('name'=>$ns02, 'addr_v4'=>array(), 'addr_v6'=>array()));
if ($con->domCreate($domCre, $pno, $period)) {
	if (($con->getResCode() != "1000") && ($con->getResCode() != "1001")) {
		print "Domain Create (".$domain.") FAILED - ResultCode != 1000 or 1001 (".$con->getResCode().")\n";
		$con->disconnect();
		exit(1);
	} else {
		print "Domain Create (".$domain.") OK - ResultCode = ".$con->getResCode()."\n";
		$exCode=0;
	}
} else {
	$reason=$con->getErrorReason();
	if (isset($reason) && $reason != '') {
	  $reason=" (".$reason.")";
	} else {
	  $reason="";
	}
	print "Domain create FAILED - ".$con->getResCode()." - ".$con->getResMsg().$reason."\n";
	exit (1);
}

// And disconnect
$con->disconnect();
if ($con->getResCode() != "1500") {
	print "Disconnect FAILED - ResultCOde != 1500 (".$con->getResCode().")\n";
	$exCode=1;
} else {
	print "Logout OK - ResultCode = ".$con->getResCode()."\n";
	$exCode=0;
}

exit($exCode);
?>
