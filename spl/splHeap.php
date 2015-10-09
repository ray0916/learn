<?php

/**
 * spl数据结构demo
 * 堆 SplHeap
 * 最小堆 SplMinHeap
 * 最大堆 SplMaxHeap
 * 优先队列堆 SplPriorityQueue
 *
 * 最小堆和最大堆是堆，所以，所有双向链表的方法都可以被栈和队列使用。调用方法也一致。
 * SplHeap只能通过继承的方式来调用该类方法。可以直接new SplMinHeap或者new SplMaxHeap
 *
 * 优先队列堆会按照插入时给定的优先值建立二叉树。
 *
 *
 * 堆是一个完全二叉树，高度是O(lg n)。特点是父节点的值大于（小于）两个子节点的值，分别称为大顶！d=====(￣▽￣*)b堆和小顶堆
 * 最常见的应用的堆配需，事件复杂度是O(N lg N)。如果从小到大排序，用大顶堆，从大到小排序，用小顶堆
 */

// compare
// 比较值，一般用来建立自己的堆类，通过比较返回值作为最大堆或者最小堆
//

$heap = new SplMaxHeap();

// insert($value)
// 正常堆插入新值
$heap->insert('3');
$heap->insert('1');
$heap->insert('2');
$heap->insert('5');
$heap->insert('4');

// $heap = new SplPriorityQueue();
// insert($value, $priority)
// 优先队列插入新值
//$heap->insert('A', '3');
//$heap->insert('B', '1');
//$heap->insert('C', '2');
//$heap->insert('D', '5');
//$heap->insert('E', '4');


// isEmpty()
// 判断该堆是否为空
$heap->isEmpty();

// count()
// 获得堆值的数量
$heap->count();

// key()
// 返回当前节点的索引值
$heap->key();

// valid()
// 判断堆中还是否有其他节点
$heap->valid();

// rewind()
// 返回首节点，在堆中是空操作。因为堆是二叉树，rewind始终会在当前位置而不移动
$heap->rewind();

// current()
// 获得当前节点
$heap->current();

// next()
// 指针移向下一个节点
$heap->next();

// extract()
// 从堆的顶部根节点开始，从左到右，抛出一个节点
$heap->extract();

// top()
// 获得堆的顶节点
$heap->top();

// recoverFromCorruption
// 从崩溃的区域中恢复，并且可以进行其他操作
$heap->recoverFromCorruption();



var_dump($heap->extract());



















