/* ETAPES DU PROJET */ 

1. Création du MCD de la base de données:
    1  Entitées sans lien:
        1. Entitée "Hobbies" -------------------------------------------------------- => Fait
        2. Entitée "Presentations" -------------------------------------------------- => Fait
        3. Entitée "Users" ---------------------------------------------------------- => Fait
    2. Entitées en lien pour les informations du site:
        1. Entitée "Website" -------------------------------------------------------- => Fait
        2. Entitée "UpdateWebsite" -------------------------------------------------- => Fait
    3. Entitées en lien pour les réalisations:
        1. Entitée "Achievements" --------------------------------------------------- => Fait
        2. Entitée "Establishments" ------------------------------------------------- => Fait
        3. Entitée "PictureAchievements" -------------------------------------------- => Fait
        4. Entitée "WebTechnologies" ------------------------------------------------ => Fait
    4. Entitées en lien pour les parcours porfessionnel:
        1. Liens vers l'entitée "Establishements" ----------------------------------- => Fait
        2. Entitée "ProfessionnalCareers" ------------------------------------------- => Fait
GIT => Fait

2. Configuration et création de la base de données:
    1. Configuration de la base de données dans le fichier ".env" ------------------- => Fait
    2. Création de la base de données ----------------------------------------------- => Fait
GIT => Fait

3. Configuration du server dns mailer dans le fichier ".env" ------------------------ => Fait
GIT => Fait

4. Création et migration des entitées:
    1  Entitées sans lien:
        1. Entitée "Hobbies" -------------------------------------------------------- => Fait
        2. Entitée "Presentations" -------------------------------------------------- => Fait
        3. Entitée "Users" ---------------------------------------------------------- => Fait
    2. Entitées en lien pour les informations du site:
        1. Entitée "Website" -------------------------------------------------------- => Fait
        2. Entitée "UpdateWebsite" -------------------------------------------------- => Fait
    3. Entitées en lien pour les réalisations:
        1. Entitée "Achievements" --------------------------------------------------- => Fait
        2. Entitée "Establishments" ------------------------------------------------- => Fait
        3. Entitée "PictureAchievements" -------------------------------------------- => Fait
        4. Entitée "WebTechnologies" ------------------------------------------------ => Fait
    4. Entitées en lien pour les parcours porfessionnel:
        1. Liens vers l'entitée "Establishements" ----------------------------------- => Fait
        2. Entitée "ProfessionnalCareers" ------------------------------------------- => Fait
GIT => Fait

5. Création de fixture de donnée:
    1. Installation du bundle "symfony data fixtures"-------------------------------- => Fait
    2. Installation du bundle "phpfaker"--------------------------------------------- => Fait
    3. Creation d'une fixture pour le compte "admin" -------------------------------- => Fait
    4. Création d'une fixture pour la présentation ---------------------------------- => Fait
    5. Création d'une fixture pour les informations du site ------------------------- => Fait 
    6. Création d'une fixture pour la mise à jour du site --------------------------- => Fait
    7. Mise en plage des données de fixture dans la base de données ----------------- => Fait
GIT => Fait

6. Création de service twig:
    1. Création et configuration du service twig "Presentation" --------------------- => Fait
    2. Création et configuration du service twig "Website" -------------------------- => Fait
    3. Configuration du fichier "twig.yaml" ----------------------------------------- => Fait
GIT => Fait

7. Installation et configuration de "Webpack Encore":
    1. Installation de "Webpack Encore" --------------------------------------------- => Fait
    2. Configuration de "Webpack Encore" -------------------------------------------- => Fait
GIT => Fait

8. Création des fichiers de customisation scss:
    1. Création du fichier "_var.scss" contenant les variable de couleur ----------- => Fait
    2. Création du fichier "_global.scss" contenant les balises générale ----------- => Fait
    3. Création du fichier "_nav.scss" contenant les balises de la div "nav" ------- => Fait
    4. Création du fichier "_main.scss" contenant les balises de la div "main" ----- => Fait
    5. Création du fichier "_footer.scss" contenant les balises de la div "footer" - => Fait
GIT => Fait

9. Installation et configuration de Bootstrap:
    1. Installation de Bootstrap icon ---------------------------------------------- => Fait
    2. Installation de Bootstrap scss ---------------------------------------------- => Fait
    3. Configuration de Bootstrap scss --------------------------------------------- => Fait
GIT => Fait

10. Configuration du fichier "app.scss": ------------------------------------------- => fait
GIT => Fait

11. Création et configuration du controleur "BasicPages":
    1. Création du controleur ------------------------------------------------------ => Fait
    2. Modification du controleur -------------------------------------------------- => Fait
GIT => Fait

12. Création et configuration du controleur "AdminPages":
    1. Création du controleur ------------------------------------------------------ => Fait
    2. Modifier du controleur ------------------------------------------------------ => Fait
GIT => Fait

13. Modification du fichier "base.html.twig" --------------------------------------- => Fait
GIT => Fait

14. Création du fichier "base_admin.html.twig" ------------------------------------- => Fait
GIT => Fait

15. Création du contenu et du design des fichiers :
    1. Fichier "base.html.twig":
        1. Configuration de "body" ------------------------------------------------- => Fait
        2. Ajout et configuration de la section "nav" ------------------------------ => Fait
        3. Ajout de la section "main" ---------------------------------------------- => Fait
        4. Ajout et configuration de la section "footer" --------------------------- => Fait
        5. Ajout d'un bouton de revoie vers le haut de la page --------------------- => Fait
    GIT: Fait

    2. Fichier "index.html.twig" du dossier "basic_pages":
        1. Ajout et configuration de la section "Presentation" --------------------- => Fait
        2. Ajout et configuration de la section "Achievements" --------------------- => Fait
        3. Ajout et configuration de la section "Preferred technologies" ----------- => Fait
        4. Ajout et configuration de la section "Hobbie" --------------------------- => Fait
        5. Ajout et configuration de la section "Contact Me" ----------------------- => Fait
    
    3. Création et configuration "Contact Me":
        1. Création du formulaire -------------------------------------------------- => Fait
        2. Template du formulaire -------------------------------------------------- => Fait
        3. Template email ---------------------------------------------------------- => Fait
        4. Traitement du formulaire dans le controler ------------------------------ => Fait
    GIT: Fait

    4. Fichier "index.html.twig" du dossier "basic_pages":
        1. Ajout et configuration de la section "Website" -------------------------- => Fait
        2. Ajout et configuration de la section "Regulation" ----------------------- => Fait
    GIT: Fait

    5. Création et configuration de la partie "Identification":
        1. Création du service ----------------------------------------------------- => Fait
        2. Configuration du service ------------------------------------------------ => Fait
        3. Modification du ficher "base.html.twig" --------------------------------- => Fait
        4. Template du fichier identification -------------------------------------- => Fait 
    GIT: Fait

    6. Fichier "Base_admin.html.twig"
        1. Configuration de "body" ------------------------------------------------- => Fait
        2. Ajout et configuration de la section "nav" ------------------------------ => Fait
        3. Ajout de la section "main" ---------------------------------------------- => Fait
        4. Ajout d'un bouton de revoie vers le haut de la page --------------------- => Fait
    GIT: Fait

16. Ajout et configuration de Ckeditor:
    1. Installation de Ckeditor --------------------------------------------------- => Fait
    2. Configuration de Ckeditor -------------------------------------------------- => Fait
GIT: Fait

17. Création et configuration CRUD:
    1. Crud "Hobbies":
        1. Création du crud ------------------------------------------------------- => Fait
        2. Configuration twig ----------------------------------------------------- => Fait
        3. Configuration du formulaire -------------------------------------------- => Fait
        4. Configuration du controler --------------------------------------------- => Fait
        5. Configuration des template --------------------------------------------- => Fait
    GIT: Fait

    2. Crud "Presentations":
        1. Création du crud ------------------------------------------------------- => Fait
        2. Configuration twig ----------------------------------------------------- => Fait
        3. Configuration du controler --------------------------------------------- => Fait
        4. Configuration du formulaire -------------------------------------------- => Fait
        5. Configuration des template --------------------------------------------- => Fait
    GIT:Fait

    3. Crud "UpdateWebsites":
        1. Création du crud ------------------------------------------------------- => Fait
        2. Configuration twig ----------------------------------------------------- => Pas à faire
        3. Configuration du controler --------------------------------------------- => Fait
        4. Configuration du formulaire -------------------------------------------- => Fait
        5. Configuration des template --------------------------------------------- => Fait
    GIT:Fait

    4. Crud "Websites":
        1. Création du crud ------------------------------------------------------- => Fait
        2. Configuration twig ----------------------------------------------------- => Pas à faire
        3. Configuration du controler --------------------------------------------- => Fait
        4. Configuration du formulaire -------------------------------------------- => Fait
        5. Configuration des template --------------------------------------------- => Fait
    GIT:Fait

    5. Crud "Establishements":
        1. Création du crud ------------------------------------------------------- => Fait
        2. Configuration twig ----------------------------------------------------- => Fait
        3. Configuration du controler --------------------------------------------- => Fait
        4. Configuration du formulaire -------------------------------------------- => Fait
        5. Configuration des template --------------------------------------------- => Fait
    GIT:Fait