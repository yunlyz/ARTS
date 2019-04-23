# [译]从你的代码中移除无用的public方法
- 原文地址：[Remove Dead Public Methods from Your Code](https://www.tomasvotruba.cz/blog/2019/03/14/remove-dead-public-methdos-from-your-code/#how-to-find-them-in-20-seconds)
- 原文作者：[Tomas Votruba](https://www.tomasvotruba.cz/)
- 译者：[吕运](https://github.com/yunlyz)

> 我们已经有了sniffs和rectors来移除无用的私有方法。但公有方法呢？如果你正创建一个开源库，公有方法可能会被每个人使用。
> 
> 但如果你创建的是应用，你可以考虑和平的删除无用的公用方法。只有一个问题需要解决 -- 找到无用的公有方法。

不想花太长时间阅读？观看我的一个朋友[Jan Kuchař](https://jankuchar.cz/)的[3：45的实战视频](https://www.youtube.com/watch?v=sKFB6XVmO_Q)。

正如我们多年前的一个应用中的代码，一些方法可能会被新方法替换。
```php
$person = new Person('Tomas');
- $person->getFullName();
+ $person->getName();
```

如果应用很复杂，我们不可能察觉到每一个使用它的地方：
```php
   <?php

class Person
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        // ...
    }

    public function getFullName()
    {
        // ...
    }
}
```

我们不必按文件手动读取代码库文件。PHPStome可以帮我们检查每一个共有方法以及被使用的地方。

只需要右键点击名为（"provide"在图片中）的方法并且选择"Find Usages"。

![](https://www.tomasvotruba.cz/assets/images/posts/2019/dead-public/usages.png)

我们花5-10秒的时间才发现`getFullName()`是一个死方法。干得漂亮！

## 我们是否可以更快的找到他们？

现在，用同样的方法查找其他的公有方法。

我认为Symplify项目非常的小，至少与私人web应用相比。然后，有超过684个公有方法。甚至即使我移除了test基准中的公有方法，依然保持了500个公有方法。

500*5 secs = 2500 secs ~= 41 mins

我们不会浪费时间在线性操作上，没门。

## 如何在20秒内找到他们？

在`symplify/coding-standard`中有一个很少人知道的sniff。设置它：
```yaml
# ecs.yaml
services:
    Symplify\CodingStandard\Sniffs\DeadCode\UnusedPublicMethodSniff: ~
```

然后使用：
```shell
vendor/bin/ecs check src
```

## 神奇？
并不是的。sniff通过你的代码：
- 找到所有方法：`public function someMethod()`
- 然后找到它的调用：`$this->someMethod()`
- 最后只是简单的报告那些没有被调用的公有方法

然后只是跳过误报，在[yaml配置](https://github.com/rectorphp/rector/blob/a8db80baff48eb02319963b3380f185461678815/packages/NodeTypeResolver/config/config.yaml#L15)或字符串中调用，就是这样。

你肯定会很惊喜，你的代码中有多少方法是死了的 :)

快乐的编码！