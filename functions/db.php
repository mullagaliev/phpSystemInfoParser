<?
/*
 * Массив с глобальныйми настройками для базы данных
 */
$GLOBALS['DB_settings'] = Array(
    'Host' => 'localhost',
    'Login' => 'usmanov',
    'Password' => 'UNQufYpLG7vMtQTh',
    'Name' => 'system_info'
);

$dbh = false;

try {
    $settings = $GLOBALS['DB_settings'];
    # MySQL через PDO_MYSQL
    $dbh = new PDO("mysql:host=".$settings['Host'].";dbname=".$settings['Name'], $settings['Login'], $settings['Password']);
}
catch(PDOException $e) {
    echo $e->getMessage();
}

/**
 * Вставить информацию о системе в базу
 * @param $arrSystemInfo - системная информация в виде массива
 * @return bool Результат вставки
 */
function insertMachineToDB($arrSystemInfo){
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO machines (`MachineId`, `SystemInformation_SystemManufacturer`, `SystemInformation_Processor`, `SystemInformation_Memory`, `DisplayDevices_CardName`) VALUES(:MachineId, :SystemInformation_SystemManufacturer, :SystemInformation_Processor, :SystemInformation_Memory, :DisplayDevices_CardName)");
    // Список параметров
    $MachineId = ""; // Обязательный параметр
    $SystemManufacturer = "";
    $Processor = "";
    $Memory = "";
    $CardName = "";
    $stmt->bindParam(':MachineId', $MachineId);
    $stmt->bindParam(':SystemInformation_SystemManufacturer', $SystemManufacturer);
    $stmt->bindParam(':SystemInformation_Processor', $Processor);
    $stmt->bindParam(':SystemInformation_Memory', $Memory);
    $stmt->bindParam(':DisplayDevices_CardName', $CardName);
    // Заполнение параметров
    if(isset($arrSystemInfo['SystemInformation'])){
        $MachineId = isset($arrSystemInfo['SystemInformation']['MachineId']) ? $arrSystemInfo['SystemInformation']['MachineId'] : '';
        $SystemManufacturer = isset($arrSystemInfo['SystemInformation']['SystemManufacturer']) ? $arrSystemInfo['SystemInformation']['SystemManufacturer'] : '';
        $Processor = isset($arrSystemInfo['SystemInformation']['Processor']) ? $arrSystemInfo['SystemInformation']['Processor'] : '';
        $Memory = isset($arrSystemInfo['SystemInformation']['Memory']) ? $arrSystemInfo['SystemInformation']['Memory'] : '';
    }
    if(isset($arrSystemInfo['DisplayDevices'])){
        $CardName = isset($arrSystemInfo['DisplayDevices']['CardName']) ? $arrSystemInfo['DisplayDevices']['CardName'] : '';
    }
    // Вставка
    return $stmt->execute();
}
?>