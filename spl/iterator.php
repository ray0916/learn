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

echo '---------------------------------  DirectoryIterator START-----------------------------------', '<br />';

/**
 * DirectoryIterator 查看目录文件或内容
 */
$directoryIt = new DirectoryIterator('/data/www');

// 查看该目录下的文件
echo '<table>';
foreach ($directoryIt AS $item) {
    //echo $item, '<br />';
    if ($item->getFilename() == 'index.php') {
        // 查看文件的详细信息
        /*echo '<tr><td>getFilename()</td><td> '; var_dump($item->getFilename()); echo '</td></tr>';
        echo '<tr><td>getBasename()</td><td> '; var_dump($item->getBasename()); echo '</td></tr>';
        echo '<tr><td>isDot()</td><td> '; var_dump($item->isDot()); echo '</td></tr>';
        echo '<tr><td>__toString()</td><td> '; var_dump($item->__toString()); echo '</td></tr>';
        echo '<tr><td>getPath()</td><td> '; var_dump($item->getPath()); echo '</td></tr>';
        echo '<tr><td>getPathname()</td><td> '; var_dump($item->getPathname()); echo '</td></tr>';
        echo '<tr><td>getPerms()</td><td> '; var_dump($item->getPerms()); echo '</td></tr>'; // 获得当前文件的权限
        echo '<tr><td>getInode()</td><td> '; var_dump($item->getInode()); echo '</td></tr>'; // 获得当前文件的索引节点
        echo '<tr><td>getSize()</td><td> '; var_dump($item->getSize()); echo '</td></tr>';
        echo '<tr><td>getOwner()</td><td> '; var_dump($item->getOwner()); echo '</td></tr>';
        echo '<tr><td>$file->getGroup()</td><td> '; var_dump($item->getGroup()); echo '</td></tr>';
        echo '<tr><td>getATime()</td><td> '; var_dump($item->getATime()); echo '</td></tr>';
        echo '<tr><td>getMTime()</td><td> '; var_dump($item->getMTime()); echo '</td></tr>';
        echo '<tr><td>getCTime()</td><td> '; var_dump($item->getCTime()); echo '</td></tr>';
        echo '<tr><td>getType()</td><td> '; var_dump($item->getType()); echo '</td></tr>';
        echo '<tr><td>isWritable()</td><td> '; var_dump($item->isWritable()); echo '</td></tr>';
        echo '<tr><td>isReadable()</td><td> '; var_dump($item->isReadable()); echo '</td></tr>';
        echo '<tr><td>isExecutable(</td><td> '; var_dump($item->isExecutable()); echo '</td></tr>';
        echo '<tr><td>isFile()</td><td> '; var_dump($item->isFile()); echo '</td></tr>';
        echo '<tr><td>isDir()</td><td> '; var_dump($item->isDir()); echo '</td></tr>';
        echo '<tr><td>isLink()</td><td> '; var_dump($item->isLink()); echo '</td></tr>';
        echo '<tr><td>getFileInfo()</td><td> '; var_dump($item->getFileInfo()); echo '</td></tr>';
        echo '<tr><td>getPathInfo()</td><td> '; var_dump($item->getPathInfo()); echo '</td></tr>';
        echo '<tr><td>openFile()</td><td> '; var_dump($item->openFile()); echo '</td></tr>';
        echo '<tr><td>setFileClass()</td><td> '; var_dump($item->setFileClass()); echo '</td></tr>';
        echo '<tr><td>setInfoClass()</td><td> '; var_dump($item->setInfoClass()); echo '</td></tr>';*/
    }
}
echo '</table>';

// while 循环
$directoryIt->rewind();
while ($directoryIt->valid()) {
    // 过滤 . 和 ..
    if (!$directoryIt->isDot()) {
        echo $directoryIt->key(), '=>', $directoryIt->current(), '<br />';
    }
    $directoryIt->next();
}


// 获得该目录的所有文件和下级文件夹的文件
/*$rdIt = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/data/www/yii2/learn/backend'));
foreach ($rdIt AS $name => $object) {
    echo $object.'<br/>';
}*/

echo '----------------------------------- DirectoryIterator END ---------------------------------', '<br />';

echo '--------------------------------- SimpleXMLIterator START-----------------------------------', '<br />';

/**
 * SimpleXMLIterator 遍历xml文件
 *
 */
try {
    $xmlString = file_get_contents('spl.xml');

    $simpleIt = new SimpleXMLIterator($xmlString);
    // 循环所有的节点
    foreach (new RecursiveIteratorIterator($simpleIt,1) as $name => $data) {
        //echo $name, '=>', $data, "<br />";
    }

    // while 循环
    $simpleIt->rewind();
    while ($simpleIt->valid()) {
        /*var_dump($simpleIt->key());
        echo '=>';
        var_dump($simpleIt->current());*/

        // getChildren() 获得当前节点的子节点
        if ($simpleIt->hasChildren()) {
            //var_dump($simpleIt->getChildren());
        }
        $simpleIt->next();
    }

    // xpath 可以通过path直接获得指定节点的值
    var_dump($simpleIt->xpath('animal/category/species'));



} catch (Exception $e) {
    echo $e->getMessage();
}

echo '--------------------------------- SimpleXMLIterator END-----------------------------------', '<br />';

echo '--------------------------------- CachingIterator START-----------------------------------', '<br />';

/**
 * CachingIterator 提前读取一个元素
 * 可以用于确定当前元素是否为最后一个元素
 */
$array = array('koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'kiwi', 'kookaburra', 'platypus');


try {
    $cachingIt = new CachingIterator(new ArrayIterator($array));
    foreach ($cachingIt AS $item) {
        echo $item;
        if ($cachingIt->hasNext()) {
            echo ',';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

echo '----------------------------------- CachingIterator END ---------------------------------', '<br />';

echo '--------------------------------- LimitIterator END-----------------------------------', '<br />';

/**
 * LimitIterator 遍历一个Iterator的限定子集
 * 在__construct有两个可选参数：offset 和 count
 */
$array = array('apple', 'banana', 'cherry', 'damson', 'elderberry');
$fruits = new ArrayIterator($array);
$offset = 3;$count = 2;
$limitIt = new LimitIterator($fruits, $offset, $count);
// 如果增加了offset，那么只有两个数，但是rewind时，节点值不会变成0，而是被截取的值offset。
// getPosition 获得当前节点的位置
$limitIt->rewind();
var_dump($limitIt->getPosition());

foreach ($limitIt AS $item) {
    echo $item, '<br />';
}

echo '--------------------------------- LimitIterator START-----------------------------------', '<br />';

echo '----------------------------------- SplFileObject END ---------------------------------', '<br />';
/**
 * SplFileObject 对文本文件进行遍历
 */

$file = '/data/www/test.php';
$fileIt = new SplFileObject($file);
// 遍历获得所有的文本，按行遍历
/*foreach ($fileIt AS $item) {
    echo $item, '<br />';
}*/

// 返回第几行
$fileIt->seek(5);
echo $fileIt->current();
echo '<br />';

echo '--------------------------------- SplFileObject END-----------------------------------', '<br />';

echo '--------------------------------- InfiniteIterator START-----------------------------------', '<br />';

/**
 * infiniteIterator 对一个迭代进行无限循环输出
 */

$obj = new stdClass();
$obj->Mon = "Monday";
$obj->Tue = "Tuesday";
$obj->Wed = "Wednesday";
$obj->Thu = "Thursday";
$obj->Fri = "Friday";
$obj->Sat = "Saturday";
$obj->Sun = "Sunday";

$infinate = new InfiniteIterator(new ArrayIterator($obj));
foreach ( new LimitIterator($infinate, 0, 14) as $value ) {
    print($value . PHP_EOL);
}

echo '----------------------------------- InfiniteIterator END ---------------------------------', '<br />';

echo '--------------------------------- RecursiveTreeIterator END-----------------------------------', '<br />';
/**
 * RecursiveTreeIterator 已可视的方式显示一个树形结构
 */

$array = array("a" => "lemon", "b" => "orange", array("a" => "apple", "p" => "pear"));
$rtreeIt = new RecursiveTreeIterator(new RecursiveArrayIterator($array), null, null, RecursiveIteratorIterator::LEAVES_ONLY );
foreach ($rtreeIt AS $item){
    echo $item;
}

echo '--------------------------------- RecursiveTreeIterator START-----------------------------------', '<br />';

echo '----------------------------------- MultipleIterator  END ---------------------------------', '<br />';

/**
 * MultipleIterator  用于迭代器的连接器
 * 预定义常量：
 * MultipleIterator::MIT_NEED_ANY  不需要所有的子迭代作为有用的节点. 不能设置键值。默认数字键值
 * MultipleIterator::MIT_NEED_ALL  所有的子节点都是有用的迭代. 不能设置键值。默认数字键值
 * MultipleIterator::MIT_KEYS_NUMERIC 将子节点的位置作为键值key. 不能设置键值。默认数字键值
 * MultipleIterator::MIT_KEYS_ASSOC 为子迭代增加键值.使用attachIterator，可以为每一个设置键值
 *
 */
$person_id = new ArrayIterator(array('001', '002', '003'));
$person_name = new ArrayIterator(array('name1', 'name2', 'name3'));
$person_age = new ArrayIterator(array(22, 23, 11));
$persons = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);

$persons->attachIterator($person_id, "ID");
$persons->attachIterator($person_name, "NAME");
$persons->attachIterator($person_age, "AGE");

foreach ($persons AS $person) {
    var_dump($person);
}

echo '--------------------------------- MultipleIterator  END-----------------------------------', '<br />';
































