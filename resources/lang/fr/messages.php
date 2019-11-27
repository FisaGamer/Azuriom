<?php

return [

    'lang' => 'Français',

    'copyright' => 'Propulsé par <a href="https://azuriom.com" target="_blank" rel="noreferrer">Azuriom</a>.',

    'nav' => [
        'profile' => 'Profil',
        'admin' => 'Panel administrateur',
    ],

    'actions' => [
        'create' => 'Créer',
        'edit' => 'Éditer',
        'update' => 'Mettre à jour',
        'delete' => 'Supprimer',
        'save' => 'Sauvegarder',
        'browse' => 'Parcourir',
        'choose-file' => 'Choisir le fichier',
        'upload' => 'Télécharger',
        'cancel' => 'Annuler',
        'enable' => 'Activer',
        'disable' => 'Désactiver',
    ],

    'fields' => [
        'name' => 'Nom',
        'title' => 'Titre',
        'action' => 'Action',
        'date' => 'Date',
        'slug' => 'Lien',
        'enabled' => 'Activé',
        'author' => 'Auteur',
        'user' => 'Utilisateur',
        'image' => 'Image',
        'type' => 'Type',
        'file' => 'Fichier',
        'description' => 'Description',
        'content' => 'Contenu',
        'color' => 'Couleur',
        'version' => 'Version',
    ],

    'yes' => 'Oui',
    'no' => 'Non',

    'maintenance' => 'Maintenance',

    'profile' => [
        'title' => 'Mon Profil',
        'change-email' => 'Changer l\'adresse e-mail',
        'change-password' => 'Changer le mot de passe',

        'updated' => 'Profil mis à jour',

        'info' => [
            'role' => 'Role: :role',
            'register' => 'Création du compte: :date',
            '2fa' => 'Authentification à deux facteurs (A2F): :2fa'
        ],

        '2fa' => [
            'enable' => 'Activer l\'A2F',
            'disable' => 'Désactiver l\'A2F',
            'info' => 'Scannez le QR code ci-dessus avec une application d\'authentification à deux facteurs sur votre téléphone comme Google Authenticator.',
            'secret' => 'Clé secrète: :secret',
            'title' => 'Activer l\'authentification à deux facteurs',
            'code' => 'Code',
            'enabled' => 'Authentification à deux facteurs activée',
            'disabled' => 'Authentification à deux facteurs désactivée',
        ],

        'email-not-verified' => 'Votre adresse e-mail n\'est pas vérifiée, veuillez vérifier si vous avez reçu un lien de vérification. Si vous ne l\'avez pas reçu, vous pouvez le renvoyer.',
    ],

    'posts' => [
        'posts' => 'Articles',
        'posted' => 'Posté le :date par :user',
        'not-published' => 'Cet article n\'est pas encore publié',
        'read' => 'En savoir plus',
    ],

    'comments' => [
        'create' => 'Laisser un commentaire',
        'guest' => 'Vous devez être connecté pour laisser un commentaire.',
        'author' => ':user le :date',
        'your-comment' => 'Votre commentaire',
        'post-comment' => 'Poster',
        'delete-title' => 'Supprimer ?',
        'delete-description' => 'Êtes-vous sûr de vouloir supprimer ce commentaire ?',
    ],

    'likes' => 'Likes: :likes',
];