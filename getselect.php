<?php
function getselect($checkval, $selectedval) {
	$selectStr = "";
	if ($checkval == $selectedval) {
		$selectStr = " Selected";
	}
	return $selectStr;
}
?>