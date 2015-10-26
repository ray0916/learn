<?php

/**
 * spl迭代器
 * 迭代器的方法中都会包括下面几种方法：
 * current(): 当前节点
 * key(): 当前节点的索引值
 * next(): 指针移到下一个节点
 * rewind(): 回到初始节点
 * valid(): 判断指针后面是否有节点
 *
 */




echo '--------------------------------- ArrayIterator START --------------------------------',"\n";
/**
 * ArrayIterator类 、ArrayObject类、RecursiveArrayIterator类、RecursiveIteratorIterator类
 *
 * ArrayObject类 将数组变成对象object，但是不支持遍历
 * ArrayIterator类 可以对数组进行遍历, 支持offset放方法
 *
 * 但是ArrayObject和ArrayIterator只支持遍历一维数组。
 * 如果要支持多维数组，便用RecursiveArrayIterator生成一个Iterator。然后再说对这个Iterator使用RecursiveIteratorIterator
 *
 */
$array = array('value1', 'value3', 'value2', 'value4', 'value5');

try {
    $object = new ArrayIterator($array);

    // 判断第二个节点是否存在
    if ($object->offsetExists(2)) {
        // 给第二个节点赋新值
        $object->offsetSet(2, 'value2_1');
    }

    // 在数组最后插入新值
    $object->append('value_6');

    // 自然排序排序 natsort(): 数组进行自然排序; natcasesort():对数组进行自然排序，并不区分大小写
    // uasort(): uksort(): 通过在参数中传递已定义的排序方式进行排序；
    $object->natsort();

    // 检查key为3所对应的值
    $object->offsetGet(3);
    // 销毁key为3的值
    $object->offsetUnset(3);

    // 指针跳转到第5个节点
    $object->seek(4);

    // foreach 循环
    /**
     * 如下的写法经调试出现了一个bug。
     * 当在循环中进行offsetUnset时，此时，当前指针会回跳会第一个节点，即$object->key()的值为0，但是此时循环的key值和value值并没有变，依然是3=>value4。
     * 而再次foreach循环之前，$object->key()值为0.循环后，$object->key()为1，所有，此时循环重复值。
     */
    foreach ($object AS $key => $value) {
        echo '<li>'.$key.'=>'.$value.'</li>'."\n";
    }

    // while 循环
    $object->rewind();
    while ($object->valid()) {
        echo $object->current();
        $object->next();
    }

    // setFlags 设置行为标记 0或1
    // getFlags 获得行为标记
    //$object->setFlags();

    // 将数组复制，如果已知的数组是一个arrayIterator的对象，那么复制返回的依然是数组
    //$array_copy = $object->getArrayCopy($array);

    $array1 = array(
        array('name'=>'butch', 'sex'=>'m', 'breed'=>'boxer'),
        array('name'=>'fido', 'sex'=>'m', 'breed'=>'doberman'),
        array('name'=>'girly','sex'=>'f', 'breed'=>'poodle')
    );

    foreach(new RecursiveIteratorIterator(new RecursiveArrayIterator($array1)) as $key => $value)
    {
        echo $key.' -- '.$value.'<br />';
    }


} catch (Exception $e) {
    echo $e->getMessage();
}
echo '--------------------------------- ArrayIterator END-----------------------------------', '<br />';

echo '--------------------------------- FilterIterator START-----------------------------------', '<br />';

/**
 * FilterIterator  遍历并过滤不想要的值。在accept()方法中设置过滤条件即可
 */

// 返回质数
class PrimeFilter extends FilterIterator
{
    public function __construct(Iterator $it)
    {
        parent::__construct($it);
    }

    /**
     * 判断是否为质数
     * 算法说明：一个合数的成熟，总有一个数是小于该合数的平方根的，比如100，可以1*100，2*50…… 10*10。所有可以根据这个理论来判断是否为质数。
     * 对质数求平方根x，然后再进行循环判断，小于平方根x且不能被该数整除的数即为质数。
     *
     * 而又可以进一步进行分析，所有的数都可以分为奇数和偶数，可以先除以2，筛选出一半的数，再除以3，又可以筛选出更多的数……
     * 以此类推，可以将不是质数的数全部筛选出去。
     */
    function accept()
    {
        if ($this->current() % 2 == 0 || $this->current() <= 1) {
            return false;
        }

        $d = 3;
        $x = sqrt($this->current());

        while ($this->current() % $d != 0 && $d < $x) {
            $d += 2;
        }

        return $this->current() % $d == 0 && $this->current() != $d ? false : true;
    }
}

// 获得数组
$numbers = range(0, 1000);

// 创建FilterIterator
$primes = new PrimeFilter(new ArrayIterator($numbers));

foreach ($primes AS $value) {
    //echo $value.' is prime.<br />';
}

echo '--------------------------------- FilterIterator END-----------------------------------', '<br />';

echo '--------------------------------- SimpleXMLIterator START-----------------------------------', '<br />';

/**
 * SimpleXMLIterator 遍历xml文件
 *
 */
try {
    $sxi = new SimpleXMLIterator();
}





echo '--------------------------------- SimpleXMLIterator END-----------------------------------', '<br />';


