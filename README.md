
# todo-test
faire une todo list ou l’on peut renseigner les tâches à faire avec la possibilité d’entrer la description de la tâche, on doit pouvoir voir l’heure à laquelle la tâche a été renseigné, l’heure à laquelle elle doit s’achever. on doit pouvoir voir les tâches en cours, les tâches achevées et celles faites. On peut clôturer la journée en cliquant sur un bouton clôturer qui aura pour effet de de sauvegarder l'état de la todo dans la base de donnée ici MYSQL. prévoir une page historique qui permet à partir d’une date précédente sélectionnée affiche l'état de la todo list ce jour là aussi prévoir une interface d’inscription et de connexion a la todo list. enfin vous allez créer un compte sur gitlab si vous n’en avez pas encore puis y déposer votre projet et partager avec l’utilisateur bmf @bmf en le mettant comme maintainer

# Pour cloner le project 
> git clone https://github.com/edson77/todo-test.git

# puis il faut installer les dependances
> composer install

# rename .env.example to .env
# execute the migrations
> php artisan migrate

# php artisan serve  
127.0.0.1:8000