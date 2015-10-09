<?php

/**
 * spl���ݽṹdemo
 * ���� SplFixedArray
 *
 */

// ����һ������Ϊ5������
$array = new SplFixedArray(5);

$array[1] = 2;
$array[3] = 'value2';


// count()
// ���г���
$array->count();

// key()
// ��õ�ǰ�ڵ������
$array->key();

// valid()
// �ж��Ƿ񻹴���ֵ
$array->valid();

// rewind()
// �ص���ʼ�ڵ�
$array->rewind();

// current()
// ��õ�ǰ�ڵ�
$array->current();

// next()
// ָ���ƶ�����һ���ڵ�
$array->next();

// setSize(int $size)
// ����������������Ĵ�С
$array->setSize(10);

// getSize()
// �����������Ĵ�С
$array->getSize();

// offsetExists(int $index)
// �жϸ������Ƿ����ֵ������boolean
$array->offsetExists(3);

// offsetGet(int $index)
// ��ø�������Ӧ��ֵ
$array->offsetGet(3);

// offsetSet(int $index, mixed $value)
// ���ø�������Ӧ��ֵ
$array->offsetSet(6, 'value3');

// offsetUnset(int $index)
// ɾ����������Ӧ��ֵ
$array->offsetUnset(6);


// toArray()
// ������ת����php����
// output: Array ( [0] => [1] => 2 [2] => [3] => value2 [4] => [5] => [6] => [7] => [8] => [9] => )

$php_array = $array->toArray();

// fromArray($php_array)
// ��php����ת��������
// output: SplFixedArray Object ( [0] => [1] => 2 [2] => [3] => value2 [4] => [5] => [6] => [7] => [8] => [9] => )
$spl_array = SplFixedArray::fromArray($php_array);





















