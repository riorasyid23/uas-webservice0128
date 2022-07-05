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
$tbl_mahasiswa_view = new tbl_mahasiswa_view();

// Run the page
$tbl_mahasiswa_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_mahasiswa_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_mahasiswa_view->isExport()) { ?>
<script>
var ftbl_mahasiswaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_mahasiswaview = currentForm = new ew.Form("ftbl_mahasiswaview", "view");
	loadjs.done("ftbl_mahasiswaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_mahasiswa_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_mahasiswa_view->ExportOptions->render("body") ?>
<?php $tbl_mahasiswa_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_mahasiswa_view->showPageHeader(); ?>
<?php
$tbl_mahasiswa_view->showMessage();
?>
<form name="ftbl_mahasiswaview" id="ftbl_mahasiswaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_mahasiswa">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_mahasiswa_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_mahasiswa_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tbl_mahasiswa_view->TableLeftColumnClass ?>"><span id="elh_tbl_mahasiswa_id"><?php echo $tbl_mahasiswa_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tbl_mahasiswa_view->id->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_id">
<span<?php echo $tbl_mahasiswa_view->id->viewAttributes() ?>><?php echo $tbl_mahasiswa_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_mahasiswa_view->nim->Visible) { // nim ?>
	<tr id="r_nim">
		<td class="<?php echo $tbl_mahasiswa_view->TableLeftColumnClass ?>"><span id="elh_tbl_mahasiswa_nim"><?php echo $tbl_mahasiswa_view->nim->caption() ?></span></td>
		<td data-name="nim" <?php echo $tbl_mahasiswa_view->nim->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_nim">
<span<?php echo $tbl_mahasiswa_view->nim->viewAttributes() ?>><?php echo $tbl_mahasiswa_view->nim->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_mahasiswa_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $tbl_mahasiswa_view->TableLeftColumnClass ?>"><span id="elh_tbl_mahasiswa_nama"><?php echo $tbl_mahasiswa_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $tbl_mahasiswa_view->nama->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_nama">
<span<?php echo $tbl_mahasiswa_view->nama->viewAttributes() ?>><?php echo $tbl_mahasiswa_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_mahasiswa_view->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $tbl_mahasiswa_view->TableLeftColumnClass ?>"><span id="elh_tbl_mahasiswa_date"><?php echo $tbl_mahasiswa_view->date->caption() ?></span></td>
		<td data-name="date" <?php echo $tbl_mahasiswa_view->date->cellAttributes() ?>>
<span id="el_tbl_mahasiswa_date">
<span<?php echo $tbl_mahasiswa_view->date->viewAttributes() ?>><?php echo $tbl_mahasiswa_view->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_mahasiswa_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_mahasiswa_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tbl_mahasiswa_view->terminate();
?>