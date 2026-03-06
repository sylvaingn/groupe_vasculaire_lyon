quand tu récupères des entrées, valeurs etc, vérifie bien si celles-ci existent
avant de les utiliser, sinon tu risques d'avoir des erreurs du type "undefined index" ou "undefined variable"

ne jamais mettre de code directement dans functions.php. Créer des fichiers séparés dans le dossier inc/ et les require dans functions.php

pour afficher un fil d'ariane, utiliser la fonction get_breadcrumb() qui est compatible Yoast

pour les titres dans les blocks ACF, utiliser un champ de type "clone" avec le groupe "group_6877bf46ccf17" (élément Titre du thème parent). Exemple :
```json
{
    "key": "field_monblock_titre",
    "label": "Titre",
    "name": "titre",
    "type": "clone",
    "clone": ["group_6877bf46ccf17"],
    "display": "seamless",
    "layout": "block",
    "prefix_label": 0,
    "prefix_name": 0
}
```