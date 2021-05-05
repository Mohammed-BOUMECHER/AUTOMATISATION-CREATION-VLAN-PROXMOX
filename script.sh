cat interfaces1 interfaces2 >interfaces
cp interfaces interfaces2
#cp /etc/network/interfaces /etc/network/interfaces.old

# rm /etc/network/interfaces

#cp /var/www/html/gestionVLAN/interfaces /etc/network/interfaces


# service network-manager restart
# sudo ifdown --exclude=lo -a && sudo ifup --exclude=lo -a

# ssh login@nom_DNS_du_serveur_SSH
# reloads