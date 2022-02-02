/* ETAPES DU PROJET */ 

1. Création du MCD de la base de données:
    1. Entitées indépendantes:
        1. Entitée "Hobies"................................................................................=> Fait
        2. Entitée "Presentations".........................................................................=> Fait
        3. Entitée "WebsiteInformations"...................................................................=> Fait
        3. Entitée "Users".................................................................................=> Fait
    2. Entitées en lien avec les réalisations:
        1. Entitée "Achievements"..........................................................................=> Fait
        2. Entitée "Establishments"........................................................................=> Fait
        3. Entitée "WebTechnologies".......................................................................=> Fait
    3. Entitées en lien avec le parcours proffessionnel:
        1. Lien vers l'entitié "Establishments"............................................................=> Fait
        2. Entitée "ProffessionnalCareers".................................................................=> Fait
    /* GIT fait */

2. Configuration et création de la base de donnée:
    1. Configuration du fichier ".env"
        1. Configuration du dns mailer.....................................................................=> Fait
        2. Configuration de la base de données.............................................................=> Fait
    2. Création de la base de donnée.......................................................................=> Fait
    /* GIT fait */

3. Création et migration des entitées:
    1. Entitées indépendantes:
        1. Entitée "Hobies"................................................................................=> Fait
        2. Entitée "Presentations".........................................................................=> Fait
        3. Entitée "WebsiteInformations"...................................................................=> Fait
        3. Entitée "Users".................................................................................=> Fait
    2. Entitées en lien avec les réalisations:
        1. Entitée "Achievements"..........................................................................=> Fait
        2. Entitée "Establishments"........................................................................=> Fait
        3. Entitée "WebTechnologies".......................................................................=> Fait
    3. Entitées en lien avec le parcours proffessionnel:
        1. Lien vers l'entitié "Establishments"............................................................=> Fait
        2. Entitée "ProfessionnalCareers"..................................................................=> Fait
    /* GIT fait */

4. Fixtures:
    1. Installation de "datafixture".......................................................................=> Fait
    2. Création d'une fixture pour le compte admin.........................................................=> Fait
    3. Création d'une fixture pour la présentation.........................................................=> Fait
    4. Mise en place des données fixture dans la base de donnée............................................=> Fait
    /* GIT fait */

5. Services twig:
    1. Création et configuration du service twig "Presentations"...........................................=> Fait
    /* GIT fait */

6. Installation et configuration de "Webpacks Encors":
    1. Installation de "Webpacks Encors"...................................................................=> Fait
    2. Configuration de "Webpacks Encors"..................................................................=> Fait
    /* GIT fait */

7. Partie CSS:
    1. Fichier de customisation:
        1. Création du fichier des variable css de couleur "_var.scss".....................................=> Fait
        2. Création du fichier des class css globale "_global.scss"........................................=> Fait
        3. Création du fichier des class css nav "_nav.scss"...............................................=> Fait
        4. Création du fichier des class css main "_main.scss".............................................=> Fait
        5. Création du fichier des class css footer "_footer.scss".........................................=> Fait
    /* GIT fait */
    
    2. Bootstrap:
        1. Installation de Bootstrap icon..................................................................=> Fait
        2. Installation de Bootstrap scss..................................................................=> Fait
        3. Configuration de Bootstrap scss.................................................................=> Fait
    /* GIT fait */

    3. Configuration du fichier "App.scss".................................................................=> Fait
    /* GIT fait */

8. Partie controlleur "BasicPages":
    1. Création du controlleur "BasicPages"................................................................=> Fait
    2. Modification du controlleur "BasicPages"............................................................=> Fait
    3. Renomage du fichier "index.html.twig" en "home.html.twig" du dossier "basic_pages"..................=> Fait


9. Partie controlleur "AdminitrationPages":
    1. Création du controlleur "AdminitrationPages"........................................................=> Fait
    2. Modification du controlleur "AdminitrationPages"....................................................=> Fait
    3. Renomage du fichier "index.html.twig" en "dashboard.html.twig" du dossier "AdminitrationPages"......=> Fait

10. Modification du fichier "base.html.twig"...............................................................=> Fait
    /* GIT fait */
11. Création du fichier "base_administration.html.twig"....................................................=> Fait
    /* git fait */
12. Partie contenu et design:
    1. Fichier "base.html.twig":
        1. Ajout et configuration de la section "navbar"...................................................=> Fait
        2. Ajout de la section "main"......................................................................=> Fait
        3. Ajout et configuration de la section "footer"...................................................=> Fait
    /* GIT fait */

    2. Fichier "home.html.twig":
        1. Ajout et configuration de la section "Presentation".............................................=> Fait
        2. Ajout et configuration de la section "Achievements".............................................=> Fait
        3. Ajout et configuration de la section "Preferred technologies"...................................=> Fait
        4. Ajout et configuration de la section "Professionnal career".....................................=> Fait
        5. Ajout et configuration de la section "Hobbies"..................................................=> Fait 
        6. Formulaire de contact:
            1. Création du fichier "ContactMeType.php".....................................................=> Fait
            2. Création du fichier "_ContactMeFom.html.twig"...............................................=> Fait
            3. Creation du fichier "_ContactMeEmail.html.twig".............................................=> Fait
            4. Création et traitement du formulaire via le controller "BasicPagesController.php"...........=> Fait
            5. Configuration de twig pour les formulaires..................................................=> Fait
            6. Include du formulaire "home.html.twig"......................................................=> Fait
        7. Ajout et configuration de la section "contact me"...............................................=> Fait
        8. Ajouter et configuration des messages d'avertissement...........................................=> Fait
    /* GIT fait */

    3. Fichier "Base_admin.html.twig":
        1. Ajout et configuration de la section "navbar"...................................................=> Fait
    /* GIT fait */

    4. Identification:
        1. Ajout et configuration "authentification".......................................................=> Fait

13. CKeditor et gestion des images:
    1. Installation de CKeditor............................................................................=> Fait
    2. Configuration de CKeditor...........................................................................=> Fait
    3. Installation de elfinder............................................................................=> Fait
    4. Configuration de elfinder...........................................................................=> Fait

14. Partie crud:
    1. "Achievements":
        1. Création du crud................................................................................=>
        2. Modification du controleur......................................................................=>
        3. Modification du fichier "AchievementsType.php"..................................................=>
        4. Modification du fichier "_delecte_form.html.twig"...............................................=>
        5. Modification du fichier "_form.html.twig".......................................................=>
        6. Modification du fichier "edit.html.twig"........................................................=>
        7. Modification du fichier "index.html.twig".......................................................=>
        8. Modification du fichier "new.htlm.twig".........................................................=>
        9. Modification du fichier "show.html.twig"........................................................=>

    2. Ajout et configuration du Crud "Establishments".....................................................=>






