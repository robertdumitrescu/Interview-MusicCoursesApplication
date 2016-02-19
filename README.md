# Interview-MusicCoursesApplication

## Overview
This is a task received from an British development company that builds Symfony application for e-commerce platforms.
I applied for the following position:

> Full-stack web developer

## Demo

Coming soon

## Task

So the task sounds like this:

You need to write an application that handles some music courses of different level. To achieve this lets assume that you have 3 difficulty levels: Begginer, Intermediate and Advanced. 

Back:
 Create the following API’s:
   - The 6 most used lessons in each level
   - List all the lessons available for a given level
   - Get detail of a lesson for a given id + level
   - Create a lesson (title only do not manage image upload, you will integrate them directly in your application.)

Front:
 Create one angular application :
	- integrate the psd in responsive
	- show lessons thanks to the API. Must match the PSD provided.

## Result

I builded the application using Symfony2 framework for API arhitecture. I used Doctrine ORM to handle the database calls. 

I also defined a render controller that served my static pages which includes the angular app and other resources for calling API's. I split the controller in files for a better readability and a better project structure. 

I used Symfony2 services for processing data and also I developed a command for the application installation process and dummy data insertion.

## Install

ALl you need to do in order to install the application is to configure manually the parameters.yml file from app/config folder. After you define what database name you would want, also create the database on your computer. 

After that you can safely run the 

> composer install

If you don't have the composer installed globally you cand download the composer.phar and run in this way:

> php composer.phar install

When the application is installed and the assetic copied all the static resources in web/bundles folder you can run the application initialization command in order to define the tables in the database and insert the dummy data.

> php app/console app:init

##Contact

- My resume: [Robert Dumitrescu resume](http://rdumitrescu.com/resume)
- My portfolio: [Robert Dumitrescu portfolio](http://rdumitrescu.com/portfolio/)
- LinkedIn profile: [Robert Dumitrescu LinkedIn profile](https://ro.linkedin.com/in/robertdumitrescu)
- CodePen profile: [Robert Dumitrescu CodePen profile](http://codepen.io/robertdumitrescu/)
