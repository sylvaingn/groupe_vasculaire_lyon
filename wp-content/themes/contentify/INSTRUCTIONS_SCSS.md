garder le nom des classes en entier : pas de "&__"
et garder une hiérarchie dans le scss

pas besoin de redéclarer des classes qui existent déjà dans le fichiers styles.scss

pour les couleurs, cherchent constament à réutiliser les couleurs déclaré dans le fichier _variables.scss, et à ajouter les nouvelles couleurs dans ce fichier pour éviter les problèmes de maintenance et de cohérence dans le thème

met toujours des display block aux images

pour les fichiers scss correspondant à une page unique (single, archive, template spécifique), ne pas les importer dans styles.scss. À la place, les enqueue conditionnellement dans functions.php uniquement si on est sur le template concerné (ex: is_singular('speciality'))

dans les sections, toujours ajouter une div *--wrapper juste après le .container pour y appliquer les styles flex/grid. Ne jamais mettre de display flex/grid directement sur un .container