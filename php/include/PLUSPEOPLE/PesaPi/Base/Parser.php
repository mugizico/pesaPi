<?php
/*	Copyright (c) 2014, PLUSPEOPLE Kenya Limited. 
		All rights reserved.

		Redistribution and use in source and binary forms, with or without
		modification, are permitted provided that the following conditions
		are met:
		1. Redistributions of source code must retain the above copyright
		   notice, this list of conditions and the following disclaimer.
		2. Redistributions in binary form must reproduce the above copyright
		   notice, this list of conditions and the following disclaimer in the
		   documentation and/or other materials provided with the distribution.
		3. Neither the name of PLUSPEOPLE nor the names of its contributors 
		   may be used to endorse or promote products derived from this software 
		   without specific prior written permission.
		
		THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND
		ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
		IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
		ARE DISCLAIMED.  IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE
		FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
		DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS
		OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
		HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
		LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
		OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
		SUCH DAMAGE.

		File originally by Michael Pedersen <kaal@pluspeople.dk>
 */
namespace PLUSPEOPLE\PesaPi\Base;

class Parser { 
	public function getBlankStructure() {
		return array("SUPER_TYPE" => 0,
								 "TYPE" => 0,
								 "RECEIPT" => "",
								 "TIME" => 0,
								 "PHONE" => "",
								 "NAME" => "",
								 "ACCOUNT" => "",
								 "STATUS" => "",
								 "AMOUNT" => 0,
								 "BALANCE" => 0,
								 "NOTE" => "",
								 "COST" => 0);
	}

	public function dateInput($time, $format) {
		$dt = \DateTime::createFromFormat($format, $time);
		return $dt->getTimestamp();
	}

	public function numberInput($input) {
		$input = trim($input);
		$amount = 0;

		if (preg_match("/^[0-9,]+\.?$/", $input)) {
			$amount = 100 * (int)str_replace(',', '', $input);
		} elseif (preg_match("/^[0-9,]+\.[0-9]$/", $input)) {
			$amount = 10 * (int)str_replace(array('.', ','), '', $input);
		} elseif (preg_match("/^[0-9,]*\.[0-9][0-9]$/", $input)) {
			$amount = (int)str_replace(array('.', ','), '', $input);
		} else {
			$amount = (int)$input;
		}
		return $amount;
	}


}
?>