# Site du camion gourmand

**Dépendances**

- Node
- Livereload ( extension Chrome )

**Environnement**

- Préprocesseur : Gulp

**Installation**

FRONT :

- npm install ( dépendances )
- gulp ( dev )
- gulp build ( prod )

BACK :

- Déclarer hosts ( ex : camion.dev )
- Installer base de donnée ( camion.sql )
- Modifier les entrées ( siteurl/home ) de la table wp_options par votre référence.

###Wordpress ( Gestion du contenu )

**Fonctionnement :**
* Modele de page :
    * Style
    * Type
        * Si : Type == Texte
            * Titre
            * Texte
        * Si Type == Image
            * Image
        * Si Type == Liste de recette
            * Choix de la liste
        
        
* Liste Menus => Custom post type : 
    
    * Titre de la section ( ex : Les burgers )
    * Sous éléments (ex : Waf Waf ) :
         
         * Titre de l'élément
         * Description
         * Prix
         * Formule ( Vrai / Faux )
         * Si formule : Prix => Dessert - Boisson
         
* Descriptions :
    
