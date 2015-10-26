<?php

/**
 * spl���ݽṹdemo
 * �������� SplObjectStorage
 *
 */

// ʵ����
$obj = new SplObjectStorage();


// addAll(SplObjectStorage $storage)
// ����һ�����������Ķ�������ȫ�����뵽�Լ��Ķ�����
$o = new StdClass;
$obj_1 = new SplObjectStorage();
$obj_1[$o] = 'hello';


$obj->addAll($obj_1);

//echo $obj[$o]; // hello

// attach(object $object[, mixed $data=null])
// ��������������Ӷ���
$a1 = new StdClass;
$a2 = new StdClass;
$obj->attach($a1);
$obj->attach($a2, 'class 2');
$obj->attach($a2, array('k1'=>'class 2'));

// detach(object $object)
// ����������Ӷ��������з���
$obj->detach($o);// $obj[$o] �����Ҳ�������

// contains(object $object)
// �ж϶��������Ƿ���ڸö���
$obj->contains($o); // false


// count()
// ���ӳ������еĶ�������
$obj->count();

// valid()
// �ж϶���������ǰָ������Ƿ���ֵ
$obj->valid();

// key()
// ���ض���������ǰ�ڵ������
$obj->key();

// rewind()
// ���ز�ָ���һ���ڵ�Ԫ��
$obj->rewind();


// setInfo(mixed $data)
// ����ǰ�ڵ㸳ֵ�������ǵ���rewind�󣬲ſ�����setInfo��ֵ�������Ҳ�������
$obj->setInfo('AAA');

// getInfo()
// ��õ�ǰ�ڵ��ֵ��Ҳ�����ǵ���rewind�󣬲ſ��Ե���getInfo��
$obj->getInfo();

// current()
// ��õ�ǰ�ڵ����
$obj->current();

// getHash()
// ��ò�����hashֵ
$obj->getHash($a2);

// next()
// ָ���Ƶ���һ���ڵ�
$obj->next();

// offsetExists
// �ж϶����������Ƿ���ڸö���
$obj->offsetExists($a2);

// offsetSet()
// �����������е�ĳ����������ֵ
$obj->offsetSet($a2, 'BBB');

// offsetGet()
// ��ö��������е�ĳ��������Ӧ��ֵ
$obj->offsetGet($a2);

// offsetUnset()
// ��ĳ�ڵ�ɾ��
//$obj->offsetUnset($a1);


// serialize()
// �������������л�
$serialize_obj = $obj->serialize();

// unserialize()
// ���������������л�
$obj_2 = new SplObjectStorage();
$obj_2->unserialize($serialize_obj);

var_dump($obj_2);





