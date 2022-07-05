<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_mahasiswa_add = new tbl_mahasiswa_add();

// Run the page
$tbl_mahasiswa_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_mahasiswa_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_mahasiswaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_mahasiswaadd = currentForm = new ew.Form("ftbl_mahasiswaadd", "add");

	// Validate form
	ftbl_mahasiswaadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($tbl_mahasiswa_add->nim->Required) { ?>
				elm = this.getElements("x" + infix + "_nim");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_mahasiswa_add->nim->caption(), $tbl_mahasiswa_add->nim->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_mahasiswa_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_mahasiswa_add->nama->caption(), $tbl_mahasiswa_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_mahasiswa_add->date->Required) { ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_mahasiswa_add->date->caption(), $tbl_mahasiswa_add->date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_mahasiswa_add->date->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ftbl_mahasiswaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_mahasiswaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_mahasiswaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_mahasiswa_add->showPageHeader(); ?>
<?php
$tbl_mahasiswa_add->showMessage();
?>
<form name="ftbl_mahasiswaadd" id="ftbl_mahasiswaadd" class="<?php echo $tbl_mahasiswa_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_mahasiswa">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_mahasiswa_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_mahasiswa_add->nim->Visible) { // nim ?>
	<div id="r_nim" class="form-group row">
		<label id="elh_tbl_mahasiswa_nim" for="x_nim" class="<?php echo $tbl_mahasiswa_add->LeftColumnClass ?>"><?php echo $tbl_mahasiswa_add->nim->caption() ?><?php echo $tbl_mahasiswa_add->nim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_mahasiswa_add->RightColumnClass ?>"><div <?php echo $tbl_mahasiswa_add->nim->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_nim">
<input type="text" data-table="tbl_mahasiswa" data-field="x_nim" name="x_nim" id="x_nim" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($tbl_mahasiswa_add->nim->getPlaceHolder()) ?>" value="<?php echo $tbl_mahasiswa_add->nim->EditValue ?>"<?php echo $tbl_mahasiswa_add->nim->editAttributes() ?>>
</span>
<?php echo $tbl_mahasiswa_add->nim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_mahasiswa_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_tbl_mahasiswa_nama" for="x_nama" class="<?php echo $tbl_mahasiswa_add->LeftColumnClass ?>"><?php echo $tbl_mahasiswa_add->nama->caption() ?><?php echo $tbl_mahasiswa_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_mahasiswa_add->RightColumnClass ?>"><div <?php echo $tbl_mahasiswa_add->nama->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_nama">
<input type="text" data-table="tbl_mahasiswa" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($tbl_mahasiswa_add->nama->getPlaceHolder()) ?>" value="<?php echo $tbl_mahasiswa_add->nama->EditValue ?>"<?php echo $tbl_mahasiswa_add->nama->editAttributes() ?>>
</span>
<?php echo $tbl_mahasiswa_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_mahasiswa_add->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_tbl_mahasiswa_date" for="x_date" class="<?php echo $tbl_mahasiswa_add->LeftColumnClass ?>"><?php echo $tbl_mahasiswa_add->date->caption() ?><?php echo $tbl_mahasiswa_add->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_mahasiswa_add->RightColumnClass ?>"><div <?php echo $tbl_mahasiswa_add->date->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_date">
<input type="text" data-table="tbl_mahasiswa" data-field="x_date" name="x_date" id="x_date" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_mahasiswa_add->date->getPlaceHolder()) ?>" value="<?php echo $tbl_mahasiswa_add->date->EditValue ?>"<?php echo $tbl_mahasiswa_add->date->editAttributes() ?>>
<?php if (!$tbl_mahasiswa_add->date->ReadOnly && !$tbl_mahasiswa_add->date->Disabled && !isset($tbl_mahasiswa_add->date->EditAttrs["readonly"]) && !isset($tbl_mahasiswa_add->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_mahasiswaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_mahasiswaadd", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_mahasiswa_add->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_mahasiswa_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_mahasiswa_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_mahasiswa_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_mahasiswa_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_mahasiswa_add->terminate();
?>