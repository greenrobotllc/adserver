#This is for Ubuntu
#Install docker:
https://docs.docker.com/install/linux/docker-ce/ubuntu/

systemctl start docker
docker run hello-world

#Install php 7
apt install php7.3
apt install docker-compose

cd home; mkdir adserver; cd adserver; git clone https://github.com/greenrobotllc/adserver .
