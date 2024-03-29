<?php

/*	This software is the unpublished, confidential, proprietary, intellectual
	property of Kim David Software, LLC and may not be copied, duplicated, retransmitted
	or used in any manner without expressed written consent from Kim David Software, LLC.
	Kim David Software, LLC owns all rights to this work and intends to keep this
	software confidential so as to maintain its value as a trade secret.

	Copyright 2004-Present, Kim David Software, LLC.

	WARNING! This code is part of the Kim David Software's Coreware system.
	Changes made to this source file will be lost when new versions of the
	system are installed.
*/

$GLOBALS['gPageCode'] = "LOGJAVASCRIPTERROR";
require_once "shared/startup.inc";

if (empty($_GET['ajax'])) {
	header("Location: /");
	exit;
}

if(!empty($_POST['is_error'])) {
	$errorText = "A JavaScript error occurred:\n\n" . $_POST['message'] .
		"\n\nURL: " . $_POST['url'] .
		"\n\nLine number: " . $_POST['line_no'] .
		"\n\nScript Filename: " . $_POST['script_filename'] .
		"\n\nError Source: " . $_POST['error_source'];
	$GLOBALS['gPrimaryDatabase']->logError($errorText);
} else {
	$logText = "Info message from JavaScript:\n\n" . $_POST['message'];
	addProgramLog($logText);
}

?>
