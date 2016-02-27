yii2-minify
============

Compress html and css/js in page component and helper for Yii PHP framework 2.0 

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "maybeworks/yii2-minify" "*"
```

or add

```json
"maybeworks/yii2-minify" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----
For usage as component - add to app config
```php
'components'=>[
     'minifyManager' => [
            'class' => 'maybeworks\minify\MinifyManager',
            'html' => !YII_DEBUG,
            'css' => !YII_DEBUG,
            'js' => !YII_DEBUG,
     ]
]

'bootstrap' => [
     'minifyManager'
],
```

or use manual
```php
$html = MinifyHelper::html($html);
$css = MinifyHelper::css($css);
$js = MinifyHelper::js($js);
```

> [![MaybeWorks](http://maybe.works/logo/logo_mw.png)](http://maybe.works)  
<i>Nothing is impossible, limit exists only in the minds of...</i>  
[maybe.works](http://maybe.works)
