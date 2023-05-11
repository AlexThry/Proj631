# Proj631

## TodoList

Des trucs à faire :

 - Dans classes/Database.php faire une méthode pour récupérer le top 10 des livres
 - Dans classes/Database.php pour la méthode `get_sorted_books`: corriger bug quand on veux trier avec `genre` (il faut gérer la jointure de table dans ce cas) => visible si vous triez par genre sur le site
 - Mettre à jour la base de données pour administer les cercles d'amis (un cercle d'amis est créer par un membre (on peut s'y abonner), il a un nom, il a une liste de livre)
 - Dans classes/Database.php get_single_book faire en sorte de pouvoir récupérer tous les avis avec les notes ainsi que le note moyenne

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
 - Quand vous déclarez une classe en PHP, vérifiez si elle n'a pas déjà été déclarée.

## Sécurité

Veillez à échapper les entrées et sorties avec la function `htmlentities`.
Les mots de passe sont hashés avec la fonction `md5`.
Veillez à prendre la dernière version de la base de donnée (les mots de passes natifs sont 'root').

## Pour contribuer

Ajouter `feature:`, `fix:` ou `clean:` au début de vos messages de commit.
