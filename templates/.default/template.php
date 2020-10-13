<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
Файлы:<br />
<? foreach ($arResult['FILES'] as $arFile): ?>
	<a href="<?=$arFile['SRC']?>"><?=htmlspecialchars($arFile['ORIGINAL_NAME'])?></a><br />
<? endforeach; ?>