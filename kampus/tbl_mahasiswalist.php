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
$tbl_mahasiswa_list = new tbl_mahasiswa_list();

// Run the page
$tbl_mahasiswa_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_mahasiswa_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_mahasiswa_list->isExport()) { ?>
<script>
var ftbl_mahasiswalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_mahasiswalist = currentForm = new ew.Form("ftbl_mahasiswalist", "list");
	ftbl_mahasiswalist.formKeyCountName = '<?php echo $tbl_mahasiswa_list->FormKeyCountName ?>';
	loadjs.done("ftbl_mahasiswalist");
});
var ftbl_mahasiswalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_mahasiswalistsrch = currentSearchForm = new ew.Form("ftbl_mahasiswalistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_mahasiswalistsrch.filterList = <?php echo $tbl_mahasiswa_list->getFilterList() ?>;
	loadjs.done("ftbl_mahasiswalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_mahasiswa_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_mahasiswa_list->TotalRecords > 0 && $tbl_mahasiswa_list->ExportOptions->visible()) { ?>
<?php $tbl_mahasiswa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->ImportOptions->visible()) { ?>
<?php $tbl_mahasiswa_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->SearchOptions->visible()) { ?>
<?php $tbl_mahasiswa_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->FilterOptions->visible()) { ?>
<?php $tbl_mahasiswa_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_mahasiswa_list->renderOtherOptions();
?>
<?php if (!$tbl_mahasiswa_list->isExport() && !$tbl_mahasiswa->CurrentAction) { ?>
<form name="ftbl_mahasiswalistsrch" id="ftbl_mahasiswalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_mahasiswalistsrch-search-panel" class="<?php echo $tbl_mahasiswa_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_mahasiswa">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_mahasiswa_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_mahasiswa_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_mahasiswa_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_mahasiswa_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_mahasiswa_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_mahasiswa_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_mahasiswa_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_mahasiswa_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $tbl_mahasiswa_list->showPageHeader(); ?>
<?php
$tbl_mahasiswa_list->showMessage();
?>
<?php if ($tbl_mahasiswa_list->TotalRecords > 0 || $tbl_mahasiswa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_mahasiswa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_mahasiswa">
<form name="ftbl_mahasiswalist" id="ftbl_mahasiswalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_mahasiswa">
<div id="gmp_tbl_mahasiswa" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_mahasiswa_list->TotalRecords > 0 || $tbl_mahasiswa_list->isGridEdit()) { ?>
<table id="tbl_tbl_mahasiswalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_mahasiswa->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_mahasiswa_list->renderListOptions();

// Render list options (header, left)
$tbl_mahasiswa_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_mahasiswa_list->id->Visible) { // id ?>
	<?php if ($tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tbl_mahasiswa_list->id->headerCellClass() ?>"><div id="elh_tbl_mahasiswa_id" class="tbl_mahasiswa_id"><div class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tbl_mahasiswa_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->id) ?>', 1);"><div id="elh_tbl_mahasiswa_id" class="tbl_mahasiswa_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_mahasiswa_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_mahasiswa_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->nim->Visible) { // nim ?>
	<?php if ($tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->nim) == "") { ?>
		<th data-name="nim" class="<?php echo $tbl_mahasiswa_list->nim->headerCellClass() ?>"><div id="elh_tbl_mahasiswa_nim" class="tbl_mahasiswa_nim"><div class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->nim->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nim" class="<?php echo $tbl_mahasiswa_list->nim->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->nim) ?>', 1);"><div id="elh_tbl_mahasiswa_nim" class="tbl_mahasiswa_nim">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->nim->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_mahasiswa_list->nim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_mahasiswa_list->nim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->nama->Visible) { // nama ?>
	<?php if ($tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $tbl_mahasiswa_list->nama->headerCellClass() ?>"><div id="elh_tbl_mahasiswa_nama" class="tbl_mahasiswa_nama"><div class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $tbl_mahasiswa_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->nama) ?>', 1);"><div id="elh_tbl_mahasiswa_nama" class="tbl_mahasiswa_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_mahasiswa_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_mahasiswa_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_mahasiswa_list->date->Visible) { // date ?>
	<?php if ($tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $tbl_mahasiswa_list->date->headerCellClass() ?>"><div id="elh_tbl_mahasiswa_date" class="tbl_mahasiswa_date"><div class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $tbl_mahasiswa_list->date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_mahasiswa_list->SortUrl($tbl_mahasiswa_list->date) ?>', 1);"><div id="elh_tbl_mahasiswa_date" class="tbl_mahasiswa_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_mahasiswa_list->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_mahasiswa_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_mahasiswa_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_mahasiswa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_mahasiswa_list->ExportAll && $tbl_mahasiswa_list->isExport()) {
	$tbl_mahasiswa_list->StopRecord = $tbl_mahasiswa_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_mahasiswa_list->TotalRecords > $tbl_mahasiswa_list->StartRecord + $tbl_mahasiswa_list->DisplayRecords - 1)
		$tbl_mahasiswa_list->StopRecord = $tbl_mahasiswa_list->StartRecord + $tbl_mahasiswa_list->DisplayRecords - 1;
	else
		$tbl_mahasiswa_list->StopRecord = $tbl_mahasiswa_list->TotalRecords;
}
$tbl_mahasiswa_list->RecordCount = $tbl_mahasiswa_list->StartRecord - 1;
if ($tbl_mahasiswa_list->Recordset && !$tbl_mahasiswa_list->Recordset->EOF) {
	$tbl_mahasiswa_list->Recordset->moveFirst();
	$selectLimit = $tbl_mahasiswa_list->UseSelectLimit;
	if (!$selectLimit && $tbl_mahasiswa_list->StartRecord > 1)
		$tbl_mahasiswa_list->Recordset->move($tbl_mahasiswa_list->StartRecord - 1);
} elseif (!$tbl_mahasiswa->AllowAddDeleteRow && $tbl_mahasiswa_list->StopRecord == 0) {
	$tbl_mahasiswa_list->StopRecord = $tbl_mahasiswa->GridAddRowCount;
}

// Initialize aggregate
$tbl_mahasiswa->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_mahasiswa->resetAttributes();
$tbl_mahasiswa_list->renderRow();
while ($tbl_mahasiswa_list->RecordCount < $tbl_mahasiswa_list->StopRecord) {
	$tbl_mahasiswa_list->RecordCount++;
	if ($tbl_mahasiswa_list->RecordCount >= $tbl_mahasiswa_list->StartRecord) {
		$tbl_mahasiswa_list->RowCount++;

		// Set up key count
		$tbl_mahasiswa_list->KeyCount = $tbl_mahasiswa_list->RowIndex;

		// Init row class and style
		$tbl_mahasiswa->resetAttributes();
		$tbl_mahasiswa->CssClass = "";
		if ($tbl_mahasiswa_list->isGridAdd()) {
		} else {
			$tbl_mahasiswa_list->loadRowValues($tbl_mahasiswa_list->Recordset); // Load row values
		}
		$tbl_mahasiswa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_mahasiswa->RowAttrs->merge(["data-rowindex" => $tbl_mahasiswa_list->RowCount, "id" => "r" . $tbl_mahasiswa_list->RowCount . "_tbl_mahasiswa", "data-rowtype" => $tbl_mahasiswa->RowType]);

		// Render row
		$tbl_mahasiswa_list->renderRow();

		// Render list options
		$tbl_mahasiswa_list->renderListOptions();
?>
	<tr <?php echo $tbl_mahasiswa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_mahasiswa_list->ListOptions->render("body", "left", $tbl_mahasiswa_list->RowCount);
?>
	<?php if ($tbl_mahasiswa_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tbl_mahasiswa_list->id->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_list->RowCount ?>_tbl_mahasiswa_id">
<span<?php echo $tbl_mahasiswa_list->id->viewAttributes() ?>><?php echo $tbl_mahasiswa_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_mahasiswa_list->nim->Visible) { // nim ?>
		<td data-name="nim" <?php echo $tbl_mahasiswa_list->nim->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_list->RowCount ?>_tbl_mahasiswa_nim">
<span<?php echo $tbl_mahasiswa_list->nim->viewAttributes() ?>><?php echo $tbl_mahasiswa_list->nim->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_mahasiswa_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $tbl_mahasiswa_list->nama->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_list->RowCount ?>_tbl_mahasiswa_nama">
<span<?php echo $tbl_mahasiswa_list->nama->viewAttributes() ?>><?php echo $tbl_mahasiswa_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_mahasiswa_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $tbl_mahasiswa_list->date->cellAttributes() ?>>
<span id="el<?php echo $tbl_mahasiswa_list->RowCount ?>_tbl_mahasiswa_date">
<span<?php echo $tbl_mahasiswa_list->date->viewAttributes() ?>><?php echo $tbl_mahasiswa_list->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_mahasiswa_list->ListOptions->render("body", "right", $tbl_mahasiswa_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_mahasiswa_list->isGridAdd())
		$tbl_mahasiswa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_mahasiswa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_mahasiswa_list->Recordset)
	$tbl_mahasiswa_list->Recordset->Close();
?>
<?php if (!$tbl_mahasiswa_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_mahasiswa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_mahasiswa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_mahasiswa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_mahasiswa_list->TotalRecords == 0 && !$tbl_mahasiswa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_mahasiswa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_mahasiswa_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_mahasiswa_list->isExport()) { ?>
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
$tbl_mahasiswa_list->terminate();
?>