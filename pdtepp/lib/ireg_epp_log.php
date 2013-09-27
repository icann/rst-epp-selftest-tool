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

//---------------------------------------------------------------------------
// IREG epp log:
class ireg_epp_log {

	public $id;
	public $timestamp;
	public $command;
	public $object;
	public $svTrid;
	public $clTrid;
	public $status;
	public $connected;
	public $sentXml;
	public $receivedXml;

        public function __construct() {
		$this->id = NULL;
		$this->timestamp = NULL;
		$this->command = '';
		$this->object = '';
		$this->svTrid = NULL;
		$this->clTrid = NULL;
		$this->status = 0;
		$this->connected = false;
		$this->sentXml = "";
		$this->receivedXml = "";
        }

	public function __destruct() {
		//print "In destructor (contact_se)\n";
	}

}

?>
