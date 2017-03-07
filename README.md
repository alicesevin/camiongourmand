# Site du camion gourmand

**Dépendances**

- Node
- Livereload ( extension Chrome ) pour hot reload
- Jquery
- TweenMax ( animations )

**Support**
- IE 11 animations
- IE 10 hors animations spécifiques

**Environnement**

- TaskRunner : Gulp
- Préprocesseur : Sass via Scss

**Installation**

FRONT :

- npm install ( dépendances )
- gulp ( dev )
- gulp build ( prod )

BACK :

- Déclarer hosts ( ex : camion.dev ) et si besoin http.vhosts.conf via MAMP ou autres environnements
- Installer base de donnée ( camion.sql présente à la racine)
- Modifier les entrées ( siteurl/home ) de la table wp_options par votre référence si hosts différents de camion.dev.
- Télécharger le zip uploads.zip et le le dézipper dans un folder /uploads dans wp-content ( version non administrée directement pour cause de poids )
- Updater les permaliens dans réglages/permaliens avec nom de l'article comme référence.
- Si conflit, supprimer le .htaccess à la racine
