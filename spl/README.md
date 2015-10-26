一、SPL介绍
 SPL(Standard PHP Library):用户解决典型问题的一组接口与类的集合
 官方定义："is a collection of interfaces and classes that are meant to solve common problems "
 它提供了很多的标准数据结构，迭代器，接口，异常以及各种类接口，文件处理等。
 
二 数据结构
在SPL中，提供了一组标准的数据结构
SplDoublyLinkedList: 双向链表
SplStack: 栈，继承于SplDoublyLinkedList
SplQueue: 队列，继承于SplDoublyLinkedList
SplHeap: 堆
SplMaxHeap: 最大堆，继承于SplHeap
SplMinHeap: 最小堆，继承于SplHeap
SplPriorityQueue: 优先队列堆
SplFixedArray: 阵列
SplObjectStorage: 映射

三 迭代器

迭代器树
ArrayIterator
--RecursiveArrayIterator

EmptyIterator

IteratorIterator
--AppendIterator
--CachingIterator
----RecursiveCachingIterator
--FilterIterator
----CallbackFilterIterator
------RecursiveCallbackFilterIterator
----RecursiveFilterIterator
------ParentIterator
----RegexIterator
------RecursiveRegexIterator
--InfiniteIterator
--LimitIterator
--NoRewindIterator

MultipleIterator

RecursiveIteratorIterator
--RecursiveTreeIterator

DirectoryIterator
--FilesystemIterator
----GlobIterator
----RecursiveDirectoryIterator
















