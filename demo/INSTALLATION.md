# Installer la démonstration Canvix

[← Retour à la présentation du projet](../README.md)

Ce guide permet de consulter le projet sur votre ordinateur avec ses contenus, ses images et ses réglages de présentation.

**Parcours recommandé :** utiliser l'archive compilée du thème. Elle contient déjà les styles et les scripts ; Node.js et Vite ne sont pas nécessaires pour la consulter.

## Avant de commencer

- Installer [Local](https://localwp.com/), qui fournit l'environnement WordPress, PHP et la base de données.
- Télécharger [l'archive compilée Canvix](https://github.com/kevenBZH/canvix/raw/refs/heads/master/demo/canvix-demo-theme.zip).
- Prévoir un **nouveau site WordPress**, sans contenus personnalisés, médias, menus ni groupes ACF. Les pages et articles créés par défaut par WordPress peuvent rester en place.

## 1. Créer le site WordPress

1. Dans Local, créer un nouveau site, par exemple `canvix-demo`.
2. Choisir une installation WordPress classique, sans multisite, et noter les identifiants administrateur saisis pendant la création.
3. Démarrer le site, puis cliquer sur **WP Admin** pour accéder à son administration.

## 2. Ajouter le thème et l'extension ACF

Dans l'administration WordPress :

1. Ouvrir **Apparence → Thèmes → Ajouter un thème**, puis cliquer sur **Téléverser un thème**.
2. Sélectionner le fichier `canvix-demo-theme.zip` téléchargé, **sans le décompresser**, puis cliquer sur **Installer maintenant**.
3. Une fois l'installation terminée, cliquer sur **Activer** pour utiliser Canvix.
4. Ouvrir **Extensions → Ajouter une extension** et rechercher **Advanced Custom Fields**.
5. Installer et activer cette extension, dans sa version gratuite.

WordPress place automatiquement le thème, les fichiers compilés et les contenus de démonstration dans le bon dossier.

## 3. Configurer le chargement des styles et des scripts

Dans Local, sélectionner le nouveau site et cliquer sur **Go to site folder** pour ouvrir ses fichiers. Ouvrir `app/public/wp-config.php` avec un éditeur de texte ou de code. Rechercher la définition de `WP_DEBUG` et vérifier qu'elle vaut `false` :

```php
define('WP_DEBUG', false);
```

Si elle vaut déjà `false`, aucune modification n'est nécessaire. Sinon, modifier la définition existante ; ne pas en ajouter une seconde.

Le thème utilisera alors les fichiers compilés du dossier `dist`.

## 4. Importer la démonstration

1. Dans Local, sélectionner le nouveau site et cliquer sur **Open site shell**. Cette action ouvre un terminal disposant de la commande WordPress `wp`.
2. Vérifier que le terminal se trouve dans le dossier `app/public` du **nouveau site**. Ce dossier contient directement `wp-config.php`, `wp-admin` et `wp-content`.

    Sous Windows, le chemin ressemble à ceci :

    ```text
    C:\Users\VotreNom\Local Sites\canvix-demo\app\public
    ```

    Si le terminal est ailleurs, utiliser la commande suivante en remplaçant le texte entre guillemets par le chemin complet de votre dossier `app/public` :

    ```bash
    cd "chemin complet vers app/public"
    ```

3. Copier cette commande dans ce terminal, puis appuyer sur Entrée :

```bash
wp eval-file wp-content/themes/canvix/demo/import.php
```

Le script installe les groupes ACF, les contenus, les médias, les catégories et les menus. Il réassocie les images, adapte les URL et configure l'accueil, le logo et les réglages du personnalisateur. Aucun import JSON séparé n'est nécessaire.

Le message suivant confirme la réussite de l'installation :

```text
Démonstration importée : 22 contenus, 27 médias, 4 groupes ACF et 3 menus.
```

Une seconde exécution après un import réussi ne crée pas de doublons. Si l'import est interrompu après avoir commencé à créer des contenus, repartir d'un nouveau site pour réessayer.

## 5. Consulter le résultat

Dans Local, cliquer sur **Open site**. Vous devez retrouver :

- **L'accueil**, avec ses sections, ses images et les témoignages.
- **L'archive des projets**, à l'adresse `/projects/`, avec quatre réalisations.
- **Les pages individuelles**, accessibles depuis les cartes, avec les informations du projet, le contenu et les autres réalisations. Le projet « Web UI design » présente notamment une galerie.

Les pages About et Contact fournies servent aux contenus et aux menus. Le périmètre intégré comprend l'accueil, l'archive et les pages individuelles des projets.

## En cas de difficulté

| Problème | Vérification à effectuer |
| --- | --- |
| Canvix n'apparaît pas dans les thèmes | Vérifier que `style.css` est directement dans `wp-content/themes/canvix/`, sans dossier supplémentaire. |
| Le site apparaît sans styles | Vérifier la présence de `dist/theme.css` et `dist/theme.js`, puis la valeur `false` de `WP_DEBUG`. |
| La commande `wp` est introuvable | Ouvrir **Open site shell** depuis Local, plutôt qu'un terminal ordinaire. |
| Le fichier `import.php` est introuvable | Exécuter la commande depuis `app/public` et vérifier la présence de `wp-content/themes/canvix/demo/import.php`. |
| L'import demande d'activer Canvix et ACF | Vérifier leur activation dans l'administration du nouveau site et utiliser un WordPress sans multisite. |
| L'import indique que des contenus existent déjà | Utiliser un nouveau site ; le script refuse d'importer sur un site déjà personnalisé. |
| Une page projet renvoie une erreur 404 | Dans WordPress, ouvrir **Réglages → Permaliens**, puis cliquer sur **Enregistrer les modifications**. |

<details>
<summary><strong>Alternative : installer depuis les sources GitHub</strong></summary>

Le téléchargement du code source ne contient pas le dossier `dist`, qui est ignoré par Git. Pour ce parcours, installer Node.js **22.12 ou ultérieur**, avec npm.

Télécharger ou cloner le dépôt, placer ses fichiers directement dans `app/public/wp-content/themes/canvix/`, puis ouvrir un terminal **dans ce dossier du thème**, celui qui contient `package.json`.

Exécuter :

```bash
npm ci
npm run build
```

Vérifier que `dist/theme.css` et `dist/theme.js` ont été générés. Dans WordPress, activer Canvix via **Apparence → Thèmes**, puis installer et activer ACF comme indiqué à l'étape 2. Reprendre ensuite à l'étape 3. Pour l'import de l'étape 4, utiliser le shell Local à la racine WordPress, et non le terminal resté dans le dossier du thème.

</details>

<details>
<summary><strong>Contenu du paquet et environnement vérifié</strong></summary>

| Élément | Contenu |
| --- | --- |
| `acf-fields.json` | Quatre groupes de champs ; le script adapte leurs règles d'affichage au nouveau site. |
| `content.json` | 22 contenus publiés, valeurs ACF, catégories, menus et réglages de présentation. |
| `media/` | 27 médias et leurs variantes de taille. |
| `import.php` | Script d'installation qui réassocie les identifiants et adapte les URL. |

Les contenus utilisent un format JSON propre à cette démonstration. `content.json` s'importe avec le script fourni, pas avec **Outils → Importer → WordPress**.

L'export ne contient ni comptes utilisateurs, ni mots de passe, ni configuration de base de données. Les contenus importés sont attribués à un administrateur déjà présent sur le nouveau site.

La démonstration a été vérifiée avec **WordPress 7.1.3, ACF 6.8.10 et PHP 8.2.29**. Ces versions décrivent l'environnement de test, pas des versions minimales garanties.

</details>
