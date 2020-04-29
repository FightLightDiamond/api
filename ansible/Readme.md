##Running Ansible Playbooks using EC2 Systems Manager Run Command and State Manager
## 1. Setup 
### 1.1 Config aws cli
Install unzip
```angularjs
sudo yum install -y unzip
```
Download files.
```angularjs
curl "https://awscli.amazonaws.com/awscli-exe-linux-x86_64.zip" -o "awscliv2.zip"
```
Unzip the installer
```angularjs
unzip awscliv2.zip
```
Run the install program.
```angularjs
sudo ./aws/install
```
Confirm the installation
```angularjs
aws --version
```

Config
```angularjs
aws configure
```
Setting user attach policies `AmazonEC2RoleforSSM`
## 1.2 Install SSM Agent

```angularjs
sudo yum install -y https://s3.amazonaws.com/ec2-downloads-windows/SSMAgent/latest/linux_amd64/amazon-ssm-agent.rpm
sudo systemctl enable amazon-ssm-agent
sudo systemctl start amazon-ssm-agent
sudo systemctl status amazon-ssm-agent
```

## 1.3 Install Ansible
For RedHat 7 you can install Ansible by enabling the epel repo. Use the following commands:
```angularjs
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo yum -y install ansible
ansible-galaxy install weareinteractive.vsftpd
```
Option
- m(Module)
- u(User)
- k(Password)
- i(Facts - path of hosts)
- s(Sudo)
- K(Password sudo)
- a(Command)
- vvvv(Debug)
## 2. State Manager Walkthrough
### Example Setup nginx
vi nginx.yml
```angularjs
- hosts: local
  connection: local
  become: yes
  become_user: root
  tasks:
   - name: Install Nginx
     apt:
       name: nginx
       state: installed
       update_cache: true
     notify:
      - Start Nginx
 
  handlers:
   - name: Start Nginx
     service:
       name: nginx
       state: started
```
Run play box
```angularjs
ansible-playbook nginx.yml
```

## Setup Control Machine
Generate ssh-key
```angularjs
ssh-keygen
```

Declare file inventory
```angularjs
 vi /etc/ansible/hosts
```
```angularjs
[webserver]
ami ansible_ssh_user=centos ansible_ssh_port=2222 ansible_ssh_host=13.250.42.76
```
List option
- ansible_ssh_private_key_file
- ansible_ssh_user
- ansible_ssh_port

Check list host
```angularjs
ansible all --list-hosts
```

Copy to node
```angularjs
ssh-copy-id -i ~/.ssh/mykey user@host
# or
cat ~/.ssh/id_rsa.pub | ssh -i fec.pem centos@13.250.42.76 -p 2222 "cat - >> ~/.ssh/authorized_keys2"
```

Ping to local
```angularjs
ansible -i ./hosts --connection=local all -m ping
```

Ping to server
```angularjs
 ansible -i hosts ami -m ping
```

Check setup
```angularjs
ansible -i hosts all  -m setup
```

Run command to node
```angularjs
ansible -i hosts all -m service -a "name=httpd state=started"
ansible -i ./hosts ami -b --become-user=root -m shell -a "touch /var/www/xyz.abc"
```

PlayBoook
```angularjs
ansible-playbook -i ./hosts {playbook file name}.yml 
```

Create Role
```angularjs
ansible-galaxy init {roleName}
```

Select os

```

---
- hosts: all
  sudo: yes

  tasks:
    - name: Define Red Hat.
      set_fact:
         package_name: "httpd"
      when:
         ansible_os_family == "Red Hat"

    - name: Define Debian.
      set_fact:
         package_name: "apache2"
      when:
         ansible_os_family == "Debian"

    - name: Stop apache
      service:
        name: "{{ package_name }}"
        state: stopped
```


Create playbook awslog by command

Ansible-playbook init awslog

Write task is below
```
- name: "Download Install Script"
  get_url:
    url: https://s3.amazonaws.com/aws-cloudwatch/downloads/latest/awslogs-agent-setup.py
    dest: /tmp/awslogs-agent-setup.py
    mode: 550
- name: "Create /etc/awslogs"
  file:
    path: /etc/awslogs
    state: directory
    mode: 755
- name: Copy file with owner and permissions
  copy:
    src: awslogs.conf
    dest: /etc/awslogs/awslogs.conf
    mode: '0644'
- name: "Install AWS CloudWatch Logs Agent (RedHat)."
  shell: python /tmp/awslogs-agent-setup.py -n -r {{ ansible_ec2_placement_region }} -c /etc/awslogs/awslogs.conf
  args:
    creates: /etc/logrotate.d/awslogs
  nofify:
    - "Start awslogs"
    - "Enable awslogs"
```

Template awslogs.conf
```angularjs
[/var/log/messages]
datetime_format = %b %d %H:%M:%S
file = {{ log_magento_path }}
buffer_duration = 5000
log_stream_name = {instance_id}
initial_position = start_of_file
log_group_name = /var/log/messages
```

Handler after setup then start and enable awslogs
```angularjs
- name: Start awslogs
  systemd:
    state: started
    name: awslogs
- name: Enable awslogs
  systemd:
    name: awslogs
    enabled: yes
    masked: no
```

