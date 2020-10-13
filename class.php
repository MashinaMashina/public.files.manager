<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\IO\Directory;

class CMorozovPublicFilesManager extends CBitrixComponent
{
	protected function showEditArea()
	{
		global $APPLICATION, $componentPath;
		
		if ($APPLICATION->GetShowIncludeAreas())
		{
			/*
			$curFile = urlencode(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']));
			
			$popupLink = $APPLICATION->GetPopupLink(Array(
				"URL"=> "{$this->__path}/fileEditor.php?file={$curFile}",
				"PARAMS" => Array(
					"width" => 780,
					"height" => 570,
					"resizable" => true,
					"min_width" => 780,
					"min_height" => 400
					)
				)
			);
			
			$arIcons = Array();
			$arIcons[] =
			Array(
				"URL" => "javascript:{$popupLink}",
				"SRC" => $this->__path . "/images/edit-files.png",
				"ALT" => "Управление списком файлов"
			);

			echo $APPLICATION->IncludeString('', $arIcons);
			*/
			
			$files = array_column($this->getUploadedFiles(), 'ID');
			include __DIR__ . '/form.php';
		}
	}
	
	protected function getCacheFilename()
	{
		static $filename;
		
		if (! isset($filename))
		{
			$curFile = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/public.files.manager/' . dirname($curFile);
			$file = md5($curFile . $this->arParams['ACCESS_KEY']);
			
			if (! file_exists($dir))
			{
				Directory::createDirectory($dir);
			}
			
			$filename = "{$dir}/{$file}";
		}
		
		return $filename;
	}
	
	protected function getPostFiles($filesIds)
	{
		if (!is_array($filesIds))
			$filesIds = [$filesIds];
		
		$result = [];
		foreach ($filesIds as $id)
		{
			$result[] = CFile::GetFileArray($id);
		}
		
		return $result;
	}
	
	protected function getUploadedFiles()
	{
		$filename = $this->getCacheFilename();
		$data = file_get_contents($filename);
		$files = json_decode($data, true);
		
		return $files;
	}
	
	protected function enableEditor()
	{
		if (check_bitrix_sessid())
		{
			$filename = $this->getCacheFilename();
			$files = $this->getPostFiles($_POST["PUBLIC_FILES_MANAGER"]);
			
			file_put_contents($filename, json_encode($files));
		}
		
		$this->showEditArea();
	}
	
	public function executeComponent(...$a)
	{
		global $USER;
		
		if (array_intersect($this->arParams['GROUPS_ACCESS'], $USER->GetUserGroupArray()))
		{
			$this->enableEditor();
		}
		
		$this->arResult['FILES'] = $this->getUploadedFiles();
		$this->includeComponentTemplate();
	}
}