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

print "EppConCreate01 - test Create contact to tld epp server\n";

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
	if (isset($config['EppConnTest']['EppSNIServerName'])) {
		$init[$registry]['eppsniname'] = $config['EppConnTest']['EppSNIServerName'];
	}
} else {
	$init[$registry]['eppssl'] = 'false';
}

$registry	= "tld";
$phase		= "EppConCreate01";

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

$conId = $config[$phase][$phase.'Id'];
$PIntMand = $config[$phase][$phase.'PIntMand'];
$PIntName = $config[$phase][$phase.'PIntName'];
$PIntOrg = $config[$phase][$phase.'PIntOrg'];
$PIntStreet1 = $config[$phase][$phase.'PIntStreet1'];
$PIntStreet2 = $config[$phase][$phase.'PIntStreet2'];
$PIntStreet3 = $config[$phase][$phase.'PIntStreet3'];
$PIntCity = $config[$phase][$phase.'PIntCity'];
$PIntSp = $config[$phase][$phase.'PIntSp'];
$PIntPc = $config[$phase][$phase.'PIntPc'];
$PIntCc = $config[$phase][$phase.'PIntCc'];
$PLocMand = $config[$phase][$phase.'PLocMand'];
$PLocName = $config[$phase][$phase.'PLocName'];
$PLocOrg = $config[$phase][$phase.'PLocOrg'];
$PLocStreet1 = $config[$phase][$phase.'PLocStreet1'];
$PLocStreet2 = $config[$phase][$phase.'PLocStreet2'];
$PLocStreet3 = $config[$phase][$phase.'PLocStreet3'];
$PLocCity = $config[$phase][$phase.'PLocCity'];
$PLocSp = $config[$phase][$phase.'PLocSp'];
$PLocPc = $config[$phase][$phase.'PLocPc'];
$PLocCc = $config[$phase][$phase.'PLocCc'];
$Voice = $config[$phase][$phase.'Voice'];
$Fax = $config[$phase][$phase.'Fax'];
$Email = $config[$phase][$phase.'Email'];
$Auth = $config[$phase][$phase.'Auth'];

$conCre = new ireg_contact;
$conCre->id = $conId;
if ($PIntMand == "Y") {
	if (!empty($PIntName)) $conCre->postalIntName = $PIntName;
	if (!empty($PIntOrg)) $conCre->postalIntOrg = $PIntOrg;
	if (!empty($PIntStreet1)) $conCre->postalIntAddrStreet1 = $PIntStreet1;
	if (!empty($PIntStreet2)) $conCre->postalIntAddrStreet2 = $PIntStreet2;
	if (!empty($PIntStreet3)) $conCre->postalIntAddrStreet3 = $PIntStreet3;
	if (!empty($PIntCity)) $conCre->postalIntAddrCity = $PIntCity;
	if (!empty($PIntSp)) $conCre->postalIntAddrSp = $PIntSp;
	if (!empty($PIntPc)) $conCre->postalIntAddrPc = $PIntPc;
	if (!empty($PIntCc)) $conCre->postalIntAddrCc = $PIntCc;
}
if ($PLocMand == "Y") {
	if (!empty($PLocName)) $conCre->postalLocName = $PLocName;
	if (!empty($PLocOrg)) $conCre->postalLocOrg = $PLocOrg;
	if (!empty($PLocStreet1)) $conCre->postalLocAddrStreet1 = $PLocStreet1;
	if (!empty($PLocStreet2)) $conCre->postalLocAddrStreet2 = $PLocStreet2;
	if (!empty($PLocStreet3)) $conCre->postalLocAddrStreet3 = $PLocStreet3;
	if (!empty($PLocCity)) $conCre->postalLocAddrCity = $PLocCity;
	if (!empty($PLocSp)) $conCre->postalLocAddrSp = $PLocSp;
	if (!empty($PLocPc)) $conCre->postalLocAddrPc = $PLocPc;
	if (!empty($PLocCc)) $conCre->postalLocAddrCc = $PLocCc;
}
if (!empty($Voice)) $conCre->voice = $Voice;
if (!empty($Fax)) $conCre->fax = $Fax;
if (!empty($Email)) $conCre->email = $Email;
$conCre->auth = $Auth;

if ($con->conCreate($conCre)) {
	if (($con->getResCode() != "1000") && ($con->getResCode() != "1001")) {
		print "Contact Create (".$conId.") FAILED - ResultCOde != 1000 (".$con->getResCode().")\n";
		$con->disconnect();
		exit(1);
	} else {
		print "Contact Create (".$conId.") OK - ResultCode = ".$con->getResCode()."\n";
		$exCode=0;
	}
} else {
	$reason=$con->getErrorReason();
	if (isset($reason) && $reason != '') {
	  $reason=" (".$reason.")";
	} else {
	  $reason="";
	}
	print "Contact create FAILED - ".$con->getResCode()." - ".$con->getResMsg().$reason."\n";
	$con->disconnect();
	exit (1);
}

// And disconnect
$con->disconnect();
if ($con->getResCode() != "1500") {
	print "Disconnect FAILED - ResultCode != 1500 (".$con->getResCode().")\n";
	$exCode=1;
} else {
	print "Logout OK - ResultCode = ".$con->getResCode()."\n";
	$exCode=0;
}

exit($exCode);
?>
