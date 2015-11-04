<?php

/**
 * spl������
 * �������ķ����ж���������漸�ַ�����
 * current(): ��ǰ�ڵ�
 * key(): ��ǰ�ڵ������ֵ
 * next(): ָ���Ƶ���һ���ڵ�
 * rewind(): �ص���ʼ�ڵ�
 * valid(): �ж�ָ������Ƿ��нڵ�
 *
 */




echo '--------------------------------- ArrayIterator START --------------------------------',"\n";
/**
 * ArrayIterator�� ��ArrayObject�ࡢRecursiveArrayIterator�ࡢRecursiveIteratorIterator��
 *
 * ArrayObject�� �������ɶ���object�����ǲ�֧�ֱ���
 * ArrayIterator�� ���Զ�������б���, ֧��offset�ŷ���
 *
 * ����ArrayObject��ArrayIteratorֻ֧�ֱ���һά���顣
 * ���Ҫ֧�ֶ�ά���飬����RecursiveArrayIterator����һ��Iterator��Ȼ����˵�����Iteratorʹ��RecursiveIteratorIterator
 *
 */
$array = array('value1', 'value3', 'value2', 'value4', 'value5');

try {
    $object = new ArrayIterator($array);

    // �жϵڶ����ڵ��Ƿ����
    if ($object->offsetExists(2)) {
        // ���ڶ����ڵ㸳��ֵ
        $object->offsetSet(2, 'value2_1');
    }

    // ��������������ֵ
    $object->append('value_6');

    // ��Ȼ�������� natsort(): ���������Ȼ����; natcasesort():�����������Ȼ���򣬲������ִ�Сд
    // uasort(): uksort(): ͨ���ڲ����д����Ѷ��������ʽ��������
    $object->natsort();

    // ���keyΪ3����Ӧ��ֵ
    $object->offsetGet(3);
    // ����keyΪ3��ֵ
    $object->offsetUnset(3);

    // ָ����ת����5���ڵ�
    $object->seek(4);

    // foreach ѭ��
    /**
     * ���µ�д�������Գ�����һ��bug��
     * ����ѭ���н���offsetUnsetʱ����ʱ����ǰָ���������һ���ڵ㣬��$object->key()��ֵΪ0�����Ǵ�ʱѭ����keyֵ��valueֵ��û�б䣬��Ȼ��3=>value4��
     * ���ٴ�foreachѭ��֮ǰ��$object->key()ֵΪ0.ѭ����$object->key()Ϊ1�����У���ʱѭ���ظ�ֵ��
     */
    foreach ($object AS $key => $value) {
        echo '<li>'.$key.'=>'.$value.'</li>'."\n";
    }

    // while ѭ��
    $object->rewind();
    while ($object->valid()) {
        echo $object->current();
        $object->next();
    }

    // setFlags ������Ϊ��� 0��1
    // getFlags �����Ϊ���
    //$object->setFlags();

    // �����鸴�ƣ������֪��������һ��arrayIterator�Ķ�����ô���Ʒ��ص���Ȼ������
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
 * FilterIterator  ���������˲���Ҫ��ֵ����accept()���������ù�����������
 */

// ��������
class PrimeFilter extends FilterIterator
{
    public function __construct(Iterator $it)
    {
        parent::__construct($it);
    }

    /**
     * �ж��Ƿ�Ϊ����
     * �㷨˵����һ�������ĳ��죬����һ������С�ڸú�����ƽ�����ģ�����100������1*100��2*50���� 10*10�����п��Ը�������������ж��Ƿ�Ϊ������
     * ��������ƽ����x��Ȼ���ٽ���ѭ���жϣ�С��ƽ����x�Ҳ��ܱ���������������Ϊ������
     *
     * ���ֿ��Խ�һ�����з��������е��������Է�Ϊ������ż���������ȳ���2��ɸѡ��һ��������ٳ���3���ֿ���ɸѡ�������������
     * �Դ����ƣ����Խ�������������ȫ��ɸѡ��ȥ��
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

// �������
$numbers = range(0, 1000);

// ����FilterIterator
$primes = new PrimeFilter(new ArrayIterator($numbers));

foreach ($primes AS $value) {
    //echo $value.' is prime.<br />';
}

echo '--------------------------------- FilterIterator END-----------------------------------', '<br />';

echo '---------------------------------  DirectoryIterator START-----------------------------------', '<br />';

/**
 * DirectoryIterator �鿴Ŀ¼�ļ�������
 */
$directoryIt = new DirectoryIterator('/data/www');

// �鿴��Ŀ¼�µ��ļ�
echo '<table>';
foreach ($directoryIt AS $item) {
    //echo $item, '<br />';
    if ($item->getFilename() == 'index.php') {
        // �鿴�ļ�����ϸ��Ϣ
        /*echo '<tr><td>getFilename()</td><td> '; var_dump($item->getFilename()); echo '</td></tr>';
        echo '<tr><td>getBasename()</td><td> '; var_dump($item->getBasename()); echo '</td></tr>';
        echo '<tr><td>isDot()</td><td> '; var_dump($item->isDot()); echo '</td></tr>';
        echo '<tr><td>__toString()</td><td> '; var_dump($item->__toString()); echo '</td></tr>';
        echo '<tr><td>getPath()</td><td> '; var_dump($item->getPath()); echo '</td></tr>';
        echo '<tr><td>getPathname()</td><td> '; var_dump($item->getPathname()); echo '</td></tr>';
        echo '<tr><td>getPerms()</td><td> '; var_dump($item->getPerms()); echo '</td></tr>'; // ��õ�ǰ�ļ���Ȩ��
        echo '<tr><td>getInode()</td><td> '; var_dump($item->getInode()); echo '</td></tr>'; // ��õ�ǰ�ļ��������ڵ�
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

// while ѭ��
$directoryIt->rewind();
while ($directoryIt->valid()) {
    // ���� . �� ..
    if (!$directoryIt->isDot()) {
        echo $directoryIt->key(), '=>', $directoryIt->current(), '<br />';
    }
    $directoryIt->next();
}


// ��ø�Ŀ¼�������ļ����¼��ļ��е��ļ�
/*$rdIt = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/data/www/yii2/learn/backend'));
foreach ($rdIt AS $name => $object) {
    echo $object.'<br/>';
}*/

echo '----------------------------------- DirectoryIterator END ---------------------------------', '<br />';

echo '--------------------------------- SimpleXMLIterator START-----------------------------------', '<br />';

/**
 * SimpleXMLIterator ����xml�ļ�
 *
 */
try {
    $xmlString = file_get_contents('spl.xml');

    $simpleIt = new SimpleXMLIterator($xmlString);
    // ѭ�����еĽڵ�
    foreach (new RecursiveIteratorIterator($simpleIt,1) as $name => $data) {
        //echo $name, '=>', $data, "<br />";
    }

    // while ѭ��
    $simpleIt->rewind();
    while ($simpleIt->valid()) {
        /*var_dump($simpleIt->key());
        echo '=>';
        var_dump($simpleIt->current());*/

        // getChildren() ��õ�ǰ�ڵ���ӽڵ�
        if ($simpleIt->hasChildren()) {
            //var_dump($simpleIt->getChildren());
        }
        $simpleIt->next();
    }

    // xpath ����ͨ��pathֱ�ӻ��ָ���ڵ��ֵ
    var_dump($simpleIt->xpath('animal/category/species'));



} catch (Exception $e) {
    echo $e->getMessage();
}

echo '--------------------------------- SimpleXMLIterator END-----------------------------------', '<br />';

echo '--------------------------------- CachingIterator START-----------------------------------', '<br />';

/**
 * CachingIterator ��ǰ��ȡһ��Ԫ��
 * ��������ȷ����ǰԪ���Ƿ�Ϊ���һ��Ԫ��
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
 * LimitIterator ����һ��Iterator���޶��Ӽ�
 * ��__construct��������ѡ������offset �� count
 */
$array = array('apple', 'banana', 'cherry', 'damson', 'elderberry');
$fruits = new ArrayIterator($array);
$offset = 3;$count = 2;
$limitIt = new LimitIterator($fruits, $offset, $count);
// ���������offset����ôֻ��������������rewindʱ���ڵ�ֵ������0�����Ǳ���ȡ��ֵoffset��
// getPosition ��õ�ǰ�ڵ��λ��
$limitIt->rewind();
var_dump($limitIt->getPosition());

foreach ($limitIt AS $item) {
    echo $item, '<br />';
}

echo '--------------------------------- LimitIterator START-----------------------------------', '<br />';

echo '----------------------------------- SplFileObject END ---------------------------------', '<br />';
/**
 * SplFileObject ���ı��ļ����б���
 */

$file = '/data/www/test.php';
$fileIt = new SplFileObject($file);
// ����������е��ı������б���
/*foreach ($fileIt AS $item) {
    echo $item, '<br />';
}*/

// ���صڼ���
$fileIt->seek(5);
echo $fileIt->current();
echo '<br />';

echo '--------------------------------- SplFileObject END-----------------------------------', '<br />';

echo '--------------------------------- InfiniteIterator START-----------------------------------', '<br />';

/**
 * infiniteIterator ��һ��������������ѭ�����
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
 * RecursiveTreeIterator �ѿ��ӵķ�ʽ��ʾһ�����νṹ
 */

$array = array("a" => "lemon", "b" => "orange", array("a" => "apple", "p" => "pear"));
$rtreeIt = new RecursiveTreeIterator(new RecursiveArrayIterator($array), null, null, RecursiveIteratorIterator::LEAVES_ONLY );
foreach ($rtreeIt AS $item){
    echo $item;
}

echo '--------------------------------- RecursiveTreeIterator START-----------------------------------', '<br />';

echo '----------------------------------- MultipleIterator  END ---------------------------------', '<br />';

/**
 * MultipleIterator  ���ڵ�������������
 * Ԥ���峣����
 * MultipleIterator::MIT_NEED_ANY  ����Ҫ���е��ӵ�����Ϊ���õĽڵ�. �������ü�ֵ��Ĭ�����ּ�ֵ
 * MultipleIterator::MIT_NEED_ALL  ���е��ӽڵ㶼�����õĵ���. �������ü�ֵ��Ĭ�����ּ�ֵ
 * MultipleIterator::MIT_KEYS_NUMERIC ���ӽڵ��λ����Ϊ��ֵkey. �������ü�ֵ��Ĭ�����ּ�ֵ
 * MultipleIterator::MIT_KEYS_ASSOC Ϊ�ӵ������Ӽ�ֵ.ʹ��attachIterator������Ϊÿһ�����ü�ֵ
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
































