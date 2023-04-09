# À propos de l'application :


Cette application est une API sur laquelle il est possible de créer un compte utilisateur. À partir des informations de naissance rentrées, les signes astrologiques chinois et du zodiaque sont attribués à l'utilisateur lors de son inscription. 


## Les différentes fonctionnalités : 


- [L'affichage de tous les utilisateurs](#Laffichage-de-tous-les-utilisateurs).
- [L'affichage d'information d'un utilisateur en particulier](#Laffichage-dinformation-dun-utilisateur-en-particulier).
- [L'ajout d'un utilisateur](#Lajout-dun-utilisateur).
- [La suppression d'un utilisateur](#La-suppression-dun-utilisateur).
- [La modification des informations d'un utilisateur](#La-modification-des-informations-dun-utilisateur).


## L'affichage de tous les utilisateurs


Cette route permet d'afficher tous les utilisateurs inscrits dans la base de données. De plus, cette liste d'utilisateurs fonctionne sous la forme de **page**. Une page peut contenir jusqu'à **10 utilisateurs**.

La route permettant d'accéder à cette fonctionnalité s'écrit de la manière suivante : **Route::get('/utilisateurs')**

Il est également possible de choisir la page que l'on veut afficher en écrivant ceci : **Route::get('/utilisateurs?page=numeroDePage')**

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

## L'affichage d'information d'un utilisateur en particulier

Cette route permet d'afficher les informations d'un utilisateur inscrit dans la base de données. La recherche se fait à partir de **l'id** de l'utilisateur qui sera saisi dans l'URL.

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

## L'ajout d'un utilisateur

Cette fonctionnalité permet d'ajouter un utilisateur dans la base de données. Il est impossible de créer un compte si le **pseudo** et **l'adresse mail** sont déjà existant dans la base de données. Pour utiliser celle-ci, il faudra s'authentifier avec des informations valides se trouvant dans la table **user**. Sinon vous n'aurez pas la permission de faire votre requête.

La route permettant d'accéder à cette fonctionnalité s'écrit de la manière suivante : **Route::post('/utilisateurs')**

Voici un exemple de requête pour ajouter un utilisateur : 

```
{
  "pseudo": "Adrien",
  "mail": "Adrien@gmail.com",
  "mdp": "motdepasse",
  "jour": 5,
  "mois" : 9,
  "annee" : 1920
}

```

À partir du jour et du mois de naissance, l'application trouve le signe du zodiaque de l'utilisateur. Il en fait de même à partir de l'année pour trouver son signe astrologique chinois.

## La suppression d'un utilisateur

Cette fonctionnalité permet de supprimer un utilisateur de la base de données à partir de son **id**. De la même manière que la fonctionnalité précédente, vous devrez vous **authentifier** pour pouvoir supprimer un utilisateur de cette table.

La route permettant d'accéder à cette fonctionnalité s'écrit de la manière suivante : **Route::delete('/utilisateurs/idUtilisateur')**

Si la suppression a fonctionné, un code de la forme suivante sera retourné : 

```
{
	"status": 1,
	"message": "Supprimé",
	"data": {
		"id": 11,
		"pseudo": "Bertrand",
		"mail": "Bertrand@gmail.com",
		"mdp": "Salut1111",
		"signe_zodiaque": "Vierge",
		"signe_chinois": "Singe",
		"jour": 5,
		"mois": 9,
		"annee": 1920,
		"created_at": "2023-04-08T18:18:54.000000Z",
		"updated_at": "2023-04-09T14:40:08.000000Z"
	}
}

```

## La modification des informations d'un utilisateur

Cette fonctionnalité permet de modifier les informations d'un utilisateur se trouvant dans la base de données. Cela se fait uniquement à partir des **données saisies dans la requête** de modification. Pour cette fonctionnalité également, vous devez vous **authentifier**.

La route à utiliser est la suivante : **Route::put('/utilisateurs')**

Voici un exemple de requête pour modifier un utilisateur : 

```
{
	"id" : 21,
	"pseudo": "Albert",
	"mail" : "albert@gmail.com",
	"mdp" : "albert1234*",
	"jour" : 2,
	"mois" : 10,
	"annee" : 1971
}

```



