<img src="https://raw.githubusercontent.com/FranklinBerger/genderwatch/master/graphic/logo.png" width="300" align="right">

# GenderWatch Protocole

## Introduction

Pour luter contre le sexisme systémique en réunion, voici un outil permettant de mesurer simplement et efficacement les
temps de parole. Projet original de la [Jeunesse Socialiste Suisse](https://www.juso.ch/fr/) sur http://genderwatch.ch/
et refabriqué par Franklin de la [Grève du Climat Vaud](https://vaud.climatestrike.ch/) sur http://217.119.157.21/.

## Utilisation

L'utilisation peut se faire directement sur http://217.119.157.21/, serveur dédié basé
sur [RaspberryPi 3B+](https://www.raspberrypi.org/products/raspberry-pi-3-model-b-plus/)
sur [Raspbian 2020-02-13](https://www.raspberrypi.org/downloads/raspbian/) avec [Apache2](https://httpd.apache.org/)
, [MariaDB](https://mariadb.org/) et [PHP7](https://www.php.net/). Pour obtenir des accès, veuillez envoyer un mail à
vaud@climatestrike.ch avec un nom d'utilisat·eur·rice et un mot de passe hashé en [SHA256](https://www.sha256.fr/).
Autrement, il est évidemment possible de récupérer les sources et d'initialiser vous-même votre serveur. Au niveau de la
base de donnée, un fichier SQL permet de l'initialiser simplement. De base, un compte root@root y est implémenté et
permet d'avoir une vue totale sur le système (pensez à modifier le nom d'utilisat·eur·rice ainsi que le mot de passe via
SQL directement ou P.Ex: [PHPMyAdmin](https://www.phpmyadmin.net/)).
