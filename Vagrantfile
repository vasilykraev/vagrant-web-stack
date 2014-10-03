VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  $memory = 1024
  $cpus = 2

  config.vm.hostname = "sandbox"
  config.vm.network :private_network, ip: "10.0.0.100"

  # The shell to use when executing SSH commands from Vagrant. By default this is bash -l
  # config.ssh.shell = "zsh -c"

  # Uncomment this if you don't want synchronize folders with nfs server.
  config.vm.synced_folder "./remote", "/var/www/remote"#, owner:"www-data", group:"www-data", mount_options:["dmode=775", "fmode=775"]

  # Configure VirtualBox.
  config.vm.provider :virtualbox do |vb|
    config.vm.box = "ubuntu/trusty32"
    # config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-i386-vagrant-disk1.box"
    vb.name = "sandbox"
    vb.memory = $memory
    vb.cpus = $cpus
  end

  # Configure Parallels.
  config.vm.provider :parallels do |prl, override|
    override.vm.box = "parallels/ubuntu-14.04"
    # there is no 32bit version from Parallels, and by default downloaded trusty64
    # override.vm.box_url = "https://vagrantcloud.com/parallels/boxes/ubuntu-14.04/versions/2/providers/parallels.box"
    prl.memory = $memory
    prl.cpus = $cpus
    prl.update_guest_tools = true
  end

  # Enable provisioning with Ansible.
  config.vm.provision "ansible" do |ansible|
    ansible.playbook = "playbook.yml"
    # Many Ansible playbooks examples has remote user = root, so ansible provisioner connect as the wrong user.
    # Fix SSH unknown error when provisioning a Vagrant.
    ansible.extra_vars = { ansible_ssh_user: 'vagrant' }
    ansible.sudo = true
    ansible.verbose = 'vv'
  end
end