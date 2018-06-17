# phprouter

### A API -style router for use in PHP projects

#### Routing:

You can add new routes by adding the route to Router/routemap.php with the following syntax


```php

$routemap = [
    new Route("/api/users/all", "GET"),
    new Route("/api/users/id/{id}", "GET")  
];

```

Path /api/users/all will require Handlers/Users/index.php, which will require class.php in the same directory.
After that the router will call function called ``All`` in the said class.

Path /api/users/id/{id} will get the last part of said url and assign is as the parameter. 
After that the router will require the class like above, and call the function ``getById`` in the said class.
