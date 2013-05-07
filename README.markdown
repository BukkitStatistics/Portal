![YASP](http://dl.wolvencraft.com/src/img/bdev/statistics.png)

**Statisitcs** (previously known as the YASP project) is a ground-up rewrite of a popular Minecraft plugin called **[Statistician](http://dev.bukkit.org/server-mods/statisticianv2/)**, first made by ChaseHQ and continued by Coryf88, Crimsonfoxy, and Dazzel_. Starting up as an unofficial fork of the original project, Statistics grew to the point where it contains almost no traces of the original code, both in Bukkit plugin and in web portal.

Statistician did a decent job of logging some player and server statistics, however, Statistics takes it a step further and completely overhauls the stats tracking, bringing the amount of information collected to a staggering amount, in addition to featuring a brand new modern web portal. This plugin was made to be highly customizable; it will do only what you tell it to do.

## Features ##

### Store various types of statistics ###

- Server statistics
    - Server startup and shutdown times, in log and graph forms
    - Current status (online / offline), current and total uptime
    - Players that are currently online
    - Maximum number of players and the time when that maximum was reached

- World statistics
    - PVP, PVE, and Natural deaths
    - Blocks placed and destroyed
    - Items picked up and dropped, used and crafted

- Player statistics
    - Player information (health, hunger, experience, gamemode)
    - Current status (online / offline), login and logout times
    - Player permissions group _(requires Vault)_
    - Player economy data: balance and transactions _(requires Vault)_
    - Detailed participation information
    - PVP, PVE, and Natural deaths
    - Blocks placed and destroyed
    - Items picked up and dropped, used and crafted
    - Distance traveled through various means

### Built-in Web Portal###
A fully functional portal is included with the plugin, featuring a sleek modern design and an incredible level of customization. The web portal will look the way you want it to look and do what you want it to do, nothing more, nothing less.

### Permissions Integration ###
The plugin will automatically integrate with any permissions plugin that you have installed. Add `stats.exempt` permission to people who you do not want to track.

## Requirements ##
In order to track statistics, you will need a web-server that fulfills the following requirements:

- MySQL v.5 or higher
- PHP 5.4.x

The Bukkit plugin was designed to work regardless of the Bukkit version, however, due to the sheer complexity of the code, it is only guaranteed to work with the version it was built with.

## Installation ##
Before you begin the installation process, you need to have full access to a MySQL database. It can be an existing database, or you can create a new one; the later is preferable, but not required. Additionally, you have to have a web server to host the YASP portal.

1. Copy the `YASP.jar` to the `/plugins/` directory of your Minecraft server. Reload the plugins if it is safe to do so, otherwise, restart the server. The plugin will complain about the lack of connection to the database - this is normal and expected.
2. Open `/plugins/YASP/config.yml` and fill in the necessary MySQL database details. Restart or reload the server again.
3. The plugin will complete the initial set up of the database tables. You will see the patch notification - please, be patient and wait until the plugin says that the database is up to date.
4. The plugin installation is complete.
5. Copy the contents of the web archive to the desired directory on your web server. For example, `/home/public_html/stats`.
6. Proceed to the URL associated with that directory and follow the instructions on screen. For example `http://wolvencraft.com/stats/`.
7. Portal installation is complete.