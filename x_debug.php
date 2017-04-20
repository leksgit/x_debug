<?php
/**
 * Created by PhpStorm.
 * User: leksgit
 * Date: 20.10.2015
 * Time: 12:58
 * x_debug()            -  функция включает вывод всех ошибок и устанавливает необходимые параметры для вывода,
 *                         необходимо вызывать сразу после подключения файла отладки.
 *
 * xprint($var, $title) -  функция получает переменную и выводит её в читаемом виде на экран,
 *                         необязательный параметр $title - можно передавать любой текст который озаглавит вывод переменной.
 *                         По умолчанию - 'Отладочная информация'
 *
 * xvprint($var)        -  то же что и xprint но дополнительно выводит название переменно, файл и строку где вызывается функция
 *                         !!! на входе может принимать исключительно строку!!!
 *
 * xd($var)             -  то же что и xprint но после вывода останавливает работу всего скрипта
 *
 * xstop()              -  останавливает процес исполнения скрипта выводит 'Процесс остановлен!', файл и строку где вызывается функция
 */

function x_debug(){

    ini_set("display_errors","1");
    ini_set("display_startup_errors","1");
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
    ini_set('xdebug.var_display_max_depth', 50);
    ini_set('xdebug.var_display_max_children', 25600);
    ini_set('xdebug.var_display_max_data', 9999999999);
}

function xprint($param, $title = 'Debug')
{
    if (PHP_SAPI == 'cli') {
        //  echo "<pre>";
        echo "\n---------------[ $title ]---------------\n";
        echo print_r($param, true);
        echo "\n-------------------------------------------\n";
    } else {
        $vardeb = debug_backtrace();
        if($title == 'Debug' or $title == 'Debug STOP!'){
            ?>
            <div
                style = "padding:10px 10px 10px 10px;margin-bottom:25px;color:black;background:#f6f6f6;position:relative;top:18px;border:1px solid gray;font-size:11px;font-family:Monospace;width:80%;">
            <div
                style = "padding-top:1px;padding-left: 10px;color:#000;background:#ddd;position:relative;top:-18px;height:15px;;border:1px solid gray;font-family:Monospace"><?= $title ?></div>
            <pre style = "color:#000;"><?= htmlspecialchars(print_r($param, true)); ?></pre>
            </div><?php
        }else{
            ?>
            <div
                style = "padding:10px 10px 10px 10px;margin-bottom:25px;color:black;background:#f6f6f6;position:relative;top:18px;border:1px solid gray;font-size:11px;font-family:Monospace;width:80%;">
            <div
                style = "padding-top:1px;padding-left: 10px;color:#000;background:#ddd;position:relative;top:-18px;height:30px;;border:1px solid gray;font-family:Monospace">
                <?= 'Debug ' . 'Var: ' . $title . "<br/>" .  'File: ' . $vardeb[0]['file'] . ' Line: ' . $vardeb[0]['line'];?></div>
            <pre style = "color:#000;"><?= htmlspecialchars(print_r($param, true));    ?></pre>
            </div><?php
        }

    }
}

function xvprint( &$var, $scope=false, $prefix='unique', $suffix='value'){
    if($scope)
        $vals = $scope;
    else
        $vals = $GLOBALS;
    $old = $var;

    $var = $new = $prefix.rand().$suffix;
    $vname = FALSE;
    foreach($vals as $key => $val) {
        if($val === $new) $vname = $key;
    }
    $var = $old;
    xprint($var, $vname);
}

function xd($param)
{
    xprint($param);
    die();
}

function xstop()
{
    $vardeb = debug_backtrace();
    $var = 'File: ' . $vardeb[0]['file'] . ' Line: ' . $vardeb[0]['line'];
    xprint($var,'Debug STOP!');
    die();
}