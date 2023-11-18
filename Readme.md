# Purpose

This alternc plugin propose to backup all accounts data on borgbackup storage.
Each day a backup is done. User from panel can get a read access on previous backup, from backup directory on their root workspace.

# Requirement

You need :
* debian server (from wheezy to Stretch)
* alternc >= 3.2
* borgbackup package
 * with jessie : [from backport](https://packages.debian.org/jessie-backports/borgbackup)
 * with stretch : [from stable](https://packages.debian.org/stretch/borgbackup)


# Installation

## Stable package

You can download last package from :
* github : [release page](../../releases/latest)
* alternc repository [repository](https://debian.alternc.org)

### With Jessie

```shell
sudo wget https://debian.alternc.org/key.txt -O /usr/share/keyrings/alternc.asc
echo "deb [signed-by=/usr/share/keyrings/alternc.asc] https://debian.alternc.org/ $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/alternc.list > /dev/null
apt-get update
apt-get install -t jessie-backports borgbackup
apt-get install alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

### With Stretch

```shell
sudo wget https://debian.alternc.org/key.txt -O /usr/share/keyrings/alternc.asc
echo "deb [signed-by=/usr/share/keyrings/alternc.asc] https://debian.alternc.org/ $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/alternc.list > /dev/null
apt-get update
apt-get install alternc-borgbackup
```
Don't forget configuration passphrase (follow configuration part)

## Nightly package

We provide an agnostic distribution package, you can try latest version with our experimental repository

```shell
sudo wget https://debian.alternc.org/key.txt -O /usr/share/keyrings/alternc.asc
echo "deb [signed-by=/usr/share/keyrings/alternc.asc] https://debian.alternc.org/ experimental main" | sudo tee /etc/apt/sources.list.d/alternc.list > /dev/null
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

You can use default debian command as debuild` or `dpkg-buildpackage`

```shell

git clone https://github.com/AlternC/alternc-borgbackup
cd alternc-borgbackup
dpkg-buildpackage -us -b

```


# ROADMAP

* [ x ] Manage a standard a debian packaging
* [ x ] Use borgbackup package in any case (1.1.0)
* [ x ] 1.1 borgbackup compatibilty (1.1.2)