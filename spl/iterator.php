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

echo '--------------------------------- SimpleXMLIterator START-----------------------------------', '<br />';

/**
 * SimpleXMLIterator ����xml�ļ�
 *
 */
try {
    $sxi = new SimpleXMLIterator();
}





echo '--------------------------------- SimpleXMLIterator END-----------------------------------', '<br />';


