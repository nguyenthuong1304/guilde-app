<?php
namespace Deployer;

require 'recipe/laravel.php';
set('application', 'guilde-app');
set('default_timeout', 1200);
set('repository', 'git@github.com:nguyenthuong1304/guilde-app.git');
set('git_tty', false);
set('writable_mode', 'chmod');
set('http_user', 'deploy');
set('git_tty', false);
//
//// Shared files/dirs between deploys
//add('shared_files', []);
//add('shared_dirs', []);
//
//// Writable dirs by web server
//add('writable_dirs', []);


host('3.139.84.92')
    ->user('deploy')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/html/{{application}}')
    ->forwardAgent(false);

task('build:fast', function () {
    run('cd {{deploy_path}} && git pull origin master');
    // run('cd {{deploy_path}} && composer install');
    run('cd {{deploy_path}} && php artisan view:clear');
    run('cd {{deploy_path}} && php artisan config:clear; php artisan migrate; composer dump-autoload; npm run dev');
    run('cd {{deploy_path}} && php artisan view:cache');
});

after('deploy:failed', 'deploy:unlock');
//before('deploy:symlink', 'artisan:migrate');
