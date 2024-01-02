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

$GLOBALS['gPageCode'] = "DEBUGLOG";
require_once "shared/startup.inc";

class DebugLogPage extends Page {

	function setup() {
		if (method_exists($this->iTemplateObject, "getTableEditorObject")) {
			$this->iTemplateObject->getTableEditorObject()->setReadonly(true);
			$this->iTemplateObject->getTableEditorObject()->addCustomAction("clearlog", "Clear Log");
		}
	}

	function javascript() {
		?>
		<script>
            function customActions(actionName) {
                if (actionName == "clearlog") {
                    loadAjaxRequest("<?= $GLOBALS['gLinkUrl'] ?>?ajax=true&url_action=clearlog", function(returnArray) {
                        document.location = "<?= $GLOBALS['gLinkUrl'] ?>";
                    });
                    return true;
                }
                return false;
            }
		</script>
		<?php
	}

	function executePageUrlActions() {
		if ($_GET['url_action'] == "clearlog" && $GLOBALS['gPermissionLevel'] > 1) {
			executeQuery("delete from debug_log");
			echo jsonEncode(array());
			exit;
		}
	}
}

$pageObject = new DebugLogPage("debug_log");
$pageObject->displayPage();