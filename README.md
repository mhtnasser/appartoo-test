# appartoo-test

## Prérequis
L'application est installée avec docker et docker compose, ces outils sont nécessaires pour utiliser l'application. 

Assurez-vous que vous n'avez aucun service qui est sur les ports 82 et 8081 avant de poursuivre l'installation.

## Installation
Clonez le repository

~~~
git clone https://github.com/mhtnasser/appartoo-test.git
~~~

L'installation est très simple. 

1. Placez vous sur le projet 
~~~
- cd appartoo-test
~~~
2. Exécutez le ficher docker compose
~~~
- docker-compose up -d --build
~~~

3. Exécutez composer
~~~
- docker-compose exec php composer install
~~~

4. Installation des fixtures 
~~~
-  php bin/console doctrine:fixtures:load
~~~

Une fois les conteneurs prêts et démarrés, ouvrez l'url http://localhost:8082 dans le navigateur. 


## Base de donnée
Pour accéder à la base donnée ouvrez l'url http://localhost:8081

~~~
Server = db
Username = root
Password = root
database = appartoo	
~~~

## Utilisation du site

Jeux de donnés utilisateurs 
~~~
Extraterrestre: 
- login :Grood N0
- mdp : pass0


Fonctionnaliter partie user (ROLE_USER)
~~~
- Inscription / Connexion /deconnexion
- Faire une recherche d'extraterrestre
- Voir la lister des Extraterrestre amis 
- Supprime un extraterrestre de la liste d'amis 
~~~


