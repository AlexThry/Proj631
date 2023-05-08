# Proj631

## TodoList

Des trucs à faire :

 - Dans core/connection-helpers.php : `subscribe_user` faire en sorte de connecter l'utilisateur quand on cree son compte (en gérant les erreurs éventuelles)
 - Dans core/connection-helpers.php : `connect_user` vérifier l'unicité du username (en gérant les erreurs éventuelles)
 - Dans classes/Database.php faire une méthode pour récupérer le top 10 des livres
 - Dans classes/Database.php pour la méthode `get_sorted_books` pouvoir trier les livres par note en faisant la moyenne
 - Dans classes/Database.php pour la méthode `get_sorted_books`: corriger bug quand on veux trier avec `genre` (il faut gérer la jointure de table dans ce cas) => visible si vous triez par genre sur le site

## Architecture

 - `.` la racine contient les pages html, les fichiers de configuration et un exemple de contenu de la base de donnée (`proj631.md`).
 - `includes` contient des bouts de code html réutilisable.
 - `core` contient des fonctions et scripts s'occupant de la logique du site (soumission de formulaire, redirection, rooting, ...) 

## Normalisation

 - Si vous écrivez du JavaScript déclencher le script comme ceci
````js
document.addEventListener('DOMContentLoaded', function() {
    // your code here...
});
````
 - Veillez à écrire votre code en anglais.
 - Mettez une majuscule à vos noms de classe php.
 - Ne fermez pas php à la fin d'un fichier si il est ouvert.
 - 99.99% du temps, une méthode ou fonction doit commencer par un verbe.
 - en `php` écrire en snake_case.

## Sécurité

Veillez à échapper les entrées et sorties avec la function `htmlentities`.
Les mots de passe sont hashés avec la fonction `md5`.
Veillez à prendre la dernière version de la base de donnée (les mots de passes natifs sont 'root').

## Pour contribuer

Ajouter `feature:`, `fix:` ou `clean:` au début de vos messages de commit.
