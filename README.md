
# Community Webshop

***The project is still in the early phase, and there are lots of improvements to be made.***

## About project

This is an example of a minimalistic community shopping website made for a project task. The task was to create a shopping platform for furniture where everyone would be able to sell their or buy others' furniture. 

## Technology

The requirement of the task was to use pure HTML/CSS/JavaScript and PHP for the back-end, running using the latest stable Apache version. For the database, MySQL is being used.

## How to deploy and test 

Deployment is really easy and has zero pre-install requirements, except to have the latest stable PHP version installed, running on Apache.

 - Download the repository or clone using `git clone https://github.com/Marwollo/community-webshop`. Project files should be stored in the public root folder of your Apache configuration (you'll probably find it already created as `public_html` or `htdocs`.
 - Configure the `HOST` field to match the host of your MySQL server, and enter other required information for the authentication.
 - Choose the default language of the static content. It's set to be `sr_RS` which is a JSON file located in `Languages/sr_RS.json`. Feel free to create your language instances and simply link it in the configuration file.
 - Create a database that'll match the `DB_NAME` field in the configuration. All tables will automatically be created once the website is loaded for the first time.
 - Open your website at `localhost` in your browser, your IP address or the corresponding domain name.

## To-Do
Most of the work is now related to the front-end, so there almost all updates will be related to it.

 - Create a model for a cart item. It's currently just a part of the Product model which has its own controller. The cart item should manage the session cart and encapsulate it for more intuitive usage.
 - Create a page for viewing more details about a certain product.
 - There are a few places where strings aren't dynamic and changing based on the language chosen.
 - Improve the ordering system, require more information and  generate a better list of all items ordered.
 - Improve the workflow of the app for regular clients and prevent unwanted spam.
 - Other minor features.