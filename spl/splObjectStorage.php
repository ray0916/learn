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

// setInfo(mixed $data)
//


var_dump($obj[$o]);





