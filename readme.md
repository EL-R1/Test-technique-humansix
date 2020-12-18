# Test technique humansix

Pour ce test j'ai décidé de faire le backend et le frontend en php.

Pour installer mon projet il faut importer ma base de données "orders" se trouvant dans le dossier "config".

Ensuite vous pouvez rentrer le nom, mot de passe de votre utilisateur de votre base de données dans le fichier config.php,
se trouvant dans le dossier "config".

## Step 1 - Mise en place d'une base

Lors de la connexion avec les identifiants : 

- Login : admin
- Pass : S3cr3T+

Vous arrivez sur la page des consommateurs et il y a un bouton avec écrit "implémenter" dessus, 
en cliquant sur ce dernier vous executerez le script qui permet d'importer le script dans la base de données.

## Step 2 - Mise en place d'un front

La page de connexion vous a été présenter juste avant.

Une fois que vous êtes connecté vous pouvez vous déconnecter en cliquant 
sur le bouton "Home" de la barre de navigation.

Attention : Si vous êtes déconnecté il est impossible d'aller sur les pages du projet. (sauf pour l'api)

En étant connecté vous verrez la listes des consommateurs, vous pourrez voir aussi la liste des produits
et la liste des commandes. 

Vous pourrez modifier, supprimer un utilisateur ou un produit ce qui supprimera toutes les commandes
auxquels ils appartiennent. 

En continuant n'importe quelle commande vous avez un aperçu des produits dans cette dernière ainsi que son prix total.

Dans la liste des commandes en cliquant sur les titres de la table ça triera les commandes.

Enfin dans la listes des commandes vous pouvez annuler une commande ou en créer une nouvelle en choisissant son consommateur.

## Step 3 - Mise en place d'une micro API (optionnel)

Pour de ce qui est de l'api j'ai créée un dossier "api" dans ce projet et vous pourrez accéder à ses données via un navigateur ou un logiciel tiers comme Postman par exemple.

Voici la liste des appels que j'ai effectué :

- http://localhost/api/orders.php : afficher toutes les commandes
- http://localhost/api/order.php?id= : afficher une commande en fonction de son id
- http://localhost/api/products.php : afficher toutes les commandes
- http://localhost/api/products.php?sku= : afficher un produit en fonction de son sku
