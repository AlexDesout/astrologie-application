## À propos de l'application :


Cette application est une API sur laquelle il est possible de créer un compte utilisateur. À des informations de naissance rentrées, les signes astrologiques chinois et du zodiaque sont attribués à l'utilisateur lors de son inscription. 


### Les différentes fonctionnalités : 


- [L'affichage de tous les utilisateurs](#Laffichage-de-tous-les-utilisateurs).
- [L'affichage d'information d'un utilisateur en particulier](#Laffichage-d'information-d'un-utilisateur-en-particulier).
- [L'ajout d'un utilisateur](https://laravel.com/docs/routing).
- [La suppression d'un utilisateur](https://laravel.com/docs/routing).
- [La modification des informations d'un utilisateur](https://laravel.com/docs/routing).


### L'affichage de tous les utilisateurs


Cette route permet d'afficher tous les utilisateurs inscrits dans la base de données. De plus, cette liste d'utilisateurs fonctionne sous la forme de page. Une page peut contenir jusqu'à 10 utilisateurs.

La route permettant d'accéder à cette fonctionnalité s'écrit de la manière suivante : **Route::get('/utilisateurs')**
Il est également possible de choisir la page que l'on veut afficher en écrivant ceci : **Route::get('/utilisateurs?page=(numeroDePage)')**

Elle retourne un résultat JSON de la forme suivante : 

```
{
	"current_page": 1,
	"data": [
		{
			"pseudo": "Test",
			"signe_zodiaque": "Bélier",
			"signe_chinois": "Chèvre"
		},
		{
			"pseudo": "ok",
			"signe_zodiaque": "Bélier",
			"signe_chinois": "Chèvre"
		},
		{
			"pseudo": "Jo123",
			"signe_zodiaque": "Poissons",
			"signe_chinois": "Rat"
		},
		{
			"pseudo": "Jo12",
			"signe_zodiaque": "Sagittaire",
			"signe_chinois": "Dragon"
		},
	],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/utilisateurs?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http:\/\/127.0.0.1:8000\/api\/utilisateurs?page=1",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/127.0.0.1:8000\/api\/utilisateurs?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next &raquo;",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http:\/\/127.0.0.1:8000\/api\/utilisateurs",
	"per_page": 10,
	"prev_page_url": null,
	"to": 6,
	"total": 6
}

```

### L'affichage d'information d'un utilisateur en particulier

Cette route permet d'afficher les informations d'un utilisateur inscrit dans la base de données. La recherche se fait à partir de l'id de l'utilisateur qui sera saisi dans l'URL.

La route permettant d'accéder à cette fonctionnalité s'écrit de la manière suivante : **Route::get('/utilisateurs/idUtilisateur')**

Elle retourne un résultat JSON de la forme suivante : 

```
[
	{
		"pseudo": "Bertrand",
		"signe_zodiaque": "Vierge",
		"signe_chinois": "Singe",
		"jour": 5,
		"mois": 9,
		"annee": 1920
	}
]

```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
