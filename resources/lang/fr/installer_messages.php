<?php

return [

    /*
     *
     * Traductions partagées.
     *
     */
    'title' => config('installer.item_name') . ' Installer',
    'next' => 'Étape Suivante',
    'back' => 'Précédent',
    'finish' => 'Installer',
    'forms' => [
        'errorTitle' => 'Les erreurs suivantes se sont produites :',
    ],

    /*
     *
     * Traductions de la page d'accueil.
     *
     */
    'welcome' => [
        'templateTitle' => 'Bienvenue',
        'title'   => config('installer.item_name') . ' Installer',
        'message' => 'Assistant d\'installation et de configuration facile.',
        'next'    => 'Vérifier les exigences',
    ],

    /*
     *
     * Traductions de la page des exigences.
     *
     */
    'requirements' => [
        'templateTitle' => 'Étape 1 | Exigences du serveur',
        'title' => 'Exigences du serveur',
        'next'    => 'Vérifier les autorisations',
    ],

    /*
     *
     * Traductions de la page des autorisations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Étape 2 | Autorisations',
        'title' => 'Autorisations',
        'next' => 'Configurer l\'environnement',
    ],

    /*
     *
     * Traductions de la page de licence.
     *
     */
    'license' => [
        'templateTitle' => 'Étape 3 | Vérification de la licence',
        'title' => 'Vérifications de licence',
        'next' => 'Vérifier',
    ],

    /*
     *
     * Traductions de la page de l'environnement.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Étape 3 | Paramètres de l\'environnement',
            'title' => 'Paramètres de l\'environnement',
            'desc' => 'Veuillez sélectionner comment vous souhaitez configurer le fichier <code>.env</code> de l\'application.',
            'wizard-button' => 'Configuration avec l\'assistant',
            'classic-button' => 'Éditeur de texte classique',
        ],
        'wizard' => [
            'templateTitle' => 'Étape 4 | Configuration de l\'environnement et de la base de données',
            'title' => 'Configuration de l\'environnement et de la base de données',
            'tabs' => [
                'environment' => 'Environnement',
                'database' => 'Base de données',
                'application' => 'Application',
            ],
            'form' => [
                'name_required' => 'Un nom d\'environnement est requis.',
                'app_name_label' => 'Nom de l\'application',
                'app_name_placeholder' => 'Nom de l\'application',
                'app_environment_label' => 'Environnement de l\'application',
                'app_environment_label_local' => 'Local',
                'app_environment_label_developement' => 'Développement',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Production',
                'app_environment_label_other' => 'Autre',
                'app_environment_placeholder_other' => 'Entrez votre environnement...',
                'app_debug_label' => 'Débogage de l\'application',
                'app_debug_label_true' => 'Vrai',
                'app_debug_label_false' => 'Faux',
                'app_log_level_label' => 'Niveau de journalisation de l\'application',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => 'URL de l\'application',
                'app_url_placeholder' => 'URL de l\'application',
                'db_connection_failed' => 'Impossible de se connecter à la base de données.',
                'db_connection_label' => 'Connexion à la base de données',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Hôte de la base de données',
                'db_host_placeholder' => 'Hôte de la base de données',
                'db_port_label' => 'Port de la base de données',
                'db_port_placeholder' => 'Port de la base de données',
                'db_name_label' => 'Nom de la base de données',
                'db_name_placeholder' => 'Nom de la base de données',
                'db_username_label' => 'Nom d\'utilisateur de la base de données',
                'db_username_placeholder' => 'Nom d\'utilisateur de la base de données',
                'db_password_label' => 'Mot de passe de la base de données',
                'db_password_placeholder' => 'Mot de passe de la base de données',

                'app_tabs' => [
                    'more_info' => 'Plus d\'infos',
                    'broadcasting_title' => 'Diffusion, mise en cache, session et file d\'attente',
                    'broadcasting_label' => 'Pilote de diffusion',
                    'broadcasting_placeholder' => 'Pilote de diffusion',
                    'cache_label' => 'Pilote de cache',
                    'cache_placeholder' => 'Pilote de cache',
                    'session_label' => 'Pilote de session',
                    'session_placeholder' => 'Pilote de session',
                    'queue_label' => 'Pilote de file d\'attente',
                    'queue_placeholder' => 'Pilote de file d\'attente',
                    'redis_label' => 'Pilote Redis',
                    'redis_host' => 'Hôte Redis',
                    'redis_password' => 'Mot de passe Redis',
                    'redis_port' => 'Port Redis',

                    'mail_label' => 'Mail',
                    'mail_driver_label' => 'Pilote de mail',
                    'mail_driver_placeholder' => 'Pilote de mail',
                    'mail_host_label' => 'Hôte de mail',
                    'mail_host_placeholder' => 'Hôte de mail',
                    'mail_port_label' => 'Port de mail',
                    'mail_port_placeholder' => 'Port de mail',
                    'mail_username_label' => 'Nom d\'utilisateur de mail',
                    'mail_username_placeholder' => 'Nom d\'utilisateur de mail',
                    'mail_password_label' => 'Mot de passe de mail',
                    'mail_password_placeholder' => 'Mot de passe de mail',
                    'mail_encryption_label' => 'Chiffrement de mail',
                    'mail_encryption_placeholder' => 'Chiffrement de mail',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'Identifiant de l\'application Pusher',
                    'pusher_app_id_palceholder' => 'Identifiant de l\'application Pusher',
                    'pusher_app_key_label' => 'Clé de l\'application Pusher',
                    'pusher_app_key_palceholder' => 'Clé de l\'application Pusher',
                    'pusher_app_secret_label' => 'Secret de l\'application Pusher',
                    'pusher_app_secret_palceholder' => 'Secret de l\'application Pusher',
                ],
                'buttons' => [
                    'setup_database' => 'Configurer la base de données et l\'environnement',
                    'setup_application' => 'Configurer l\'application',
                    'install' => 'Installer',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Étape 3 | Paramètres de l\'environnement | Éditeur classique',
            'title' => 'Éditeur d\'environnement classique',
            'save' => 'Enregistrer .env',
            'back' => 'Utiliser l\'assistant',
            'install' => 'Enregistrer et installer',
        ],
        'success' => 'Les paramètres de votre fichier .env ont été enregistrés.',
        'errors' => 'Impossible d\'enregistrer le fichier .env, veuillez le créer manuellement.',
    ],

    'install' => 'Installer',

    /*
     *
     * Traductions des logs d\'installation.
     *
     */
    'installed' => [
        'success_log_message' => config('installer.item_name') . ' installé avec succès le ',
    ],

    /*
     *
     * Traductions de la page finale.
     *
     */
    'final' => [
        'title' => 'Installation terminée',
        'templateTitle' => 'Installation terminée',
        'finished' => 'L\'application a été installée avec succès.',
        'migration' => 'Sortie de la console de migration et de graines :',
        'console' => 'Sortie de la console de l\'application :',
        'log' => 'Entrée du journal d\'installation :',
        'env' => 'Fichier .env final :',
        'exit' => 'Cliquez ici pour sortir',
    ],

    /*
     *
     * Traductions spécifiques à la mise à jour
     *
     */
    'updater' => [
        /*
         *
         * Traductions partagées.
         *
         */
        'title' => 'Metteur à jour Laravel',

        /*
         *
         * Traductions de la page d\'accueil pour la fonction de mise à jour.
         *
         */
        'welcome' => [
            'title'   => 'Bienvenue dans le Metteur à jour',
            'message' => 'Bienvenue dans l\'assistant de mise à jour.',
        ],

        /*
         *
         * Traductions de la page de présentation pour la fonction de mise à jour.
         *
         */
        'overview' => [
            'title'   => 'Aperçu',
            'message' => 'Il y a 1 mise à jour.|Il y a :number mises à jour.',
            'install_updates' => 'Installer les mises à jour',
        ],

        /*
         *
         * Traductions de la page finale.
         *
         */
        'final' => [
            'title' => 'Terminé',
            'finished' => 'La base de données de l\'application a été mise à jour avec succès.',
            'exit' => 'Cliquez ici pour sortir',
        ],

        'log' => [
            'success_message' => 'Le Metteur à jour Laravel a été mis à jour avec succès le ',
        ],
    ],
];
