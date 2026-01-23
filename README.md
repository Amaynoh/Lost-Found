# Lost & Found – Backend (Laravel API)

## Contexte du projet
Ce projet s’inscrit dans le développement d’une application web *Lost & Found* destinée à permettre la déclaration, la consultation et la gestion d’objets perdus ou trouvés.

L’application est conçue pour des environnements tels que :
- universités
- gares
- administrations
- entreprises
Le backend fournit une API REST sécurisée consommée par un frontend React.
## Diagramme de cas d’utilisation & de classes
![Diagramme de classes]&[Diagramme de cas d’utilisation](https://miro.com/welcomeonboard/VUx4eFgvZmM1bi9ITW9SUHhod3pvYnpWMHlGZVNXaFg2QzNld3FoYkNTYTFyTStjVVluK1oyWGkyNDdHL2d1SWFKZ1VQdlc4Z0tORS9DenhZYzRGdWZlVGt2enVoNHp1TWZEMFdNamdrVHNaTWJ6ejdncGdxUERycVo2bVV5TFR0R2lncW1vRmFBVnlLcVJzTmdFdlNRPT0hdjE=?share_link_id=799311431531)

## Objectifs
- Mettre en place une API REST avec Laravel
- Implémenter une authentification sécurisée
- Gérer des rôles (`user`, `admin`)
- Permettre un CRUD complet des objets
- Appliquer des règles d’autorisation via les Policies
- Tester les fonctionnalités principales avec PHPUnit

## Technologies utilisées
- PHP 8.x
- Laravel 10
- Laravel Sanctum (authentification API)
- MySQL
- PHPUnit (tests)
- Docker / Docker Compose

## Fonctionnalités principales

### Authentification
- Inscription et connexion des utilisateurs
- Attribution automatique du rôle `user`
- Authentification par token (Sanctum)

### Gestion des objets
- Déclaration d’objets perdus ou trouvés
- Consultation de la liste des objets
- Filtrage par type et lieu
- Modification et suppression selon les droits

### Autorisation
- Gestion des droits via Policies
- L’utilisateur peut gérer uniquement ses propres objets
- L’administrateur dispose d’un accès global

## Rôles
- **User** : gérer ses propres déclarations
- **Admin** : gérer toutes les déclarations

## Architecture
- Controllers : gestion des requêtes HTTP
- Requests : validation des données
- Policies : règles d’autorisation
- Tests Feature : tests des endpoints API

## Tests
Les tests unitaires et fonctionnels sont implémentés avec PHPUnit.
php artisan test

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
