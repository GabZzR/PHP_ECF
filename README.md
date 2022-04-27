# ECF DWWM - Web Service

Vous avez 7 heures pour réaliser l'ECF.

**Vous serez évalué sur vos capacités à accomplir les contraintes fonctionnelles et techniques**

----------

## Mise en place

Clonez ce dépôt et téléversez-le sur un dépôt que vous aurez créé sur votre compte GitHub. Ou faites directement
un `fork` du dépôt sur votre compte GitHub.

Une base de données est fourni dans le fichier `ecf.sql` contenant les tables ainsi que les entrées nécessaires pour
commencer l'évaluation.

----------

## Utilisateur

Vous devez faire un CRUD sur les utilisateurs en respectant ce qui suit :

### Fonctionnel

- Lors de l'affichage de la liste des utilisateurs :
  - La route menant à cette page est `/user`.
  - La réponse doit être un json d'un tableau non associatif contenant des tableaux associatifs d'utilisateur. Chaque
  tableau d'utilisateur doit avoir une clé `id_user`, `pseudo`, `email` et `created_at`.
- Lors de l'affichage d'un utilisateur :
  - La route menant à cette page est `/user/show`.
  - L'identifiant de l'utilisateur est à récupérer en json dans les `input` de PHP. Le json contient un
  tableau associatif avec la clé : `id_user`.
  - La réponse doit être un json d'un tableau associatif de l'utilisateur. Le tableau de l'utilisateur doit avoir une
  clé `id_user`, `pseudo`, `email` et `created_at`.
  - Si aucun utilisateur existe pour l'identifiant demandé, alors la réponse doit être un json contenant `null`.
- Lors de l'ajout d'un utilisateur :
  - La route menant à cette page est `/signup`.
  - Les informations de création de l'utilisateur sont à récupérer en json dans les `input` de PHP. Le json contient un
  tableau associatif du formulaire envoyé avec les clés : `pseudo`, `email`, `pwd` et `conf_pwd`.
- Lors de l'édition d'un utilisateur :
  - La route menant à cette page est `/user/edit`.
  - Les champs `pseudo`, `email` et `pwd` sont obligatoires lors de modification d'un utilisateur. Le mot de passe est
  vérifié avant la modification, dans la base de données, de l'utilisateur.
  - Les informations d'édition de l'utilisateur sont à récupérer en json dans les `input` de PHP. Le json contient un
  tableau associatif du formulaire envoyé avec les clés : `id_user`, `pseudo`, `email`, `pwd`, `new_pwd` et `conf_new_pwd`.
- Lors de la suppression d'un commentaire :
  - La route menant à cette page est `/user/delete`.
  - L'identifiant de l'utilisateur est à récupérer en json dans les `input` de PHP. Le json contient un
  tableau associatif avec la clé : `id_user`.

### Technique

- Le code est propre, bien indenté et respectes les `PHP Standards Recommandations`.
- L'architecture MVC + DAO est respecté.
- Le `controller` qui traite la création d'un utilisateur doit être nommé `SignupController`.
- Le `controller` qui traite l'affichage, l'édition et la suppression d'un utilisateur doit être nommé `UserController`.
- Il est possible de modifier le mot de passe lors de l'édition d'un utilisateur.

----------

## Sécurisation

Lorsque vous créez un site web, il faut impérativement vérifier les données envoyées par les utilisateurs. Ici, la
personne/société qui pourrait être amené à utiliser le web service.

> Dans le cadre de cette évaluation, toute la partie `front service` sur les utilisateurs est dénué de vérification. Ce
> qui est entrée dans le formulaire ou dans la `query string` est envoyé tel quel au web service. À vous de faire les
> vérifications nécessaires lors de la réception de ces données.
>
> Cependant, il a été mis en place un système d'affichage de message d'erreur.

Lorsqu'une donnée ne correspond pas aux critères d'acceptation, vous pouvez envoyer un message d'erreur en json qui sera
ensuite affiché par le `front service`.

Les messages d'erreur devront être envoyé comme suit :

```php
array(
    "danger" => array(
        "Message d'erreur 1",
        "Message d'erreur 2",
        "Message d'erreur 3"
    )
);
```

### Fonctionnel

- La vérification des données est faite pour l'affichage d'un utilisateur.
- La vérification des données est faite pour la création d'un utilisateur.
- La vérification des données est faite pour l'édition d'un utilisateur.
- La vérification des données est faite pour la suppression d'un utilisateur.

### Technique

- La vérification des données pour la création d'un utilisateur renvoi des messages d'erreur qui s'affiche correctement.
- La vérification des données pour l'édition d'un utilisateur renvoi des messages d'erreur qui s'affiche correctement.
- Le code est propre, bien indenté et respectes les `PHP Standards Recommandations`.

----------

## Bonus : Challenge yourself

Pour vous mettre davantage au défi, trouvez un moyen de savoir si un utilisateur est authentifié et de conserver ses
données de session.

> Vous pouvez modifier le `front service` si besoin.

### Fonctionnel

- Réussir à maintenir une session du côté de `web service` au fur et à mesure de la navigation des utilisateurs du `front
service`.

### Technique

- Le code est propre, bien indenté et respectes les `PHP Standards Recommandations`.
- La fonctionnalité est sécurisée, si c'est nécessaire.

----------

## Rendu

L'ECF devra être validé par un `git commit` avant 17:00 00000 puis déposé sur GitHub et le lien du dépôt envoyé par
email à chiron.thibaut@sfr.fr.

Votre rendu devra absolument contenir une copie de votre base de données `ecf` ainsi que le travail en l'état.
