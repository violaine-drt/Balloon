# Balloon - Plateforme de micro-blogging 

"Balloon" is the first step towards a microblogging network, developed as part of a school collective project at **_Ada Tech School_**.

![filtres](https://github.com/violaine-drt/Balloon/blob/main/readme.gif)

## Project's context and objectives

"Balloon" was designed and developed  as a school project, over a period of 8 days with the participation of 3 students, all beginner developers.

The functional objectives of the project were to develop a minimalist microblogging platform, offering the following features:

Creating posts associating an image and text,
Finding them grouped within a personal page,
Viewing posts from other members,
Authenticating,
Logging in,
Editing one's profile.

The educational objectives included:

Getting familiar with a project with a rich structure due to the architecture implemented by Laravel
Discovering the PHP framework Laravel
Exploring Docker containerization
Conducting feature tests to achieve a minimum of 50% test coverage

## My role in the project


Because of the new nature of the technologies used (Laravel, Docker), a certain amount of documentation time was necessary, and we chose to use a lot of mob programming in this project to build team skills and guarantee a homogeneity of knowledge. So we did a lot of group work. What I particularly appreciated about this project was the implementation of feature tests, and the creation of new data through the MVC architecture proposed by Laravel.


## Collaboration and Communication

Collaboration between the three of us was essential to ensure the project's success. Daily meetings were held to share progress, discuss encountered challenges, and align priorities. We used a project management tool, **Trello**, to track tasks and deadlines. 
We're particularly happy with the way we've defined our MVP, and stayed committed to it. This enabled us to stay focused on the project's pedagogical objectives and produce a minimal yet functional result, while at the same time familiarizing ourselves with the use of new technologies.



Follow the instructions below !

# Credits
Mathurin S, Maguelone G, Violaine D

# License

GNU GPL v3.


# How to install and run the project:

[Windows] Prerequisites: Install WSL 2
🟡 If you haven't already, install WSL 2. See the official WSL 2 documentation.

In summary, WSL (= Windows Sub-system for Linux) installs a Linux operating system on top of your Windows operating system, but without the graphical part.

This Linux (sub-)system is a real OS, it comes with a command terminal and its own file system, independent of your Windows file system.

🚩 For an optimal development environment, we strongly recommend using this Linux system for all your projects, as well as for any associated tools or libraries you may need to install. Always use your WSL shell and create your files and projects on the WSL file system.

Why?

Linux shell tools are now a standard in development.
Interacting from the WSL shell with existing files on your Windows file system can expose you to (significant) slowness issues. With Docker, it can even become almost unusable. Do yourself a favor, use WSL by default 🫶
On the official WSL website, you'll find more information about File Storage and Performance Across File Systems.

[Windows / Mac / Linux] Prerequisites: Install Docker
🟡 Install Docker via the official Docker website.

For Windows, choose the Docker installation option with WSL 2.

🟡 Then, make sure it's running locally on your machine:

Copy code
docker info
[Windows] Prerequisites: Clone the project 🚩on the Linux file system (WSL)🚩
🟡 If you've cloned this microblogging template project directly on the WSL file system, congratulations, you've followed the first prerequisite well, you can move on to the next step 🎉

If this template project is on your Windows file system, clone it again, but this time on the WSL file system.

🚩 How to clone the project on the WSL file system?

Open the WSL terminal
Navigate to your HOME directory on your WSL file system
bash
Copy code
cd ~
Make sure your current directory does not start with /mnt/c/.
If it starts with /mnt/c/, that's not good, because it means you're still on the Windows file system, as mentioned in the documentation on WSL file systems.
If you're indeed on the WSL file system, that's good, create or navigate to your project directory, then clone the project as usual.
[Windows / Mac / Linux] Prerequisites: Configure the project development environment
This project has been pre-configured to allow for a quick and automatic installation of all its dependencies (PHP command-line tools, Laravel and its libraries, VSCode extensions adapted to PHP development). For this, we'll use the "Dev Containers" feature of VSCode.

🟡 Open the project in VSCode. The files and folders of the repo should constitute the root of the project's tree structure under VS Code.

❗️ Open the project directly from the root folder, via "Open Folder", or via code .. The Dev Container extension doesn't work from a "workspace", so don't open the folder via "Add Folder to Workspace".

🟡 Copy the .env.example file to .env

bash
Copy code
cp .env.example .env
❗️ This step is essential to allow for the proper configuration of the project's Docker environment.

🟡 Install the VSCode extension "Dev Containers"

🟡 Reopen the project in VSCode inside Docker using the "Reopen in Container" command

The project should open normally in a new VSCode window, and start downloading Docker images, then building and running the associated containers. This may take a few minutes depending on network bandwidth and your machine's power.

At this stage, VSCode should normally prompt you to open the Docker logs, do so, try to understand what's happening there, and make sure there are no errors.

❓ Once finished, your project is running "under Docker". What does that mean to you?

❓ Also, take a look at the installed VSCode extensions. Where do these PHP / Laravel extensions come from?

Start the Laravel application
🟡 Open the VSCode terminal.

❓ Pay close attention to the prompt of your VSCode terminal. Where do you think this terminal is running?

🟡 Install PHP dependencies via composer

Copy code
composer install
Composer is the default package manager for PHP (equivalent to npm in Node/JS). The project dependencies (i.e., necessary external libraries) are described in the composer.json file. Once downloaded, they are installed in the vendor directory.

❓ Do you think we should commit this vendor directory to the project's git?

🟡 Generate your Laravel application encryption key

vbnet
Copy code
php artisan key:generate
This command generates a key which is then stored in the APP_KEY variable of your .env file.

🟡 Launch the internal web server of Laravel

Copy code
php artisan serve
You should see the default Laravel page by opening the indicated URL (http://127.0.0.1:8000 if everything goes well).

🎉 Congratulations, you've done it, you have a Laravel application running under Docker!

At this point, take the time to familiarize yourself with how Laravel works, by going through the official documentation (highly recommended) or by following some tutorials. See the links at the end of this README.

Database Management (PostgreSQL)
🟡 Access the "pgAdmin" admin interface

❓ By inspecting the docker-compose.yml (and possibly the .env), can you deduce the connection URL to "pgAdmin", as well as its login credentials?

🟡 Once connected to "pgAdmin", configure the connection to your local database by adding a new "server".

The login credentials are the same as those configured in the docker-compose.yml (and the .env).

❗️ An important detail related to Docker: the connection "host" corresponds to the PostgreSQL URL inside the Docker network. Instead of searching for the internal IP address of your PG (which is entirely possible if you want an additional challenge), you can use directly the name defined within the docker-compose.yml for the PG service (= pgsql).

🎉 Once connected, you should see a database named microblogging (i.e., the name corresponding to the DB_DATABASE variable in .env). Note that the database exists but is empty.

🟡 Initialize the database by performing the existing default Laravel migrations.

Copy code
php artisan migrate






