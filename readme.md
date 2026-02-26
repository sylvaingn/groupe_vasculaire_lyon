# Contentify - Thème WordPress

## Installation rapide (environnement local)

### Prérequis
- [MAMP](https://www.mamp.info/) ou autre serveur local
- [WP-CLI](https://wp-cli.org/) installé globalement
- [Git](https://git-scm.com/)
- [Node.js](https://nodejs.org/)

### 1. Cloner le repo

```bash
cd D:\www
git clone https://github.com/Francelink/contentify.git
```

### 2. Lancer le setup automatique

```bash
cd contentify\wp-content\themes\contentify
npm run setup
```

Le script va :
- Créer le dossier `wp-root/` avec WordPress
- Configurer wp-config.php
- Cloner le thème parent (contentify-parent)
- Créer les symlinks vers les thèmes
- Installer les plugins recommandés
- Activer le thème
- Installer les dépendances npm

### 3. Démarrer le serveur de développement

```bash
## Commandes disponibles

| Commande | Description |
|----------|-------------|
| `npm run setup` | Configure l'environnement local complet |
| `npm run watch` | Lance le dev server avec hot reload |
| `npm run build` | Build de production |
| `npm run block` | Génère un nouveau bloc ACF |

## Structure du projet

```
contentify/                            ← Repo racine
├── wp-root/                           (WordPress - ignoré par git)
│   ├── wp-admin/
│   ├── wp-content/themes/
│   │   ├── contentify → symlink
│   │   └── contentify-parent → symlink
│   ├── wp-includes/
│   └── wp-config.php
└── wp-content/themes/
    ├── contentify/                    ← THÈME ENFANT (commité)
    └── contentify-parent/             (cloné - ignoré par git)
```

## Ce qui est versionné

- ✅ `wp-content/themes/contentify/` - Thème enfant
- ✅ Plugins custom dans `wp-content/plugins/`
- ❌ `wp-root/` - WordPress core
- ❌ `wp-content/themes/contentify-parent/` - Thème parent (repo séparé)
