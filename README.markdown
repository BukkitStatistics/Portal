![YASP](http://dl.wolvencraft.com/src/img/bdev/statistics.png)

**Statisitcs** (previously known as the YASP project) is a ground-up rewrite of a popular Minecraft plugin called **[Statistician](http://dev.bukkit.org/server-mods/statisticianv2/)**, first made by ChaseHQ and continued by Coryf88, Crimsonfoxy, and Dazzel_. Starting up as an unofficial fork of the original project, Statistics grew to the point where it contains almost no traces of the original code, both in Bukkit plugin and in web portal.

Statistician did a decent job of logging some player and server statistics, however, Statistics takes it a step further and completely overhauls the stats tracking, bringing the amount of information collected to a staggering amount, in addition to featuring a brand new modern web portal. This plugin was made to be highly customizable; it will do only what you tell it to do.
## Requirements ##
In order to track statistics, you will need a web-server that fulfills the following requirements:

- MySQL v.5 or higher
- PHP 5.2.x or higher

The Bukkit plugin was designed to work regardless of the Bukkit version, however, due to the sheer complexity of the code, it is only guaranteed to work with the version it was built with.

## Installation ##
To use these development build you need to install the required libraries via ``composer install``.