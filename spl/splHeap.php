<?php

/**
 * spl数据结构demo
 * 堆 SplHeap
 * 最小堆 SplMinHeap
 * 最大堆 SplMaxHeap
 *
 * 最小堆和最大堆是堆，所以，所有双向链表的方法都可以被栈和队列使用。调用方法也一致。
 * SplHeap只能通过继承的方式来调用该类方法。可以直接new SplMinHeap或者new SplMaxHeap
 */

$heap = new SplMaxHeap();

// insert($value)
// 对堆插入新值
$heap->insert('value1');
$heap->insert('value2');
$heap->insert('value3');
$heap->insert('value4');
$heap->insert('value5');

// count()
// 获得堆值的数量
$heap->count();

// rewind()
// 返回首节点
$heap->rewind();

// current()
// 获得当前节点
$heap->current();

// extract()



var_dump($heap);


















