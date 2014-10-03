# Vagrant web stack
Basic web development stack using Ansible for provisioning. Using LAMP right now, but have plans about another software.
 See [TODO](TODO.md).

## Requirements
* [VirtualBox](https://www.virtualbox.org) or [Parallels](http://www.parallels.com)
* [Vagrant](http://www.vagrantup.com/downloads.html)
* [Ansible](http://docs.ansible.com/intro_installation.html)

## Included software

* Apache, PHP, MySQL, SQLite
* Adminer, Sypex Backup
* Xdebug, Kint, Fire PHP
* Composer
* Drupal 7 & Drupal 8, Drush, Drush completion, Drupal Code Sniffer
* NFS server
* vim, zip, unzip, curl, mc, git, zsh
* Well cooked dotfiles (zsh, gitignore & gitconfig)

## Usage
Modify ```Vagrantfile``` to set up host name and IP address. Check out ```playbook.yml``` and uncomment required roles.
Also check ```parameters.yml``` for setting necessary variables (IP, passwords, etc).
Run machine by command:

```bash
vagrant up
```

If you want, you can use Parallels instead VirtualBox (Benchmarks [1](http://www.macobserver.com/tmo/article/benchmarking-parallels-fusion-and-virtualbox-against-boot-camp)[2](http://www.tekrevue.com/parallels-10-fusion-7-virtualbox-benchmark/13/). Use the built in plugin manager to install Parallels Desktop compatibility module:

```bash
vagrant plugin install vagrant-parallels
```

Now, to produce the virtual machine:

```bash
vagrant up --provider=parallels
```

You can SSH into the machine, this command will drop you into a full-fledged SSH session.

```bash
vagrant ssh
```

Open http://10.0.0.100/ and enjoy :thumbsup: