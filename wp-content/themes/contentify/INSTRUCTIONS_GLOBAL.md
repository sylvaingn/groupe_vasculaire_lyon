lors de la création des CPT/taxonomies,  il faut absolument faire les déclarations dans /acf-json, pas de création dans le php
dans l'idéal, créé les slugs des champs ACF en anglais, même si les champs sont en français, pour éviter les problèmes de traduction et de compatibilité avec les plugins tiers
attention a la nomination des fichiers dans /acf-json, certains ne sont pas reconnus par ACF
pour les CPT, le fichier doit s'appeler `post_type_[ID].json` avec une clé `key` correspondante (ex: `post_type_69a15ad98e922.json` avec `"key": "post_type_69a15ad98e922"`). Se baser sur l'exemple du CPT chirurgien dans acf-json/

pour la création des blocks, utiliser la commande 'npm run block'

a la création des groupes ACF, regarde si le parent n'existe pas déjà dans le thème, et si c'est le cas, ajoute les champs à ce groupe plutôt que d'en créer un nouveau, pour éviter les doublons et faciliter la maintenance du thème
lorsque tu crées un groupe ACF, pense à mettre le timestamp de création à celui du moment pour éviter les problèmes de synchronisation avec les fichiers acf-json
si un groupe de champs existe déjà dans le thème parent pour un block, ne pas créer de nouveau groupe dans le thème enfant, mais copier le fichier du parent vers l'enfant pour faire des overrides si nécessaire
pour les boutons/liens vers des archives ou pages dynamiques, les générer directement en PHP plutôt que créer des champs ACF inutiles (ex: get_post_type_archive_link())

lorsqu'il s'agit de créer des cartes de boucles, je préfère que tu utilises des get_template_part() pour plus de découpage