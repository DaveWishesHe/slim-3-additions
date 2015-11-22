# Slim 3 Additions (v0.0.1)
This Slim Additions library is designed to alter some of the aspects of Slim 3.

## Installation
This isn't available on packagist at the moment, but composer will let you install directly from a github repository. Just add this to your composer.json

    {
        "repositories": [{
             "type": "vcs",
             "url": "https://github.com/DaveWishesHe/slim-3-additions"
        }],
        "require": {
            "davewisheshe/slim-3-additions":"dev-master"
        }
    }

## Route Generation & Controllers
Instead of defining routes with anonymous functions or classes and methods where the each class method has to have Request, Response and Args parameters defined, Slim 3 Additions allows us to pass the http method, url, controller class and action, and the Slim 3 Additions Controller class handles the Request and Response parameters for us.

So, in the routes file:

    <?php 
    $app->route("get", "/", "HomeController", "home")

And in our HomeController

    <?php
    class HomeController extends SlimAdditions\Controller
    {
        public function home()
        {
            return $this->render(array("Hello" => "World!"));
        }
    }

Check out the example startup and routes files too.
