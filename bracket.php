#!/usr/bin/env php
<?php

class Bracket
{
    private $_brackets = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
    ];

    /**
     * Конструктор
     */
    public function __construct(){
        // Получаем строку
        $stdin = $this->getSTDIN();
        // Проводим валидацию
        $stdin = $this->validation($stdin);

        // Проверяем соответствие скобок
        $this->pr( $this->checked($stdin)? 'Ok': 'Wrong', '' );
    }

    /**
     * Получаем строку
     * @return string
     */
    protected function getSTDIN(){
        echo 'Enter string:';
        return str_replace("\n", '', fgets(STDIN));
    }

    /**
     * Валидация значений
     */
    protected function validation($str){
        // Удаляем лишние символы
        $search = '\\'.implode('\\',array_merge($this->_brackets, array_flip($this->_brackets)));
        $str = preg_replace('#[^'.$search.']#', '', $str);

        // Проверяем на пустоту
        if(empty($str)){
            $this->pr('String empty');
        }

        // Если не четное, то уже не верно
        if(strlen($str)%2 == 1){
            $this->pr('Wrong', '');
        }
        return $str;
    }

    /**
     * Вывод сообщения об ошибке
     * @param $str
     */
    protected function pr($str, $type='Error! '){
        exit($type . $str."\n");
    }

    /**
     * Проверяем соответствие скобок
     * @param $str
     * @return bool
     */
    protected function checked($str)
    {
        $revers = array_flip($this->_brackets);
        $stack = [];
        $stack_size = 0;
        for($i=0; $i<strlen($str); $i++)
        {
            if ( in_array($str{$i}, array_values($revers)) )
                $stack[$stack_size++] = $str{$i};
            else if ( in_array($str{$i}, array_keys($revers)) )
            {
                $last = $stack_size? $stack[$stack_size-1] : '';
                if ($last != $revers[$str{$i}])
                    return false;
                else
                    unset($stack[--$stack_size]);
            }
        }
        return count($stack)==0;
    }
}

new Bracket();