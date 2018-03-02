<?
require_once('functions/other.php');
require_once('functions/converter.php');
require_once('functions/db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST')
    exit('Ошибка типа запроса. Требуется запрос типа POST');
if (!isset($_FILES['INFO']) || !is_array($_FILES['INFO']))
    exit('Параметр "INFO" обязательный');

$stringSystemInfo = file_get_contents($_FILES['INFO']['tmp_name']);
$arrSystemInfo = infoToArray($stringSystemInfo);


if(isset($_REQUEST['JSON']) && $_REQUEST['JSON'] == 'Y'){
    header('Content-Type: application/json');
    echo json_encode($arrSystemInfo);
    if(json_last_error() != JSON_ERROR_NONE){
        echo "Ошибка конвертирования в JSON (Возможно у файла не верная кодировка)";
    }
}
else{
//    mpr($arrSystemInfo);
}

if(!insertMachineToDB($arrSystemInfo))
    exit('Ошибка вставки в БД. Возможно машина с таким "Machine Id" уже есть в БД.');
else
    echo "Информация о ПК успешно сохранена в БД";

?>