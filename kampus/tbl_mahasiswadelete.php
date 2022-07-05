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
$tbl_mahasiswa_delete = new tbl_mahasiswa_delete();

// Run the page
$tbl_mahasiswa_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_mahasiswa_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_mahasiswadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_mahasiswadelete = currentForm = new ew.Form("ftbl_mahasiswadelete", "delete");
	loadjs.done("ftbl_mahasiswadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_mahasiswa_delete->showPageHeader(); ?>
<?php
$tbl_mahasiswa_delete->showMessage();
?>
<form name="ftbl_mahasiswadelete" id="ftbl_mahasiswadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_mahasiswa">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_mahasiswa_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_mahasiswa_delete->id->Visible) { // id ?>
		<th class="<?php echo $tbl_mahasiswa_delete->id->headerCellClass() ?>"><span id="elh_tbl_mahasiswa_id" class="tbl_mahasiswa_id"><?php echo $tbl_mahasiswa_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->nim->Visible) { // nim ?>
		<th class="<?php echo $tbl_mahasiswa_delete->nim->headerCellClass() ?>"><span id="elh_tbl_mahasiswa_nim" class="tbl_mahasiswa_nim"><?php echo $tbl_mahasiswa_delete->nim->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $tbl_mahasiswa_delete->nama->headerCellClass() ?>"><span id="elh_tbl_mahasiswa_nama" class="tbl_mahasiswa_nama"><?php echo $tbl_mahasiswa_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->date->Visible) { // date ?>
		<th class="<?php echo $tbl_mahasiswa_delete->date->headerCellClass() ?>"><span id="elh_tbl_mahasiswa_date" class="tbl_mahasiswa_date"><?php echo $tbl_mahasiswa_delete->date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_mahasiswa_delete->RecordCount = 0;
$i = 0;
while (!$tbl_mahasiswa_delete->Recordset->EOF) {
	$tbl_mahasiswa_delete->RecordCount++;
	$tbl_mahasiswa_delete->RowCount++;

	// Set row properties
	$tbl_mahasiswa->resetAttributes();
	$tbl_mahasiswa->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_mahasiswa_delete->loadRowValues($tbl_mahasiswa_delete->Recordset);

	// Render row
	$tbl_mahasiswa_delete->renderRow();
?>
	<tr <?php echo $tbl_mahasiswa->rowAttributes() ?>>
<?php if ($tbl_mahasiswa_delete->id->Visible) { // id ?>
		<td <?php echo $tbl_mahasiswa_delete->id->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_delete->RowCount ?>_tbl_mahasiswa_id" class="tbl_mahasiswa_id">
<span<?php echo $tbl_mahasiswa_delete->id->viewAttributes() ?>><?php echo $tbl_mahasiswa_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->nim->Visible) { // nim ?>
		<td <?php echo $tbl_mahasiswa_delete->nim->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_delete->RowCount ?>_tbl_mahasiswa_nim" class="tbl_mahasiswa_nim">
<span<?php echo $tbl_mahasiswa_delete->nim->viewAttributes() ?>><?php echo $tbl_mahasiswa_delete->nim->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->nama->Visible) { // nama ?>
		<td <?php echo $tbl_mahasiswa_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_delete->RowCount ?>_tbl_mahasiswa_nama" class="tbl_mahasiswa_nama">
<span<?php echo $tbl_mahasiswa_delete->nama->viewAttributes() ?>><?php echo $tbl_mahasiswa_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_mahasiswa_delete->date->Visible) { // date ?>
		<td <?php echo $tbl_mahasiswa_delete->date->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_delete->RowCount ?>_tbl_mahasiswa_date" class="tbl_mahasiswa_date">
<span<?php echo $tbl_mahasiswa_delete->date->viewAttributes() ?>><?php echo $tbl_mahasiswa_delete->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_mahasiswa_delete->Recordset->moveNext();
}
$tbl_mahasiswa_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_mahasiswa_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_mahasiswa_delete->showPageFooter();
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
$tbl_mahasiswa_delete->terminate();
?>