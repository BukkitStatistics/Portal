![YASP](http://stats.wolvencraft.com/src/img/plugin_logo.png)

**YASP** is an unofficial fork of a popular Minecraft Plugin called **[Statistician](http://dev.bukkit.org/server-mods/statisticianv2/)**, first made by ChaseHQ and continued by Coryf88, Crimsonfoxy, and Dazzel_.
While Statistican does a decent job logging many aspects of Minecraft gameplay and produces a working webpage with statistics, the default web portal that goes with the plugin is just outright ugly.
YASP strives to correct that, replacing the interface that would better suit a website in the 90-s with a more modern design.


## Features ##

### Store various types of statistics ###

- Server statistics
    - Last startup
    - Last shutdown
    - Current uptime
    - Current status (on-line / off-line)
    - Current number of players online
    - Maximum number of players

- Player statistics
    - PvP and PvE Kills
    - Natural Deaths
    - Blocks placed / destroyed
    - Distance traveled
    - Items picked up / dropped
    - Total time online

### Built-in Web Portal###
The plugin goes with the modern-looking web portal that is easy to install and pleasurable to use. Let the whole great world know of your server's achievements!

### Permissions Integration ###
The plugin will automatically integrate with any permissions plugin that you have installed. Add `stats.exempt` permission to people who you do not want to track.


## Requirements ##

In order to track statistics, you will need a web-server that fulfills the following requirements:

- MySQL v.5 or higher
- PHP 5.4.x

## Installation ##
Please, note that, while YASP is compatible with [Statistician 2](http://dev.bukkit.org/server-mods/statisticianv2/)'s bukkit plugin, some of the block images will be broken, and some of the features will be unavailable. You will need to manually correct the block names in the `resource-desc` table of the database. Take a look at [this commit](https://github.com/bitWolfy/YetAnotherStatisticsPlugin/commit/ee27fbb6aade35b8dd6465908d77e32e50837052) to see the potential problems.

### Minecraft Server ###
1. Create a new database, associate a user with it, and give that user all permissions. If you are hosting the webserver on your own machine, then you probably know how to do it, otherwise, you can probably learn how to perform these actions in your hoster's help docs.
2. Drop the plugin `.jar` file into the `/plugins/` folder. It will generate a configuration file. If you are running Statistician 2, you will see errors in the server log - ignore them for now.
3. Edit `config.yml` of the plugin to match the details of your database. Reload the plugins if it is safe to do so, restart the server otherwise.
4. The plugin should connect to the remote database and update it to the latest version (which might take a bit).
5. The plugin setup is complete

### Web Server ###
1. Copy the contents of the `web` folder to the desired directory on the web server. For example, `/home/public_html/stats`.
2. Go to the URL associated with that directory. For example `http://wolvencraft.com/stats/`.
3. Fill out the form on the screen with the database information, portal settings, and create an admin account for the portal
4. Web portal setup is complete


### Frequently Asked Questions ###
**[Q]** What are the differences between the `.jar` files provided by YASP and Statistician?

**[A]** The only difference you are likely to notice is that YASP does not send any notifications to users. Other than that, all changes are purely technical.

-------------

**[Q]** What are the table names?

**[A]** blocks, config, creatures,kill_types, kills, pickup_drop, players, projectiles, resource_desc, server

-------------

**[Q]** I am getting this error: `[SEVERE] Error occurred while enabling Statistician v1.3 (Is it up to date?): java.lang.Integer cannot be cast to java.lang.String`
**[A]** Port and Update time should never have quotes around them, as they are ALWAYS numbers. You don't always need quotes around the database's name and pass, but if they are made of just numbers, you MUST put them in quotes.