<?php
namespace App\Libraries;
/**
 * clsTbsXmlLoc
 * Wrapper to search and replace in XML entities.
 * The object represents only the opening tag until method FindEndTag() is called.
 * Then is represents the complete entity.
 */
class clsTbsXmlLoc {

	var $PosBeg;
	var $PosEnd;
	var $SelfClosing;
	var $Txt;
	var $Name = ''; 

	var $pST_PosEnd = false; // start tag: position of the end
	var $pST_Src = false;    // start tag: source
	var $pET_PosBeg = false; // end tag: position of the beginning

	var $Parent = false; // parent object

	// For relative mode
	var $rel_Txt = false;
	var $rel_PosBeg = false;
	var $rel_Len = false;
	
	// Create an instance with the given parameters
	function __construct(&$Txt, $Name, $PosBeg, $SelfClosing = null, $Parent=false) {
	
		$this->PosEnd = strpos($Txt, '>', $PosBeg);
		if ($this->PosEnd===false) $this->PosEnd = strlen($Txt)-1; // should no happen but avoid errors
	
		$this->Txt = &$Txt;
		$this->Name = $Name;
		$this->PosBeg = $PosBeg;
		$this->pST_PosEnd = $this->PosEnd;
		$this->SelfClosing = $SelfClosing;
		$this->Parent = $Parent;
	}

	// Return an array of (val_pos, val_len, very_sart, very_len) of the attribute. Return false if the attribute is not found.
	// Positions are relative to $this->PosBeg.
	// This method is lazy because it assumes the attribute is separated by a space and its value is delimited by double-quote.
	function _GetAttValPos($Att) {
		if ($this->pST_Src===false) $this->pST_Src = substr($this->Txt, $this->PosBeg, $this->pST_PosEnd - $this->PosBeg + 1 );
		$a = ' '.$Att.'="';
		$p0 = strpos($this->pST_Src, $a);
		if ($p0!==false) {
			$p1 = $p0 + strlen($a);
			$p2 = strpos($this->pST_Src, '"', $p1);
			if ($p2!==false) return array($p1, $p2-$p1, $p0, $p2-$p0+1);
		}
		return false;
	}
	
	// Update positions when attributes of the start tag has been upated.
	function _ApplyDiffFromStart($Diff) {
		$this->pST_PosEnd += $Diff;
		$this->pST_Src = false;
		if ($this->pET_PosBeg!==false) $this->pET_PosBeg += $Diff;
		$this->PosEnd += $Diff;
	}
	
	// Update all positions.
	function _ApplyDiffToAll($Diff) {
		$this->PosBeg += $Diff;
		$this->PosEnd += $Diff;
		$this->pST_PosEnd += $Diff;
		if ($this->pET_PosBeg!==false) $this->pET_PosBeg += $Diff;
	}

	// Return true is the ending position is a self-closing.
	function _SelfClosing($PosEnd) {
		return (substr($this->Txt, $PosEnd-1, 1)=='/');
	}
	
	// Return the outer len of the locator.
	function GetLen() {
		return $this->PosEnd - $this->PosBeg + 1;
	}

	// Return the outer source of the locator.
	function GetSrc() {
		return substr($this->Txt, $this->PosBeg, $this->GetLen() );
	}

	// Replace the source of the locator in the TXT contents.
	// Update the locator's ending position.
	// Too complicated to update other information, given that it can be deleted.
	function ReplaceSrc($new) {
		$len = $this->GetLen(); // avoid PHP error : Strict Standards: Only variables should be passed by reference
		$this->Txt = substr_replace($this->Txt, $new, $this->PosBeg, $len);
		$diff = strlen($new) - $len;
		$this->PosEnd += $diff;
		$this->pST_Src = false;
		if ($new==='') {
			$this->pST_PosBeg = false;
			$this->pST_PosEnd = false;
			$this->pET_PosBeg = false;
		} else {
			$this->pST_PosEnd += $diff; // CAUTION: may be wrong if attributes has changed
			if ($this->pET_PosBeg!==false) $this->pET_PosBeg += $diff; // CAUTION: right only if the tag name is the same
		}
	}

	// Return the start of the inner content, or false if it's a self-closing tag 
	// Return false if SelfClosing.
	function GetInnerStart() {
		return ($this->pST_PosEnd===false) ? false : $this->pST_PosEnd + 1;
	}

	// Return the length of the inner content, or false if it's a self-closing tag
	// Assume FindEndTag() is previously called.
	// Return false if SelfClosing.
	function GetInnerLen() {
		return ($this->pET_PosBeg===false) ? false : $this->pET_PosBeg - $this->pST_PosEnd - 1;
	}

	// Return the length of the inner content, or false if it's a self-closing tag 
	// Assume FindEndTag() is previously called.
	// Return false if SelfClosing.
	function GetInnerSrc() {
		return ($this->pET_PosBeg===false) ? false : substr($this->Txt, $this->pST_PosEnd + 1, $this->pET_PosBeg - $this->pST_PosEnd - 1 );
	}

	// Replace the inner source of the locator in the TXT contents. Update the locator's positions.
	// Assume FindEndTag() is previously called.
	// Convert a self-closing entity to a start+end entity if needed.
	function ReplaceInnerSrc($new) {
		if ($this->SelfClosing) {
			$end = '>' . $new . '</' . $this->FindName() . '>';
			$this->Txt = substr_replace($this->Txt, $end, $this->PosEnd - 1, 2);
			$this->SelfClosing = false;
			$this->pST_PosEnd = $this->PosEnd - 1;
			$this->pET_PosBeg = $this->pST_PosEnd + strlen($new) + 1;
			$this->PosEnd = $this->pST_PosEnd + strlen($end) - 1;
		} else {
			$len = $this->GetInnerLen();
			if ($len===false) return false;
			$this->Txt = substr_replace($this->Txt, $new, $this->pST_PosEnd + 1, $len);
			$this->PosEnd += strlen($new) - $len;
			$this->pET_PosBeg += strlen($new) - $len;
		}
	}

	// Update the parent object, if any.
	function UpdateParent($Cascading=false) {
		if ($this->Parent) {
			$this->Parent->ReplaceSrc($this->Txt);
			if ($Cascading) $this->Parent->UpdateParent($Cascading);
		}
	}

	// Get an attribute's value. Or false if the attribute is not found.
	// It's a lazy way because the attribute is searched with the patern {attribute="value" }
	function GetAttLazy($Att) {
		$z = $this->_GetAttValPos($Att);
		if ($z===false) return false;
		return substr($this->pST_Src, $z[0], $z[1]);
	}

	function ReplaceAtt($Att, $Value, $AddIfMissing = false) {

		$Value = ''.$Value;

		$z = $this->_GetAttValPos($Att);
		if ($z===false) {
			if ($AddIfMissing) {
				// Add the attribute
				$Value = ' '.$Att.'="'.$Value.'"';
				$pi = $this->pST_PosEnd;
				if ($this->_SelfClosing($pi)) $pi--;
				$z = array($pi - $this->PosBeg, 0);
			} else {
				return false;
			}
		}

		$this->Txt = substr_replace($this->Txt, $Value, $this->PosBeg + $z[0], $z[1]);

		// update info
		$this->_ApplyDiffFromStart(strlen($Value) - $z[1]);

		return true;

	}
	
	// Delete the element with or without the content.
	function Delete($Contents=true) {
		$this->FindEndTag();
		if ($Contents || $this->SelfClosing) {
			$this->ReplaceSrc('');
		} else {
			$inner = $this->GetInnerSrc();
			$this->ReplaceSrc($inner);
		}
	}
	
	/**
	 * Return true if the attribute existed and is deleted, otherwise return false.
	 */
	function DeleteAtt($Att) {
		$z = $this->_GetAttValPos($Att);
		if ($z===false) return false;
		$this->Txt = substr_replace($this->Txt, '', $this->PosBeg + $z[2], $z[3]);
		$this->_ApplyDiffFromStart( - $z[3]);
		return true;
	}

	// Find the name of the element
	function FindName() {
		if ($this->Name==='') {
			$p = $this->PosBeg;
			do {
				$p++;
				$z = $this->Txt[$p];
			} while ( ($z!==' ') && ($z!=="\r") && ($z!=="\n") && ($z!=='>') && ($z!=='/') );
			$this->Name = substr($this->Txt, $this->PosBeg + 1, $p - $this->PosBeg - 1);
		}
		return $this->Name;
	}

	// Find the ending tag of the object
	// Use $Encaps=true if the element can be self encapsulated (like <div>).
	// Return true if the end is funf
	function FindEndTag($Encaps=false) {
		if (is_null($this->SelfClosing)) {
			$pe = $this->PosEnd;
			$SelfClosing = $this->_SelfClosing($pe);
			if (!$SelfClosing) {
				if ($Encaps) {
					$loc = clsTinyButStrong::f_Xml_FindTag($this->Txt , $this->FindName(), null, $pe, true, -1, false, false);
					if ($loc===false) return false;
					$this->pET_PosBeg = $loc->PosBeg;
					$this->PosEnd = $loc->PosEnd;
				} else {
					$pe = clsTinyButStrong::f_Xml_FindTagStart($this->Txt, $this->FindName(), false, $pe, true , true);
					if ($pe===false) return false;
					$this->pET_PosBeg = $pe;
					$pe = strpos($this->Txt, '>', $pe);
					if ($pe===false) return false;
					$this->PosEnd = $pe;
				}
			}
			$this->SelfClosing = $SelfClosing;
		}
		return true;
	}

	// Swith the locator to a realtive one that has no XML contents before and no XML contents after.
	// Useful to save time in search and replace.
	function switchToRelative() {
		$this->FindEndTag();
		// Save info
		$this->rel_Txt = &$this->Txt;
		$this->rel_PosBeg = $this->PosBeg;
		$this->rel_Len = $this->GetLen();
		// Change the univers
		$src = $this->GetSrc();
		$this->Txt = &$src;
		// Change positions
		$this->_ApplyDiffToAll(-$this->PosBeg);
	}

	// To use after switchToRelative(): save modificatin to the normal contents and update positions.
	function switchToNormal() {
		// Save info
		$src = $this->GetSrc();
		$this->Txt = &$this->rel_Txt;
		$x = false;
		$this->rel_Txt = &$x;
		$this->Txt = substr_replace($this->Txt, $src, $this->rel_PosBeg, $this->rel_Len);
		$this->_ApplyDiffToAll(+$this->rel_PosBeg);
		$this->rel_PosBeg = false;
		$this->rel_Len = false;
	}
	
	/**
	 * Search a start tag of an element in the TXT contents, and return an object if it is found.
	 * Instead of a TXT content, it can be an object of the class. Thus, the object is linked to a copy
	 *  of the source of the parent element. The parent element can receive the changes of the object using method UpdateParent().
	 */
	static function FindStartTag(&$TxtOrObj, $Tag, $PosBeg, $Forward=true) {

		if (is_object($TxtOrObj)) {
			$TxtOrObj->FindEndTag();
			$Txt = $TxtOrObj->GetSrc();
			if ($Txt===false) return false;
			$Parent = &$TxtOrObj;
		} else {
			$Txt = &$TxtOrObj;
			$Parent = false;
		}

		$PosBeg = clsTinyButStrong::f_Xml_FindTagStart($Txt, $Tag, true , $PosBeg, $Forward, true);
		if ($PosBeg===false) return false;

		return new clsTbsXmlLoc($Txt, $Tag, $PosBeg, null, $Parent);

	}

	// Search a start tag by the prefix of the element
	static function FindStartTagByPrefix(&$Txt, $TagPrefix, $PosBeg, $Forward=true) {

		$x = '<'.$TagPrefix;
		$xl = strlen($x);

		if ($Forward) {
			$PosBeg = strpos($Txt, $x, $PosBeg);
		} else {
			$PosBeg = strrpos(substr($Txt, 0, $PosBeg+2), $x);
		}
		if ($PosBeg===false) return false;

		// Read the actual tag name
		$Tag = $TagPrefix;
		$p = $PosBeg + $xl;
		do {
			$z = substr($Txt,$p,1);
			if ( ($z!==' ') && ($z!=="\r") && ($z!=="\n") && ($z!=='>') && ($z!=='/') ) {
				$Tag .= $z;
				$p++;
			} else {
				$p = false;
			}
		} while ($p!==false);

		return new clsTbsXmlLoc($Txt, $Tag, $PosBeg);

	}

	// Search an element in the TXT contents, and return an object if it's found.
	static function FindElement(&$TxtOrObj, $Tag, $PosBeg, $Forward=true) {

		$XmlLoc = clsTbsXmlLoc::FindStartTag($TxtOrObj, $Tag, $PosBeg, $Forward);
		if ($XmlLoc===false) return false;

		$XmlLoc->FindEndTag();
		return $XmlLoc;

	}

	// Search an element in the TXT contents which has the asked attribute, and return an object if it is found.
	// Note that the element found has an unknown name until FindEndTag() is called.
	// The given attribute can be with or without a specific value. Example: 'visible' or 'visible="1"'
	static function FindStartTagHavingAtt(&$Txt, $Att, $PosBeg, $Forward=true) {

		$p = $PosBeg - (($Forward) ? 1 : -1);
		$x = (strpos($Att, '=')===false) ? (' '.$Att.'="') : (' '.$Att); // get the item more precise if not yet done
		$search = true;

		do {
			if ($Forward) {
				$p = strpos($Txt, $x, $p+1);
			} else {
				$p = strrpos(substr($Txt, 0, $p+1), $x);
			}
			if ($p===false) return false;
			do {
			  $p = $p - 1;
			  if ($p<0) return false;
			  $z = $Txt[$p];
			} while ( ($z!=='<') && ($z!=='>') );
			if ($z==='<') $search = false;
		} while ($search);

		return new clsTbsXmlLoc($Txt, '', $p);

	}

	static function FindElementHavingAtt(&$Txt, $Att, $PosBeg, $Forward=true) {

		$XmlLoc = clsTbsXmlLoc::FindStartTagHavingAtt($Txt, $Att, $PosBeg, $Forward);
		if ($XmlLoc===false) return false;

		$XmlLoc->FindEndTag();

		return $XmlLoc;

	}

}
?>