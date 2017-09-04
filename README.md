# LemonCMS

本项目基于下面俩项目基础上随心所欲而成，并且看心情要不要一直维护下去

请注意！目前本项目还在整理代码部分重构，删掉无用代码的进程中，不定时更新各种乱七八糟的代码，不建议直接拿去用，等我把这句话删掉了，就表示基本可以拿去用咯

lulucms2 (https://github.com/yiifans/lulucms2)

Yii2 (https://github.com/yiisoft/yii2)

powerful and modularity CMS, based on lulucms2 >= Yii2

clone 下来之后记得要运行一下这个代码安装必要的库哟
```
composer install 
```

因为 lulucms2 的作者貌似已经弃坑了，所以本兄贵因个人需要就直接扒过来改了点忍不了的比较蠢的 bug 并重新缩进

不知道会不会一直更新及添加功能 ㄟ( ▔, ▔ )ㄏ 所以你们先不要对这个项目抱有浓厚期望，

如果我决心要为这个项目做出有效的努力的话，上面这段话我会删掉滴，所以在那之前诸位就自己看着玩儿吧。

呀你居然能发现这个？我还没在任何其他地方放出链接哦，真是猿粪呐！

啊另外，我给这个模块化的功能改了点小东西
具体的位置在 BaseApplication 文件中的重写的 handleRequest 方法

效果是可以在 module 文件里通过init方法另行添加url Rules规则，而不需要非得在config里把所有模块儿的url全定义完，虽然这样可能容易引起模块之间如果不注意的话容易有问题，不过鉴于我现在喜欢这么搞，那我就这么搞拉，不需要的话删掉就扩以拉

```
class HomeModule extends FrontModule
{
    public $controllerNamespace = 'source\modules\post\home\controllers';
    public function init(){
        app()->urlManager->addRules([
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => ['post/api'=>'post/api'],
            ]
        ]);
        parent::init();
        // custom initialization code goes here
    }
}
```
