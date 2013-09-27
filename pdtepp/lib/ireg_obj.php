<?php
# Copyright (c) 2009 YASK AB
# All rights reserved.
#
# This library is free software; you can redistribute it and/or modify
# it under the terms of the GNU Lesser General Public License as
# published by the Free Software Foundation; either version 2.1 of the
# License, or (at your option) any later version.
#
# This library is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# Lesser General Public License for more details.
#
# You should have received a copy of the GNU Lesser General Public
# License along with this library; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307
# USA.
#
# Written by Jan Saell <jan@irial.com>

// IREG .SE PDT backend objects class


//---------------------------------------------------------------------------
// IREG .SE PDT Contact objects:
class ireg_contact {

	public $id;
	public $roid;
	public $status;
	public $postalLocName;
	public $postalLocOrg;
	public $postalLocAddrStreet1;
	public $postalLocAddrStreet2;
	public $postalLocAddrStreet3;
	public $postalLocAddrCity;
	public $postalLocAddrSp;
	public $postalLocAddrPc;
	public $postalLocAddrCc;
	public $postalIntName;
	public $postalIntOrg;
	public $postalIntAddrStreet1;
	public $postalIntAddrStreet2;
	public $postalIntAddrStreet3;
	public $postalIntAddrCity;
	public $postalIntAddrSp;
	public $postalIntAddrPc;
	public $postalIntAddrCc;
	public $voice;
	public $fax;
	public $email;
	public $auth;
	public $discloseLocName;
	public $discloseIntName;
	public $discloseLocOrg;
	public $discloseIntOrg;
	public $discloseLocAddr;
	public $discloseIntAddr;
	public $discloseVoice;
	public $discloseFax;
	public $discloseEmail;
	public $clID;
	public $crID;
	public $crDate;
	public $upID;
	public $upDate;

        public function __construct() {
		$this->id = NULL;
		$this->roid = NULL;
		$this->status = NULL;
		$this->postalLocName = NULL;
		$this->postalLocOrg = NULL;
		$this->postalLocAddrStreet1 = NULL;
		$this->postalLocAddrStreet2 = NULL;
		$this->postalLocAddrStreet3 = NULL;
		$this->postalLocAddrCity = NULL;
		$this->postalLocAddrSp = NULL;
		$this->postalLocAddrPc = NULL;
		$this->postalLocAddrCc = NULL;
		$this->postalIntName = NULL;
		$this->postalIntOrg = NULL;
		$this->postalIntAddrStreet1 = NULL;
		$this->postalIntAddrStreet2 = NULL;
		$this->postalIntAddrStreet3 = NULL;
		$this->postalIntAddrCity = NULL;
		$this->postalIntAddrSp = NULL;
		$this->postalIntAddrPc = NULL;
		$this->postalIntAddrCc = NULL;
		$this->voice = NULL;
		$this->fax = NULL;
		$this->email = NULL;
		$this->auth = NULL;
		$this->discloseLocName = NULL;
		$this->discloseIntName = NULL;
		$this->discloseLocOrg = NULL;
		$this->discloseIntOrg = NULL;
		$this->discloseLocAddr = NULL;
		$this->discloseIntAddr = NULL;
		$this->discloseVoice = NULL;
		$this->discloseFax = NULL;
		$this->discloseEmail = NULL;
		$this->clID = NULL;
		$this->crID = NULL;
		$this->crDate = NULL;
		$this->upID = NULL;
		$this->upDate = NULL;
        }

	public function __destruct() {
		//print "In destructor (contact_se)\n";
	}

	public function hasLoc() {
		$ret = false;
		if (isset($this->postalLocName) ||
				isset($this->postalLocOrg) ||
				isset($this->postalLocAddrStreet1) ||
				isset($this->postalLocAddrStreet2) ||
				isset($this->postalLocAddrStreet3) ||
				isset($this->postalLocAddrCity) ||
				isset($this->postalLocAddrSp) ||
				isset($this->postalLocAddrPc) ||
				isset($this->postalLocAddrCc) ) {
			$ret = true;
		}
		return $ret;
	}

	public function hasInt() {
		$ret = false;
		if (isset($this->postalIntName) ||
				isset($this->postalIntOrg) ||
				isset($this->postalIntAddrStreet1) ||
				isset($this->postalIntAddrStreet2) ||
				isset($this->postalIntAddrStreet3) ||
				isset($this->postalIntAddrCity) ||
				isset($this->postalIntAddrSp) ||
				isset($this->postalIntAddrPc) ||
				isset($this->postalIntAddrCc) ) {
			$ret = true;
		}
		return $ret;
	}

	public function hasDisclose() {
		$ret = false;
		if (isset($this->discloseLocName) ||
				isset($this->discloseIntName) ||
				isset($this->discloseLocOrg) ||
				isset($this->discloseIntOrg) ||
				isset($this->discloseLocAddr) ||
				isset($this->discloseIntAddr) ||
				isset($this->discloseVoice) ||
				isset($this->discloseFax) ||
				isset($this->discloseEmail) ) {
			$ret = true;
		}
		return $ret;
	}

	public function hasDiscloseFalse() {
		$ret = false;
		if (($this->discloseLocName === false) ||
				($this->discloseIntName === false) ||
				($this->discloseLocOrg === false) ||
				($this->discloseIntOrg === false) ||
				($this->discloseLocAddr === false) ||
				($this->discloseIntAddr === false) ||
				($this->discloseVoice === false) ||
				($this->discloseFax === false) ||
				($this->discloseEmail === false) ) {
			$ret = true;
		}
		return $ret;
	}

	public function hasDiscloseTrue() {
		$ret = false;
		if (($this->discloseLocName === true) ||
				($this->discloseIntName === true) ||
				($this->discloseLocOrg === true) ||
				($this->discloseIntOrg === true) ||
				($this->discloseLocAddr === true) ||
				($this->discloseIntAddr === true) ||
				($this->discloseVoice === true) ||
				($this->discloseFax === true) ||
				($this->discloseEmail === true) ) {
			$ret = true;
		}
		return $ret;
	}

}

//---------------------------------------------------------------------------
// IREG .SE PDT Host objects:
class ireg_host {

	public $name;
	public $roid;
	public $status;
	public $ipv4;
	public $ipv6;
	public $clID;
	public $crID;
	public $crDate;
	public $upID;
	public $upDate;
	private $add;
	private $rem;
	private $addIpv4;
	private $addIpv6;
	private $remIpv4;
	private $remIpv6;

        public function __construct() {
		$this->name = NULL;
		$this->roid = NULL;
		$this->status = NULL;
		$this->ipv4 = array();
		$this->ipv6 = array();
		$this->clID = NULL;
		$this->crID = NULL;
		$this->crDate = NULL;
		$this->upID = NULL;
		$this->upDate = NULL;
		$this->add = false;
		$this->rem = false;
		$this->addIpv4 = array();
		$this->addIpv6 = array();
		$this->remIpv4 = array();
		$this->remIpv6 = array();
        }

	public function __destruct() {
		//print "In destructor (host_se)\n";
	}

	public function insIp($type, $adr) {
		switch ($type) {
			case "v4":
				$this->ipv4[count($this->ipv4)]=$adr;
				break;
			case "v6":
				$this->ipv6[count($this->ipv6)]=$adr;
				break;
		}
	}

	public function insIpV4($adr) {
		$this->ipv4[count($this->ipv4)]=$adr;
	}

	public function insIpV6($adr) {
		$this->ipv6[count($this->ipv6)]=$adr;
	}

	public function addIp($type, $adr) {
		switch ($type) {
			case "v4":
				$this->addIpv4[count($this->addIpv4)]=$adr;
				break;
			case "v6":
				$this->addIpv6[count($this->addIpv6)]=$adr;
				break;
		}
		$this->add = true;
	}

	public function hasAdd() {
		return $this->add;
	}

	public function getAdd($type) {
		switch ($type) {
			case "v4":
				$ret =  $this->addIpv4;
				break;
			case "v6":
				$ret =  $this->addIpv6;
				break;
		}
		return $ret;
	}

	public function remIp($type, $adr) {
		switch ($type) {
			case "v4":
				$this->remIpv4[count($this->remIpv4)]=$adr;
				break;
			case "v6":
				$this->remIpv6[count($this->remIpv6)]=$adr;
				break;
		}
		$this->rem = true;
	}

	public function hasRem() {
		return $this->rem;
	}

	public function getRem($type) {
		switch ($type) {
			case "v4":
				$ret =  $this->remIpv4;
				break;
			case "v6":
				$ret =  $this->remIpv6;
				break;
		}
		return $ret;
	}
}

//---------------------------------------------------------------------------
// IREG .SE PDT Domain objects:
class ireg_domain {

	public $name;
	public $roid;
	public $status;
	public $contOwn;
	public $contAdm;
	public $contBill;
	public $contTech;
	public $ns;
	public $host;
	public $secType;
	public $secDs;
	public $secDsKd;
	public $secKd;
	public $authPw;
	public $clID;
	public $crID;
	public $crDate;
	public $upID;
	public $upDate;
	public $exDate;
	public $trDate;
	private $add;
	private $rem;
	private $chg;
	private $secAdd;
	private $secRem;
	private $secRemAll;
	public $chgRegistrant;
	private $addNs;
	private $addContAdm;
	private $addContBill;
	private $addContText;
	public $addSecDs;
	public $addSecDsKd;
	public $addSecKs;
	private $addStat;
	private $remNs;
	private $remContAdm;
	private $remContBill;
	private $remContText;
	public $remSecDs;
	public $remSecDsKd;
	public $remSecKs;
	private $remStat;

        public function __construct() {
		$this->name = NULL;
		$this->roid = NULL;
		$this->status = NULL;
		$this->contOwn = array();
		$this->contAdm = array();
		$this->contBill = array();
		$this->contTech = array();
		$this->ns = array();
		$this->host = array();
		$this->deactDate = NULL;
		$this->delDate = NULL;
		$this->secType = NULL;
		$this->secDs = array();
		$this->secDsKd = array();
		$this->secKd = array();
		$this->authPw = NULL;
		$this->clID = NULL;
		$this->crID = NULL;
		$this->crDate = NULL;
		$this->upID = NULL;
		$this->upDate = NULL;
		$this->exDate = NULL;
		$this->trDate = NULL;
		$this->add = false;
		$this->rem = false;
		$this->chg = false;
		$this->secAdd = false;
		$this->secRem = false;
		$this->secRemAll = false;
		$this->chgRegistrant = NULL;
		$this->addNs = array();
		$this->addContAdm = array();
		$this->addContBill = array();
		$this->addContTech = array();
		$this->addSecDs = array();
		$this->addSecDsKd = array();
		$this->addSecKd = array();
		$this->addStat = array();
		$this->remNs = array();
		$this->remContAdm = array();
		$this->remContBill = array();
		$this->remContTech = array();
		$this->remSecDs = array();
		$this->remSecDsKd = array();
		$this->remSecKd = array();
		$this->remStat = array();
        }

	public function __destruct() {
		//print "In destructor (domain_se)\n";
	}

	public function insCont($type, $id) {
		switch ($type) {
			case "owner":
				$this->contOwn[count($this->contOwn)]=$id;
				break;
			case "admin":
				$this->contAdm[count($this->contAdm)]=$id;
				break;
			case "billing":
				$this->contBill[count($this->contBill)]=$id;
				break;
			case "tech":
				$this->contTech[count($this->contTech)]=$id;
				break;
		}
	}

	public function insNs($ns) {
		$this->ns[count($this->ns)]=$ns;
	}

	public function insHost($host) {
		$this->host[count($this->host)]=$host;
	}

	public function insSecDs($ds) {
		$this->secDs[count($this->secDs)]=$ds;
		$this->secType = "D";
	}

	public function insSecDsKd($ds,$kd) {
		$this->secDs[count($this->secDs)]=$ds;
		$this->secDsKd[count($this->secDsKd)]=$kd;
		$this->secType = "DK";
	}

	public function insSecKd($kd) {
		$this->secKd[count($this->secKd)]=$kd;
		$this->secType = "K";
	}

	public function hasAdd() {
		return $this->add;
	}

	public function hasSecAdd() {
		return $this->secAdd;
	}

	public function addNs($ns) {
		$this->addNs[count($this->addNs)]=$ns;
		$this->add = true;
	}

	public function addCont($type, $id) {
		switch ($type) {
			case "owner":
				$this->chgRegistrant=$id;
				$this->chg = true;
				break;
			case "admin":
				$this->addContAdm[count($this->addContAdm)]=$id;
				$this->add = true;
				break;
			case "billing":
				$this->addContBill[count($this->addContBill)]=$id;
				$this->add = true;
				break;
			case "tech":
				$this->addContTech[count($this->addContTech)]=$id;
				$this->add = true;
				break;
		}
	}

	public function addSecDs($sec) {
		$this->addSecDs[count($this->addSecDs)]=$sec;
		$this->secAdd = true;
		$this->secType = "D";
	}

	public function addSecDsKd($secDs,$secKd) {
		$this->addSecDs[count($this->addSecDs)]=$secDs;
		$this->addSecDsKd[count($this->addSecDsKd)]=$secKd;
		$this->secAdd = true;
		$this->secType = "DK";
	}

	public function addSecKd($sec) {
		$this->addSecKd[count($this->addSecKd)]=$sec;
		$this->secAdd = true;
		$this->secType = "K";
	}

	public function addStatus($status) {
		switch ($status) {
			case "clientHold":
				$this->addStat[count($this->addStat)]=$status;
				$this->add = true;
				break;
		}
	}

	public function getAdd($type) {
		switch ($type) {
			case "ns":
				$ret =  $this->addNs;
				break;
			case "contAdm":
				$ret =  $this->addContAdm;
				break;
			case "contBill":
				$ret =  $this->addContBill;
				break;
			case "contTech":
				$ret =  $this->addContTech;
				break;
			case "sec":
				$ret =  $this->addSec;
				break;
			case "status":
				$ret =  $this->addStat;
				break;
		}
		return $ret;
	}

	public function hasRem() {
		return $this->rem;
	}

	public function hasSecRem() {
		return $this->secRem;
	}

	public function hasSecRemAll() {
		return $this->secRemAll;
	}

	public function remNs($ns) {
		$this->remNs[count($this->remNs)]=$ns;
		$this->rem = true;
	}

	public function remCont($type, $id) {
		switch ($type) {
			case "admin":
				$this->remContAdm[count($this->remContAdm)]=$id;
				break;
			case "billing":
				$this->remContBill[count($this->remContBill)]=$id;
				break;
			case "tech":
				$this->remContTech[count($this->remContTech)]=$id;
				break;
		}
		$this->rem = true;
	}

	public function remSecDs($sec) {
		$this->remSecDs[count($this->remSecDs)]=$sec;
		$this->secRem = true;
		$this->secType = "D";
	}

	public function remSecDsKd($secDs,$secKd) {
		$this->remSecDs[count($this->remSec)]=$secDs;
		$this->remSecKd[count($this->remSecDsKd)]=$secKd;
		$this->secRem = true;
		$this->secType = "DK";
	}

	public function remSecKd($sec) {
		$this->remSecKd[count($this->remSecKd)]=$sec;
		$this->secRem = true;
		$this->secType = "K";
	}

	public function remSecAll() {
		$this->secRemAll = true;
	}

	public function remStatus($status) {
		switch ($status) {
			case "clientHold":
				$this->remStat[count($this->remStat)]=$status;
				$this->rem = true;
				break;
		}
	}

	public function getRem($type) {
		switch ($type) {
			case "ns":
				$ret =  $this->remNs;
				break;
			case "contAdm":
				$ret =  $this->remContAdm;
				break;
			case "contBill":
				$ret =  $this->remContBill;
				break;
			case "contTech":
				$ret =  $this->remContTech;
				break;
			case "sec":
				$ret =  $this->remSec;
				break;
			case "status":
				$ret =  $this->remStat;
				break;
		}
		return $ret;
	}

	public function hasChg() {
		$ret = $this->chg;
		if (isset($this->authPw)) {
			$ret=true;
		}
		return $ret;
	}
}

?>
