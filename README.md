# formation-efalia-initiation-symfony
Repository temporaire pour exporter le code des exercices de la formation donnée à Efalia (initiation). 

## Pré-requis

- PHP >= 8.2 avec [PDO sqlite configuré](https://www.php.net/manual/en/ref.pdo-sqlite.php)
- Symfony CLI 
- Composer (ou composer via la symfony CLI)

## Installation

1. Installer les dépendances avec composer :
    ```bash
    composer install
    ```
2. Lancer le serveur local avec symfony :
    ```bash
    symfony serve
    ```

🎉 Votre serveur est disponible sur [http://127.0.0.1:8000](http://127.0.0.1:8000) par défaut,
ou tout autre port indiqué par la commande `symfony serve`.

## Important

- Le code est simplifié pour la formation. Attention à ne pas utiliser ce code en production.
- Les controleurs et les commandes, par exemple, devraient déléguer leur logique à des services pour respecter les principes de qualité de code (dont SOLID).
- Des tests sont manquants (nécessite d'autres connaissances).
- Le code est en anglais, la documentation et les commentaires dans le code en français.

## Resources complémentaires aux slides et au code

- [Symfony documentation](https://symfony.com/doc/current/index.html)
- [Twig documentation](https://twig.symfony.com/)
- Nos autres formations Symfony (et plus) :
  - [Approfondir Symfony](https://les-tilleuls.coop/masterclass/formations/approfondir-symfony)
  - [Maîtriser Symfony](https://les-tilleuls.coop/masterclass/formations/maitriser-symfony)
----

Made by Vincent AMSTOUTZ pour Efalia.
