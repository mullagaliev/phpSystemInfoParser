<?php
/**
 * Функция преообразования строки в массив свойств ПК
 * @param $str - содержимое файла в одной строке
 * @return array - массив свойсв ПК, разбиты по группам свойств
 */
function infoToArray($str)
{
    $arrGroupsName = Array();
    $regFindGroups = '/([-]+\s+(.*)\s+[-]+)/m';
    preg_match_all($regFindGroups, $str, $arrGroupsName);
    $arrGroupsName = $arrGroupsName[2];

    $arrGroups = preg_split($regFindGroups, $str, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($arrGroups as $groupId => $strGroupContent) {
        // Убираем перенос строки из названий груп
        $newKey = toKey($arrGroupsName[$groupId]);
        $newValue = Array();
        $arrValues = preg_split("/\n/", $strGroupContent, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($arrValues as $valueId => $strValueContent) {
            $arrValue = preg_split("/:/", $strValueContent, 2, PREG_SPLIT_NO_EMPTY);
            if (count($arrValue) == 2) {
                $newKeyValue = toKey($arrValue[0]);
                $newValueValue = $arrValue[1];
//                if (isset($arrValues[$newKeyValue])) {
//                    $newKeyValue .= " ".md5($newValueValue);
//                }
                $arrValues[$newKeyValue] = trim2($newValueValue);
            }
            unset($arrValues[$valueId]);
        }
        $arrGroups[$newKey] = $arrValues;
        unset($arrGroups[$groupId]);
    }
    return $arrGroups;
}

?>