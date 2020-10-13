<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<form action="" method="POST">
	<input type="hidden" name="sessid" value="<?=bitrix_sessid()?>">
	<?$APPLICATION->IncludeComponent("bitrix:main.file.input", "drag_n_drop",
		array(
			"INPUT_NAME"=>"PUBLIC_FILES_MANAGER",
			"MULTIPLE"=>$this->arParams['MULTIPLE'],
			"MODULE_ID"=>"main",
			"MAX_FILE_SIZE"=>"",
			"ALLOW_UPLOAD"=>"A", 
			"ALLOW_UPLOAD_EXT"=>$this->arParams['EXTENSIONS'],
			"INPUT_CAPTION" => "Добавить файл",
			"INPUT_VALUE" => $files,
		),
		false
	);?>
	<input type="submit" value="Отправить">
</form>