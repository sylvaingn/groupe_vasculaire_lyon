#!/usr/bin/env node

/**
 * Script de mise en place de l'environnement local WordPress
 * Lance depuis le thème enfant : node setup-local.js
 * 
 * Structure créée:
 * D:\www\contentify\                 ← Repo racine
 * ├── wp-root/                       ← WordPress (ignoré par git)
 * │   ├── wp-admin/
 * │   ├── wp-content/themes/
 * │   │   ├── contentify/            ← Symlink → ../../wp-content/themes/contentify
 * │   │   └── contentify-parent/     ← Symlink → ../../wp-content/themes/contentify-parent
 * │   ├── wp-includes/
 * │   └── wp-config.php
 * └── wp-content/themes/
 *     ├── contentify/                ← CE DOSSIER (thème enfant - commité)
 *     └── contentify-parent/         ← Thème parent (cloné - ignoré)
 */

import { execSync } from 'child_process';
import { existsSync, mkdirSync, writeFileSync, symlinkSync } from 'fs';
import { join, resolve, basename } from 'path';
import { createInterface } from 'readline';

// Le thème enfant est dans wp-content/themes/contentify
// La racine WordPress sera dans wp-root (à côté de wp-content)
const THEME_DIR = resolve(process.cwd());
const REPO_ROOT = resolve(THEME_DIR, '..', '..', '..');
const PROJECT_NAME = basename(REPO_ROOT);
const WP_ROOT = join(REPO_ROOT, 'wp-root');
const WP_THEMES_DIR = join(WP_ROOT, 'wp-content', 'themes');
const REPO_THEMES_DIR = resolve(THEME_DIR, '..');

// Configuration par défaut
const DEFAULT_CONFIG = {
    dbName: 'contentify',
    dbUser: 'root',
    dbPass: 'root',
    dbHost: '127.0.0.1:8889',
    dbPrefix: 'wp_',
    locale: 'fr_FR',
    siteUrl: `http://localhost:8888/${PROJECT_NAME}/wp-root`,
    siteTitle: 'Contentify',
    adminUser: 'admin',
    adminPass: 'admin',
    adminEmail: 'admin@localhost.local',
    parentThemeRepo: 'https://github.com/Francelink/contentify-parent.git'
};

const rl = createInterface({
    input: process.stdin,
    output: process.stdout
});

function ask(question, defaultValue) {
    return new Promise((resolve) => {
        const defaultText = defaultValue ? ` [${defaultValue}]` : '';
        rl.question(`${question}${defaultText}: `, (answer) => {
            resolve(answer.trim() || defaultValue);
        });
    });
}

function exec(cmd, options = {}) {
    console.log(`\n> ${cmd}`);
    try {
        execSync(cmd, { stdio: 'inherit', cwd: options.cwd || WP_ROOT, ...options });
        return true;
    } catch (error) {
        if (!options.ignoreError) {
            console.error(`Erreur: ${error.message}`);
        }
        return false;
    }
}

function checkCommand(cmd) {
    try {
        const checkCmd = process.platform === 'win32' ? `where ${cmd}` : `which ${cmd}`;
        execSync(checkCmd, { stdio: 'pipe' });
        return true;
    } catch {
        return false;
    }
}

function isWordPressInstalled() {
    return existsSync(join(WP_ROOT, 'wp-includes')) && 
           existsSync(join(WP_ROOT, 'wp-admin'));
}

async function main() {
    console.log('\n========================================');
    console.log('  Setup environnement local WordPress');
    console.log('========================================\n');

    console.log(`📍 Thème enfant: ${THEME_DIR}`);
    console.log(`📍 Racine repo: ${REPO_ROOT}`);
    console.log(`📍 Racine WordPress: ${WP_ROOT}`);
    console.log(`📍 Dossier themes WP: ${WP_THEMES_DIR}\n`);

    // Vérifier WP-CLI
    if (!checkCommand('wp')) {
        console.error('❌ WP-CLI non trouvé. Installez-le depuis https://wp-cli.org/');
        console.log('\n💡 Installation rapide:');
        console.log('   curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar');
        console.log('   php wp-cli.phar --info');
        process.exit(1);
    }

    // Vérifier Git
    if (!checkCommand('git')) {
        console.error('❌ Git non trouvé. Installez-le depuis https://git-scm.com/');
        process.exit(1);
    }

    console.log('✅ WP-CLI et Git trouvés\n');

    // Collecte des informations
    console.log('--- Configuration de la base de données ---');
    const dbName = await ask('Nom de la base de données', DEFAULT_CONFIG.dbName);
    const dbUser = await ask('Utilisateur DB', DEFAULT_CONFIG.dbUser);
    const dbPass = await ask('Mot de passe DB', DEFAULT_CONFIG.dbPass);
    const dbHost = await ask('Hôte DB (MAMP: 127.0.0.1:8889)', DEFAULT_CONFIG.dbHost);

    console.log('\n--- Configuration du site ---');
    const siteUrl = await ask('URL du site', DEFAULT_CONFIG.siteUrl);
    const siteTitle = await ask('Titre du site', DEFAULT_CONFIG.siteTitle);
    const adminUser = await ask('Admin username', DEFAULT_CONFIG.adminUser);
    const adminPass = await ask('Admin password', DEFAULT_CONFIG.adminPass);
    const adminEmail = await ask('Admin email', DEFAULT_CONFIG.adminEmail);

    console.log('\n--- Thème parent ---');
    const parentThemeRepo = await ask('URL du repo contentify-parent', DEFAULT_CONFIG.parentThemeRepo);

    rl.close();

    // Étape 1: Créer le dossier wp-root si nécessaire
    console.log('\n\n📁 Création du dossier wp-root...');
    if (!existsSync(WP_ROOT)) {
        mkdirSync(WP_ROOT, { recursive: true });
        console.log(`Dossier créé: ${WP_ROOT}`);
    } else {
        console.log('Dossier wp-root déjà présent, skip...');
    }

    // Étape 2: Télécharger WordPress (si pas déjà présent)
    console.log('\n📥 Vérification/Téléchargement de WordPress...');
    if (!isWordPressInstalled()) {
        console.log('Téléchargement du core WordPress...');
        exec(`wp core download --locale=${DEFAULT_CONFIG.locale} --skip-content --extract=tar.gz`, { cwd: WP_ROOT });
    } else {
        console.log('WordPress déjà présent, skip...');
    }

    // Créer le dossier wp-content/themes dans wp-root
    if (!existsSync(WP_THEMES_DIR)) {
        mkdirSync(WP_THEMES_DIR, { recursive: true });
    }

    // Étape 3: Configurer wp-config.php
    console.log('\n⚙️  Configuration de wp-config.php...');
    if (!existsSync(join(WP_ROOT, 'wp-config.php'))) {
        exec(`wp config create --dbname=${dbName} --dbuser=${dbUser} --dbpass=${dbPass} --dbhost=${dbHost} --dbprefix=${DEFAULT_CONFIG.dbPrefix} --locale=${DEFAULT_CONFIG.locale}`, { cwd: WP_ROOT });
    } else {
        console.log('wp-config.php déjà présent, skip...');
    }

    // Étape 4: Installer WordPress
    console.log('\n🚀 Installation de WordPress...');
    exec(`wp core install --url="${siteUrl}" --title="${siteTitle}" --admin_user="${adminUser}" --admin_password="${adminPass}" --admin_email="${adminEmail}" --skip-email`, { cwd: WP_ROOT, ignoreError: true });

    // Étape 5: Cloner le thème parent dans le repo (wp-content/themes)
    console.log('\n📦 Installation du thème parent...');
    const parentThemePath = join(REPO_THEMES_DIR, 'contentify-parent');
    if (!existsSync(parentThemePath)) {
        exec(`git clone ${parentThemeRepo} contentify-parent`, { cwd: REPO_THEMES_DIR });
    } else {
        console.log('Thème parent déjà présent, mise à jour...');
        exec('git pull', { cwd: parentThemePath, ignoreError: true });
    }

    // Étape 6: Créer les symlinks dans wp-root/wp-content/themes
    console.log('\n🔗 Création des liens symboliques...');
    
    // Symlink pour le thème enfant
    const childThemeLink = join(WP_THEMES_DIR, 'contentify');
    if (!existsSync(childThemeLink)) {
        symlinkSync(THEME_DIR, childThemeLink, 'junction');
        console.log('Symlink thème enfant créé');
    } else {
        console.log('Symlink thème enfant déjà présent');
    }
    
    // Symlink pour le thème parent
    const parentThemeLink = join(WP_THEMES_DIR, 'contentify-parent');
    if (!existsSync(parentThemeLink)) {
        symlinkSync(parentThemePath, parentThemeLink, 'junction');
        console.log('Symlink thème parent créé');
    } else {
        console.log('Symlink thème parent déjà présent');
    }

    // Étape 7: Installer les plugins recommandés
    console.log('\n🔌 Installation des plugins...');
    const plugins = [
        'advanced-custom-fields',
        'wordpress-seo',
        'safe-svg',
        'contact-form-7'
    ];
    exec(`wp plugin install ${plugins.join(' ')} --activate`, { cwd: WP_ROOT, ignoreError: true });

    // Étape 8: Activer le thème
    console.log('\n🎨 Activation du thème...');
    exec('wp theme activate contentify', { cwd: WP_ROOT, ignoreError: true });

    // Étape 9: Créer le fichier .env dans le thème
    console.log('\n📝 Configuration du fichier .env...');
    const envPath = join(THEME_DIR, '.env');
    if (!existsSync(envPath)) {
        const envContent = `# Configuration locale
LOCAL_CONFIG=${siteUrl}
`;
        writeFileSync(envPath, envContent);
        console.log('.env créé');
    } else {
        console.log('.env déjà présent, skip...');
    }

    // Étape 10: Installer les dépendances npm du thème
    console.log('\n📦 Installation des dépendances npm...');
    exec('npm install', { cwd: THEME_DIR });

    // Résumé
    console.log('\n\n========================================');
    console.log('  ✅ Installation terminée !');
    console.log('========================================');
    console.log(`
📋 Récapitulatif:
   - WordPress: ${WP_ROOT}
   - URL: ${siteUrl}
   - Admin: ${adminUser} / ${adminPass}

🚀 Pour démarrer:
   1. Configurer MAMP Document Root → ${WP_ROOT}
   2. Créer la base de données "${dbName}" dans phpMyAdmin
   3. cd ${THEME_DIR}
   4. npm run watch

📁 Structure:
   ${REPO_ROOT}
   ├── wp-root/                     (WordPress - ignoré par git)
   │   └── wp-content/themes/
   │       ├── contentify → symlink
   │       └── contentify-parent → symlink
   └── wp-content/themes/
       ├── contentify/              (thème enfant - CE DOSSIER)
       └── contentify-parent/       (cloné - ignoré par git)

💡 Générer un bloc:
   npm run block
`);
}

main().catch(console.error);
