<?php

// Закрытый ключ
// Множественная загрузка
// Типы файлов
// Группы пользователей

$rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", array("=ACTIVE"=>'Y'));

$arUsersGroups = [];
while($arGroups = $rsGroups->Fetch())
{
	$arUsersGroups[$arGroups['ID']] = $arGroups['NAME'];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"GROUPS_ACCESS" => array(
			"PARENT" => "BASE",
			"NAME" => "Кому можно редактировать файлы",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arUsersGroups,
		),
		"ACCESS_KEY" => array(
			"PARENT" => "BASE",
			"NAME" => "Уникальный вызов компонента",
			"TYPE" => "STRING",
			"DEFAULT" => md5(uniqid()),
		),
		"EXTENSIONS" => array(
			"PARENT" => "BASE",
			"NAME" => "Разрешенные расширения документов",
			"TYPE" => "STRING",
			"DEFAULT" => 'xls,xlsx,ppt,pptx,doc,docx,png,jpeg,jpg,gif',
		),
		"MULTIPLE" => array(
			"PARENT" => "BASE",
			"NAME" => "Множественная загрузка",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),
		
	)
);