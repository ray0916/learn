<?php

/**
 * spl���ݽṹdemo
 * �� SplHeap
 * ��С�� SplMinHeap
 * ���� SplMaxHeap
 *
 * ��С�Ѻ������Ƕѣ����ԣ�����˫������ķ��������Ա�ջ�Ͷ���ʹ�á����÷���Ҳһ�¡�
 * SplHeapֻ��ͨ���̳еķ�ʽ�����ø��෽��������ֱ��new SplMinHeap����new SplMaxHeap
 */

$heap = new SplMaxHeap();

// insert($value)
// �ԶѲ�����ֵ
$heap->insert('value1');
$heap->insert('value2');
$heap->insert('value3');
$heap->insert('value4');
$heap->insert('value5');

// count()
// ��ö�ֵ������
$heap->count();

// rewind()
// �����׽ڵ�
$heap->rewind();

// current()
// ��õ�ǰ�ڵ�
$heap->current();

// extract()



var_dump($heap);


















