<?php

namespace App\Libraries;
/**
 *
 * TinyButStrong - Template Engine for Pro and Beginners
 *
 * @version 3.10.1 for PHP 5
 * @date    2015-12-03
 * @link    http://www.tinybutstrong.com Web site
 * @author  http://www.tinybutstrong.com/onlyyou.html
 * @license http://opensource.org/licenses/LGPL-3.0 LGPL-3.0
 *
 * This library is free software.
 * You can redistribute and modify it even for commercial usage,
 * but you must accept and respect the LPGL License version 3.
 */



// *********************************************

class clsTbsLocator {
	public $PosBeg = false;
	public $PosEnd = false;
	public $Enlarged = false;
	public $FullName = false;
	public $SubName = '';
	public $SubOk = false;
	public $SubLst = array();
	public $SubNbr = 0;
	public $PrmLst = array();
	public $PrmIfNbr = false;
	public $MagnetId = false;
	public $BlockFound = false;
	public $FirstMerge = true;
	public $ConvProtect = true;
	public $ConvStr = true;
	public $ConvMode = 1; // Normal
	public $ConvBr = true;
}

// *********************************************
?>