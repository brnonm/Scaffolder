<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# Laravel Scaffolder

### Instalation guide for Homestead

* MacOs/Linux and Windows with bash

    1. Download and Install  VirtualBox

            https://www.virtualbox.org/wiki/Downloads

    2. Download and Install Vagrant

            https://www.vagrantup.com/downloads.html

    3. Add the  'laravel/homestead' box to your Vagrant on terminal
	
	        $vagrant box add laravel/homestead

    4. Clone the Homestead folder from github
    
            $git clone https://github.com/laravel/homestead.git ~/Homestead
    
    5. from here go to 'Homestead' folder
	
            $cd Homestead
    
    6. Create the Homestead.yaml file

            $bash init.sh
            
            
### Installation guide for Laravel Scaffolder project
            
   1. Get Project Laravel Scaffolder from GitHub
            
            $git clone https://github.com/brnonm/Scaffolder.git
    
   2. Map the laravel project on your brand new .yalm file
        Open the homestead.yaml file (located at Homestead folder) on your prefered text editor (ex: Sublime Text)

            a) under the section 'folders' remove the example content and add: (notice that the starting tabs are crutial and if not respected this may not work)
     
            - map: REPLACE_BY_PATH_IN_YOUR_SYSTEM/Scaffolder
              to: /home/vagrant/Scaffolder

            b) Under the section 'sites' remove the example content and add: (notice that the starting tabs are crutial and if not respected this may not work)
            
            - map: scaffolder.local
              to: /home/vagrant/Scaffolder/public

   3. Open hosts file
    
            $sudo nano /etc/hosts
    
   4. Add the following domains

            192.168.10.10 scaffolder.local

   5. Run composer at the folder of the project (php 7.2 version needed)
    
            $cd Scaffolder
            $php composer.phar install
    
   6. Create new .env file

            $cp .env.example .env
            
   7. Configure .env
            
            DB_DATABASE= your settings
            DB_USERNAME= your settings
            DB_PASSWORD= your settings
            
            Change the values “your settings” to your own server definitions.
                
   8. Generate new key

            $php artisan key:generate
    
   9. Start homestead. At the homestead folder run

	        $vagrant up

            If the following error occurs: "Check your Homestead.yaml file, the path to your private key does not exist." run the following command and try again vagrant up
        $ssh-keygen -t rsa -b 4096 -C "your_email@example.com"

   10. On terminal
   
            $composer update
            $php artisan optimize 

   10. Go to your browser and go to the following url
    
            * scaffolder.local

   1. Now you need create a creadential to login, and enjoy it!
   
### Notes:
    * You need to change php.ini in order to use bigger a database. 
        ex: max_input_vars: from 1000 to 10000 
    

    
### Images from Project.
    
  <a href="https://imgur.com/3fwqKwP"><img src="https://i.imgur.com/3fwqKwP.png" title="source: imgur.com" /></a>
  
  <a href="https://imgur.com/OxtlzEV"><img src="https://i.imgur.com/OxtlzEV.png" title="source: imgur.com" /></a>      

  <a href="https://imgur.com/uhHb1cN"><img src="https://i.imgur.com/uhHb1cN.png" title="source: imgur.com" /></a>
    
  <a href="https://imgur.com/C7pcznQ"><img src="https://i.imgur.com/C7pcznQ.png" title="source: imgur.com" /></a>



### Additional information


    1. Laravel Homestead page

        * https://laravel.com/docs/7.x/homestead
    
    2. Laravel installation

        * https://laravel.com/docs/7.x/homestead#configuring-homestead

    3. Composer Documentation
        
        * https://getcomposer.org/
