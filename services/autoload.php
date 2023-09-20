<?php

require './models/User.php';
require './models/Category.php';
require './models/Product.php';
require './models/Role.php';
require './models/Media.php';


require './managers/AbstractManager.php';
require './managers/CategoryManager.php';
require './managers/UserManager.php';
require './managers/ProductManager.php';
require './managers/RoleManager.php';
require './managers/MediaManager.php';



require './controllers/AbstractController.php';
require './controllers/UserController.php';
require './controllers/ProductController.php';
require './controllers/CategoryController.php';
require './controllers/AuthController.php';
require './controllers/MediaControlles.php';
require './controllers/RoleController.php';
require './controllers/HomeController.php';
require './controllers/AdminController.php';






require 'Router.php';
