# Allow anonymous FTP? (Beware - allowed by default if you comment this out).
anonymous_enable=NO
local_enable=YES
userlist_deny=NO
userlist_enable=YES
# Virtual users will use the same privileges as local users.
# It will grant write access to virtual users. Virtual users will use the
# same privileges as anonymous users, which tends to be more restrictive
# (especially in terms of write access).
virtual_use_local_privs=YES
write_enable=YES
#Get chmod Right for Apache,This will set new uploaded files chmod to 644 and folders to 755.
file_open_mode=0666
local_umask=0022

# Set the name of the PAM service vsftpd will use
# RHEL / centos user should use /etc/pam.d/vsftpd
pam_service_name=vsftpd.virtual

# Activates virtual users
guest_enable=YES
#Specify Guest user name
guest_username=apache
# Chroot user and lock down to their home directories
chroot_local_user=NO
# User Level configuration file such as user home directory.
user_config_dir=/etc/vsftpd/user_conf
## Hide ids from user, all user and group information in directory listings will be hidden
hide_ids=YES
listen=YES

#SSL Configuration
ssl_enable=YES
allow_anon_ssl=NO
force_local_data_ssl=NO
force_local_logins_ssl=YES
ssl_tlsv1=YES
ssl_sslv2=NO
ssl_sslv3=YES
ssl_ciphers=HIGH
rsa_cert_file=/etc/vsftpd/vsftpd.pem
