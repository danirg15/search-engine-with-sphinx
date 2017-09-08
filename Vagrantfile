
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  
  config.vm.define "ubuntu_sphinx" do |ubuntu_sphinx|
  	config.vm.network "forwarded_port", guest: 9312, host: 9312
	config.vm.hostname = "ubuntusphinx"
	config.vm.network :private_network, ip: "10.0.0.10"

	config.vm.provision "shell", path: "./scripts/mysql.sh"
	config.vm.provision "shell", path: "./scripts/php.sh"
	config.vm.provision "shell", path: "./scripts/sphinx.sh"
  end

end