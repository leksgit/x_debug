# x_debug
A small helper for debugging php

It is based on developments https://github.com/exfriend

## x_debug()

функция включает вывод всех ошибок и устанавливает необходимые параметры для вывода, необходимо вызывать сразу после подключения файла отладки.

Function includes the output of all errors and sets the necessary parameters for output, It is necessary to call immediately after connecting the debug file.
                        
## xprint($var, $title)

функция получает переменную и выводит её в читаемом виде на экран, необязательный параметр $title - можно передавать любой текст который озаглавит вывод переменной. По умолчанию - 'Отладочная информация'

Function receives a variable and displays it in a readable form on the screen, Optional parameter $ title - you can pass any text that will title the output of the variable. The default is 'Debug information'

## xvprint($var)
то же что и xprint но дополнительно выводит название переменно, файл и строку где вызывается функция !!! на входе может принимать исключительно строку!!!

The same as xprint but additionally outputs the variable name, file and string where the function is called !!! At the input can only take a line !!!
                        
## xd($var)
то же что и xprint но после вывода останавливает работу всего скрипта
The same as xprint but after the output stops the whole script

## xstop()
останавливает процес исполнения скрипта выводит 'Процесс остановлен!', файл и строку где вызывается функция
Stops the execution of the script displays 'Process is stopped!', The file and the string where the function is called
