# public.files.manager
Редактор файлов для Битрикс из публичной части

Компонент хранить в /local/components/morozov/public.files.manager

# Быстрое разворачивание:
1. Переходим в корень Битрикс
2. 
```
mkdir -p local/components/morozov
cd local/components/morozov
wget https://github.com/MashinaMashina/public.files.manager/archive/master.zip
unzip master.zip
rm master.zip
mv public.files.manager-master public.files.manager
```
# Вызов компонента
```php
<?$APPLICATION->IncludeComponent(
	"morozov:public.files.manager", 
	".default", 
	array(
    "ACCESS_KEY" => "00000000000000000000000000000000",
		"EXTENSIONS" => "",
		"MULTIPLE" => "Y"
	),
	false
);?>
```
