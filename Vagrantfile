# Require vagrant 1.8 or newer:
Vagrant.require_version ">= 1.8"

# BOX Configuration:
Vagrant.configure("2") do |config|
  # Configure our project to use Official Ubuntu Server 14.04 LTS 
  # (Trusty Tahr) build as a base:
  config.vm.box = "ubuntu/trusty64"

  # Define shell:
  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  
  # Tell Vagrant to use the shell provisioner to setup 
  # the machine, with the bootstrap.sh file.
  config.vm.provision :shell, path: "sandbox/bootstrap.sh"
  
  # Forwarding port 80 to 4567 in host machine:
  config.vm.network :forwarded_port, guest: 80, host: 4567
end

