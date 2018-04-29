# Purpose

This alternc plugin propose to backup all accounts data on borgbackup storage.
Each day a backup is done. User from panel can get a read access on previous backup, from backup directory on their root workspace.

# Requirement

You need :
* debian server (from wheezy to Stretch)
* alternc >= 3.2
* borbackup-bin ou borgbackup package
 * with wheezy : [from webelys backport](https://bintray.com/webelys/debian)
 * with jessie : [from backport](https://packages.debian.org/jessie-backports/borgbackup)
 * with stretch : [from stable](https://packages.debian.org/stretch/borgbackup)
* [apt-transport-https](https://packages.debian.org/search?keywords=apt-transport-https) package to use https bintray service.


# Installation

## Stable package

You can download last package from :
* github : [release page](../../releases/latest)
* bintray : [ ![Bintray](https://api.bintray.com/packages/alternc/stable/alternc-borgbackup/images/download.svg) ](https://bintray.com/alternc/stable/alternc-borgbackup/_latestVersion)
* from bintray repository

### With Wheezy

```shell
apt-get install apt-transport-https
echo "deb [trusted=yes] https://dl.bintray.com/webelys/debian wheezy main"  >> /etc/apt/sources.list.d/webelys.list
echo "deb [trusted=yes] https://dl.bintray.com/alternc/stable stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get install borgbackup-bin alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

### With Jessie

```shell
apt-get install apt-transport-https
echo "deb http://ftp.debian.org/debian jessie-backports main" >> /etc/apt/sources.list
echo "deb [trusted=yes] https://dl.bintray.com/alternc/stable stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get install -t jessie-backports borgbackup
apt-get install alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

### With Stretch

```shell
apt-get install apt-transport-https
echo "deb [trusted=yes] https://dl.bintray.com/alternc/stable stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get install alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

## Nightly package

You can get last package from bintray, it's follow git master branch

Following your distribution, you must first enable borgbackup repository.

```shell
echo "deb [trusted=yes] https://dl.bintray.com/alternc/nightly stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get upgrade
apt-get install alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

# Configuration

Once alternc-borgbackup installed ,

* Install borg repository
 * su -l alterncpanel -s borg init /var/backups/borg
 * set a passphrase
* Configure borg passphrase from panel
 * go to https://alternc_panel//adm_variables.php
 * update borgbackup values (borgbackup_backup_dir_local, borgbackup_backup_path, borgbackup_bin)
 * apply change

# Packaging from source

To generate package we use [fpm tool](https://github.com/jordansissel/fpm)

```shell
apt-get install ruby ruby-dev rubygems build-essential
gem install --no-ri --no-rdoc fpm

git clone https://github.com/AlternC/alternc-borgbackup
cd alternc-borgbackup
make

```


# ROADMAP

* [ x ] Use borgbackup package in any case (1.1.0)