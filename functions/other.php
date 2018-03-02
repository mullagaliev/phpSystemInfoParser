<?
/**
 * Функция для отображения структуры объекта
 * @param array $obj - объект
 */
function mpr($obj = Array())
{
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';
}

/**
 * Функция для удаления переносов и пробелов до и после строки
 * @param $str - строка для форматирования
 * @return string - строка без символов переносов и пробелов на концах
 */
function trim2($str)
{
    return trim(preg_replace('/\s+/', ' ', $str));
}

function toKey($str)
{
    return preg_replace('/\s+/', '', ucwords(trim2($str)));
}

?>