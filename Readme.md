
# Are you blinded ?
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/license/mit)

## Description du projet

"Are you blinded ?" est une application web réalisé dans le cadre d'un projet pour le cours de développement web au CNAM de Toulon.

L'objectif de ce projet était de réaliser une application de blindtest en utilisant les différentes technologies énumérés en cours.

Notre application permet donc de créer des blindtest et d'y jouer seul ou à plusieurs. Chaque blindtest doit être créer avec un nom, une description ainsi que des questions. Ces questions sont composés d'une URL youtube faisant référence à la musique souhaité. Ainsi qu'une réponse associé.

Ce projet à été réalisé sans utilisé de librairies PHP ni de framework. Un framework maison à été réalisé pour faciliter le développement et respecter les containtes imposés par le projet.

## Prérequis

<a href="https://nodejs.org/en">
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Node.js_logo.svg" alt="Node.JS"  width="200" height="100">
</a>
<a href="https://www.php.net/">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" alt="PHP"  width="200" height="100">
</a>
<a href="https://mariadb.org/">
  <img src="https://julien.io/content/images/size/w600/2020/07/mariadb-logo-vert_blue-transparent.png" alt="MariaDB"  width="200" height="100">
</a>

PHP 8.1 pour l'application
Node.JS pour le serveur web-socket
MariaDB pour la base de donnée

## Cloner et développer sur l'application

Cloner le projet dans le dossier de votre choix avec la commande suivante.
```bash
git clone git@github.com:NezaelHD/blindtest-project.git
```
### Docker

Le projet étant dockerisé il est possible d'utiliser Docker pour faciliter le développement.
Pour se faire se placer à la racine du projet et exécuter la commande suivante :
```bash
docker compose up
```

Le projet devrait être lancé et fonctionnel si vous ne voyez pas d'erreurs particulières dans les logs de la console.

### LAMP

Si vous souhaitez développer sur l'application de manière plus traditionnel, il vous est possible d'installer l'application sur un serveur LAMP local grâce à XAMP, WAMP, MAMP etc... Ou bien en installant Apache, MariaDB et PHP sur votre machine linux.

Une fois fait vous devrez configurer vos virtuals hosts d'apache pour pointer sur le dossier du projet.

Il vous faudra créer une base de donnée. Pour créer les différentes tables du projet, vous pouvez copier coller dans PhpMyAdmin le script `init-db.sql` qui se trouve dans le dossier `Docker/db/init-db.sql`.

Après celà votre base de donnée sera prête à être utilisé. Il ne vous manquera plus qu'à définir les différents identifiants de connexion à cette base dans le fichier `src/app/config/database_config.php`.
Certaines constantes doivent également être défini, il faut les changer dans `src/app/config/constants.php`
Notre projet utilise composer pour générer un autoload qui est vitale pour notre application. Il vous faudra donc installer composer également si ce n'est pas déjà fait. Une fois installé, placez vous à la racine de l'application et exécutez la commande
```bash
composer install
```
L'autoload sera généré.

En plus de l'installation de PHP, MariaDB et Apache, il vous faudra installer Node.js pour pouvoir jouer aux différents blindtest.

Une fois installé, il vous suffira de vous rendre dans le dossier `./node-server`. Une fois fait, vous lancerez la commande
```bash 
npm install
```
pour installer toutes les dépendances nécessaires au bon fonctionnement du serveur. Une fois fait il vous suffira d'effectuer la commande
```bash
npm run start
``` 
pour lancer le serveur. La configuration du port du serveur de websocket se fait dans `node-server/.env`. Si vous n'avez pas le fichier `.env` dans le dossier, faites une copie du fichier `.env.example`en `.env`et modifier les valeurs du fichier nouvellement créé.


## Déployer l'application sur un hébergeur (exemple d'Always Data)

Pour cette exemple de déploiement, nous prendrons l'exemple d'un projet déjà initialisé pour du développement.

Pour déployer l'application chez un hébergeur, il faudra vous munir d'un outil permettant de faire du FTP comme FileZilla.

Une fois les identifiants FTP récupérer auprès de votre hébergeur, vous pourrez les rentrer dans FileZilla pour avoir accès au serveur. Il vous faudra glisser l'entiereté de l'application dans le serveur excepté le dossier `node-server`, le .gitignore ainsi que les fichiers/dossiers relatifs à docker.

Il vous faudra par la suite créer une base de donnée chez votre hébergeur. Une fois créer il vous suffira de réaliser un export de votre base de donnée de développement pour l'importer dans votre base de donnée de production. Celà vous permettra d'avoir toutes les tables.

Les fichiers de configurations mentionnés dans la sections LAMP devront également être modifier pour correspondre aux informations de l'hébergeur.

Une fois ces opérations effectuées le site est accessible. Cependant les blindtest ne pourront pas être jouer car il manque le serveur de web-socket.

Pour installer le serveur de websocket il faut créer un nouveau site sur Always Data en parallèle de celui pour PHP. Lors de la création il faudra sélectionner Node.JS comme type de serveur.

Se connecter en FTP à ce site là et glisser le contenu du dossier node-server dans la racine du serveur.

Vous pourrez par la suite configurer dans l'interface d'Always Data la commande à lancé pour maintenir le serveur en vie.

## Documentation utilisateur

L'application comporte plusieurs pages, voici la liste de celles-ci :
- Page d'accueil ('/')
- Page de connexion ('/login')
- Page d'inscription ('/register)
- Page de profil ('/profil' => Requiert d'être connecté)
- Page de Réinitialisation de mot de passe ('/resetPassword')
- Page d'administration ('/admin' => Réserver aux administrateurs)
- Page de jeu ('/play/{id de la salle de jeu}' => Requiert d'être connecté)
- Page de visualisation des scores d'un blinstest ('/scoreboard/{id du blindtest})
- Lien de déconnexion ('/logout')

Pour pouvoir jouer, il est nécessaire de créer un compte.
Les blindtests sont créer par les administrateurs de l'application.
Il est possible de rejoindre une partie multijoueur à l'aide d'un id fournit par un ami par exemple.
Il est possible de créer une partie multijoueur sur un blindtest au choix. Ce qui donnera la possibilité à la personne de partager ou non le code de la salle de jeu.

## Crédits

Cette application à été réalisé par :
- NezaelHD
- Chloe
- Zhag
