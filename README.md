## Programming Assignment

The aim of this assignment is to demonstrate code ability in PHP and Markup. Specifically, one is invited to use the affiliates.txt file which contains a list of affiliates along with the geographical coordinates. Furnished with these data as well as the coordinates of our Dublin HQ, we then have to fetch those affiliates within a range of 100km and display them in a presentable way (i.e. with some good HTML and CSS).

#### NB: affiliates.txt is not va;id JSON but a list of JSON objects, one per line

### Implementation

In implementing this I used Laravel - specifically version 11, the current one. In addition, I make use of Laravel Sail (wrapper for Docker) so that it can be installed and run easily anywhere with the required versions.  
I am using version 8.2 of PHP as not only is required by Laravel 11; I am also making use of code hinting and other  goodies.

### Installing

To get it up and running please checkout the source and run composer install. To be able to run it you need to have  
PHP version 8.2 or greater installed locally. Whilst it's possible to run it in an isolated fashion without the composer 
install, instructions to do so are beyond the scope of this document. Before running `composer install` there are a few  
extra steps required

1. copy the supplied .env.example to .env
2. edit line 29 - change `SESSION_DRIVER=database` to `SESSION_DRIVER=file`
3. run `php ./artisan key:generate` from the project's root

### Running

Assuming that you will make use of Docker / Sails, to run it you should execute the following command from the root of  the project

`./vendor/bin/sail up -d`

After doing so, you should be able to see the one and only page with our listing by visiting [localhost](http://localhost). 
Usually I add an extra package to support SSL, but I don't want to make things unnecessarily complicated.

In addition, you can also run get the list from the command line with a console command. That would be

`./vendor/bin/sail artisan affiliates:list`
 

### Testing

To run the tests please do the following

`./vendor/bin/sail artisan test`

### Design and implementation

I decided to create a "Model" `Affiliates` which exists in `app/Models`. That's a bit odd as usually in Models we have 
Eloquent classes that map one row to a structure, whereas my "Model" really is a wrapper for a Collection, along with 
some defaults, a constructor and a few methods. The reason it sits in there is that I originally envisaged creating actual 
Eloquent instances - you can see this in the repo's log. I later realised that it's an unnecessary overkill which offers 
no advantages. Using a Collection is handy as methods such as `sort` and `where` (query) are already implemented. 
Now, getting back to the controversial location of my "Model", I thought that hell, an Eloquent model is already, 
mixed, in that some methods return "self" and others a Collection - so I decided that this is good enough for now. 
We can discuss this at length! So, the model is responsible for loading the data and querying. 
What's left is simply the route to point to the (now standard in Laravel) `__invoke` method of the Controller, to which the route points. 
The Controller's method in turn runs `getAffiliatesWithinRange()`. I am aware that the range could be a variable. 
Then again, that's already a constant in the Model. If I get the time I'll  make it so  that there is a form in the page and an AJAX update, maybe not. 
