# [译]MySQL InnoDB锁和事务模型
- 原文地址：[14.7 InnoDB Locking and Transaction Model](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking-transaction-model.html)
- 原文作者：[MySQL](https://dev.mysql.com/doc/)
- 译者：[吕运](https://github.com/yunlyz)
  

[14.7.1 InnoDB Locking](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html)

[14.7.2 InnoDB Transaction Model](https://dev.mysql.com/doc/refman/5.6/en/innodb-transaction-model.html)

[14.7.3 Locks Set by Different SQL Statements in InnoDB](https://dev.mysql.com/doc/refman/5.6/en/innodb-locks-set.html)

[14.7.4 Phantom Rows](https://dev.mysql.com/doc/refman/5.6/en/innodb-next-key-locking.html)

[14.7.5 Deadlocks in InnoDB](https://dev.mysql.com/doc/refman/5.6/en/innodb-deadlocks.html)


为了实现高扩展、繁忙和高可用的数据库应用，从不同数据库系统移植大量代码，或者是为了调整MySQL性能，理解MySQL的锁和事务模型是很重要的。

本节讨论与InnoDB锁定相关的几个主题以及您应该熟悉的InnoDB事务模型。

- [Section 14.7.1, “InnoDB Locking” ](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html)描述InnoDB中使用的锁类型。
- [Section 14.7.2, “InnoDB Transaction Model”](https://dev.mysql.com/doc/refman/5.6/en/innodb-transaction-model.html)描述事务隔离级别以及每一个隔离级别使用的锁机制。也同样讨论`autocommit`、一致性的非锁定读取和锁定读取的使用。
- [Section 14.7.3, “Locks Set by Different SQL Statements in InnoDB”](https://dev.mysql.com/doc/refman/5.6/en/innodb-locks-set.html)讨论在InnoDB中为许多语句设置的特殊锁类型。
- [Section 14.7.4, “Phantom Rows”](https://dev.mysql.com/doc/refman/5.6/en/innodb-next-key-locking.html)描述InnoDB是如何使用next-key锁避免幻读的。
- [Section 14.7.5, “Deadlocks in InnoDB”](https://dev.mysql.com/doc/refman/5.6/en/innodb-deadlocks.html)提供死锁实例，讨论死锁的发现和回滚，并提供了在InnoDB中最小化和处理死锁的技巧。

## 14.7.1 InnoDB Locking
本节介绍InnoDB中使用的锁类型。

- [Shared and Exclusive Locks(共享锁和排斥锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-shared-exclusive-locks)
- [Intention Locks(意向锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-intention-locks)
- [Record Locks(记录锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-record-locks)
- [Gap Locks(间隙锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-gap-locks)
- [Next-Key Locks(next-key锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-next-key-locks)
- [Insert Intention Locks(插入意向锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-insert-intention-locks)
- [AUTO-INC Locks(自增锁)](https://dev.mysql.com/doc/refman/5.6/en/innodb-locking.html#innodb-auto-inc-locks)

### Shared and Exclusive Locks

InnoDB实现标准的行级锁定，其中有两种类型，共享(s)锁和独占(x)锁。
- 共享(s)锁允许持有锁的事务读取行信息。
- 独占(x)锁允许持有锁的事务更新和删除行。

如果事务`T1`在行`r`上持有共享(s)锁，则来自不同事务的T2对行r的锁的请求按如下方式处理：
- T2的s锁请求会被立即授权。结果是，T1和T2同时持在行r上持有s锁。
- T2的x锁请求会被马上拒绝。

如果事务T1持有行r的x锁，来自不同事务T2的任何的锁请求都将会被立即拒绝授权。作为代替，事务T2必须等待事务T1释放在行r上的锁。

### Intention Locks
InnoDB支持多种粒度锁，允许同时存在行锁和表锁。例如：`LOCK TABLES ... WRITE `语句带有独占锁(x锁)在指定的表上。为了实现多个粒度锁的锁定，InnoDB使用意向锁。意向锁是表级锁，它指示事务稍后对表中的行需要的锁类型(共享锁和独占锁)。有两种类型的意向锁：
- 意向共享锁(IS)表示事务打算在表的各个行上设置共享锁。
- 意向独占锁(IX)表示事务打算在表的各个行上设置独占锁。

例如：`SELECT ... LOCK IN SHARE MODE`设置的是`IS`锁，`SELECT ... FOR UPDATE`设置的是独占锁。

意向锁定协议如下：
- 事务在表的行上能获取共享锁之前，首先必须要在表上获得`IS`锁或者或者更高级别的锁。
- 事务在表的行上能获取独占锁之前，首先必须要在表上获得`IX`锁。

表级锁类型兼容性在以下矩阵中：
![](https://i.loli.net/2019/06/27/5d146fee3ad9755591.png)

如果请求事务与现有锁兼容，则授予锁；但如果它与现有锁冲突则不授予。事务等待直到冲突的锁被释放。如果一个锁请求与现有锁冲突，则不被授予，否则会导致死锁，发生错误。

意向锁不会阻塞出完整表请求之外的任何内容(例如：lock tables ... write)。意向锁的主要是为了展示在表中某些行被锁定或者将要被锁定。

意向锁的事务数据与`show engine innodb status`和`InnoDB`监视器输出中的一下内容相似：
```sql
TABLE LOCK table `test`.`t` trx id 10080 lock mode IX
```

### Record Locks

记录锁是在索引记录上的锁。例如，`SELECT c1 FROM t WHERE c1 = 10 FOR UPDATE;`阻止任何的事务在t.c1 = 10的行上执行插入删除操作。

即使是没有定义索引的表，记录锁也始终锁定索引记录。对于这种情况：InnoDB创建一个隐藏的聚簇索引，在这个索引上添加记录锁。请参见[Section 14.6.2.1, “Clustered and Secondary Indexes”](https://dev.mysql.com/doc/refman/5.6/en/innodb-index-types.html)。

意向锁的事务数据与`show engine innodb status`和`InnoDB`监视器输出中的一下内容相似：
```sql
RECORD LOCKS space id 58 page no 3 n bits 72 index `PRIMARY` of table `test`.`t` 
trx id 10078 lock_mode X locks rec but not gap
Record lock, heap no 2 PHYSICAL RECORD: n_fields 3; compact format; info bits 0
 0: len 4; hex 8000000a; asc     ;;
 1: len 6; hex 00000000274f; asc     'O;;
 2: len 7; hex b60000019d0110; asc        ;;
```

### Gap Locks
间隙锁是锁定在索引记录之间的锁，或者是锁定在第一个索引之前或最后一个索引之后的锁。例如：`SELECT c1 FROM t WHERE c1 BETWEEN 10 and 20 FOR UPDATE;`阻止其他事务插入值为15到列t.c1中，不管是否有值存在在列中。因为所有在范围内中的值的间隙都被锁定了。

间隙可能跨越单个索引值，多个索引值，甚至可能为空。

间隙锁是权衡性能和一致性的一部分，且用于某些事务隔离级别而不是全部。

使用唯一索引锁定行以搜索唯一行的语句不需要间隙锁(这不包括搜索条件仅包含多列唯一索引的某些列的情况下；在这种情况下，确实会发生间隙锁。)。例如：如果`id`是唯一索引，下面的语句仅对id值为100的行使用索引记录锁定，并且其他会话是否在前一个间隙中插入行无关紧要。

```sql
SELECT * FROM child WHERE id = 100;
```

如果id不是索引或者不是唯一索引，则语句会锁定前一个间隙。

此处值得注意的是，冲突锁可以通过不同事务保持在间隙上。例如：事务A可以在间隙上保持共享间隙锁（间隙-s锁），而事务B在同一间隙上保持独占间隙锁(间隙-x锁)。允许冲突间隙锁的原因是，如果从索引中清除记录，则必须合并由不同事务保留在记录上的间隙锁。

InnoDB中，间隙锁是"纯粹的抑制"，这意味着他们的唯一目的是防止其他事务插入间隙。间隙锁可以共存。一个事务占用的间隙锁不能阻止另一个事务在同一个间隙上进行间隙锁定。共享和独占间隙锁之间没有任何区别。彼此不会相互冲突。他们执行相同的功能。

间隙锁不能明确的被禁用。如果你改变事务的隔离级别为`read committed`或者启用系统变量(现在已废弃)`innodb_locks_unsafe_for_binlog`，那么间隙锁将会发生。在这种情况下，用于搜索和扫描索引以及只是用于外键检查和重复检查的时候，间隙锁会被禁用。

使用`read committed`隔离级别或启用`innodb_locks_unsafe_for_binlog`还有其他影响。
MySQL评估where条件后，将释放不匹配行的记录锁。对于update语句，InnoDB执行半一致读取，以便将最新提交的版本返回给MySQL，以便MySQL可以确定该行是否与update的where条件匹配。

### Next-Key Locks
next-key锁是索引记录上的记录锁和索引记录之前的间隙锁的组合。

InnoDB以这样一种方式执行行级别锁：当它搜索或扫描表索引时，它会在遇到的索引记录上设置共享锁或排它锁。因此行级锁时间上是索引记录锁。索引记录上的下一键锁定也会影响该索引记录之前的间隙。也就是说，下一键锁定是索引记录锁定加上索引记录之前的间隙上的间隙锁定。如果一个会话的在索引中的记录R上具有共享或排它锁，则另一个会话不能再索引顺序中的R之前的间隙中插入新的索引记录。

假设索引值包含值10、11、13和20。此索引的可能下一个键锁定覆盖 一下间隔，其中圆括号表示排除间隔端点，方括号表示包含间隔端点：
```txt
(negative infinity, 10]
(10, 11]
(11, 13]
(13, 20]
(20, positive infinity)
```

对于最后一个间隔，next-key锁将间隙锁定在索引中最大值之上，而'suoernum'未记录的值高于索引中实际的任何值。supernum不是真正的索引记录，因此，实际上，next-key仅锁定最大索引值之后的间隙。

默认情况下，InnoDB在REPEATABLE READ事务隔离级别运行，并禁用innodb_locks_unsafe_for_binlog系统变量。在这种情况下，InnoDB使用next-key锁进行搜索和扫描，从而防止幻读。

下一键锁的事务数据类似于SHOW ENGINE INNODB STATUS和InnoDB监视器输出中的以下内容：
```sql
RECORD LOCKS space id 58 page no 3 n bits 72 index `PRIMARY` of table `test`.`t` 
trx id 10080 lock_mode X
Record lock, heap no 1 PHYSICAL RECORD: n_fields 1; compact format; info bits 0
 0: len 8; hex 73757072656d756d; asc supremum;;

Record lock, heap no 2 PHYSICAL RECORD: n_fields 3; compact format; info bits 0
 0: len 4; hex 8000000a; asc     ;;
 1: len 6; hex 00000000274f; asc     'O;;
 2: len 7; hex b60000019d0110; asc        ;;
```

### Insert Intention Locks
插入意向锁是在行插入之前由insert操作设置的一种间隙锁。该锁表示以这样的方式插入的意图：如果插入到相同索引间隙中的多个事务不插入间隙内的相同位置，则不需要等待彼此。假设存在值为4和7的索引记录。分别尝试插入值5和6的单独事务，在获取插入行上的独占锁之前，每个锁定4和7之间的间隙和插入意图锁，但是不要互相阻塞因为行是非冲突的。

