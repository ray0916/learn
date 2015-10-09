<?php

/**
 * spl���ݽṹdemo
 * �� SplHeap
 * ��С�� SplMinHeap
 * ���� SplMaxHeap
 * ���ȶ��ж� SplPriorityQueue
 *
 * ��С�Ѻ������Ƕѣ����ԣ�����˫������ķ��������Ա�ջ�Ͷ���ʹ�á����÷���Ҳһ�¡�
 * SplHeapֻ��ͨ���̳еķ�ʽ�����ø��෽��������ֱ��new SplMinHeap����new SplMaxHeap
 *
 * ���ȶ��жѻᰴ�ղ���ʱ����������ֵ������������
 *
 *
 * ����һ����ȫ���������߶���O(lg n)���ص��Ǹ��ڵ��ֵ���ڣ�С�ڣ������ӽڵ��ֵ���ֱ��Ϊ�󶥣�d=====(������*)b�Ѻ�С����
 * �����Ӧ�õĶ����裬�¼����Ӷ���O(N lg N)�������С���������ô󶥶ѣ��Ӵ�С������С����
 */

// compare
// �Ƚ�ֵ��һ�����������Լ��Ķ��࣬ͨ���ȽϷ���ֵ��Ϊ���ѻ�����С��
//

$heap = new SplMaxHeap();

// insert($value)
// �����Ѳ�����ֵ
$heap->insert('3');
$heap->insert('1');
$heap->insert('2');
$heap->insert('5');
$heap->insert('4');

// $heap = new SplPriorityQueue();
// insert($value, $priority)
// ���ȶ��в�����ֵ
//$heap->insert('A', '3');
//$heap->insert('B', '1');
//$heap->insert('C', '2');
//$heap->insert('D', '5');
//$heap->insert('E', '4');


// isEmpty()
// �жϸö��Ƿ�Ϊ��
$heap->isEmpty();

// count()
// ��ö�ֵ������
$heap->count();

// key()
// ���ص�ǰ�ڵ������ֵ
$heap->key();

// valid()
// �ж϶��л��Ƿ��������ڵ�
$heap->valid();

// rewind()
// �����׽ڵ㣬�ڶ����ǿղ�������Ϊ���Ƕ�������rewindʼ�ջ��ڵ�ǰλ�ö����ƶ�
$heap->rewind();

// current()
// ��õ�ǰ�ڵ�
$heap->current();

// next()
// ָ��������һ���ڵ�
$heap->next();

// extract()
// �ӶѵĶ������ڵ㿪ʼ�������ң��׳�һ���ڵ�
$heap->extract();

// top()
// ��öѵĶ��ڵ�
$heap->top();

// recoverFromCorruption
// �ӱ����������лָ������ҿ��Խ�����������
$heap->recoverFromCorruption();



var_dump($heap->extract());



















