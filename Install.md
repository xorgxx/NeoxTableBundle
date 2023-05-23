# NeoxTableBundle
This bundle provides a simple and flexible to manage crud render in your application.
Its main goal is to make it simple for you to manage integration "crud" render and to let you configure less common ones with ease.

## Installation
Install the bundle for now is manuel !! as is still on beta version !!

Copy all files in root of your "sandBox"
```
project
│   assets
│   bin
│   config
|   ....
└───Library
│   │   NeoxTableBundle

````


Register the bundle in your AppKernel:
```php
Bundles.php
<?php

return [
    .....
    NeoxTable\NeoxTableBundle\NeoxTableBundle::class => ['all' => true],
    .....
];
```
Register the bundle in Composer.json

````json
    "autoload": {
        "psr-4": {
            "NeoxTable\\NeoxTableBundle\\": "Library/NeoxTableBundle/src/",
            "App\\": "src/"
        }
    },
````
**NOTE:** _You may need to use [ symfony composer dump-autoload ] to reload autoloading_
Done 🎈


## Configuration

No configuration except that you have install stimulus/turbo-ux and setup correctly !!

How to use in console ?
``` symfony console neox:table:crud ```

```
 The class name of the entity to create --> NeoxTable !! <-- CRUD (e.g. Deliciou
sGnome):
 > 
```
Enter name entity that you want to "crud"

```
 Choose a name for your controller class (e.g. TestController) [TestController]:
 >
```
Enter path that you want for create controller ex: Admin\test\crud

```
 Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]
:
 >
```
Yes or no generate tests ?

that all !! it will generate for you all : 
```
project
│   assets
│   bin
│   config
|   ....
└─── src
│   └─── Controller
│       └─── Admin
|           └─── test
|               └─── crudController.php
|   └─── Form
|       └─── TestType.php
└─── templates
|   └─── admin
|       └─── test
|           └─── _delete_form_html_twig
|           └─── _form.html.twig
|           └─── crud.html.twig
|           └─── index.html.twig
|           └─── show.html.twig
└─── translations
|   └─── test.fr.yml

```
Them you need to setup one line at liste in controller :
```
└─── src
│   └─── Controller
│       └─── Admin
|           └─── test
|               └─── crudController.php
```
```php
    /**
     * @throws NonUniqueResultException
     */
    #[Route('/', name: 'app_admin_post_crud_index', methods: ['GET'])]
    public function index(Request $request, PostRepository $postRepository): Response
    {
//        $header =  (new buttonBuild())
//            ->setLabel("Back Post")
//            ->setRef($this->generateUrl("app_admin_post_crud_index") )
//            ->setClass("button-info bd-highlight")
//            ->setStyle("height: 30px", true)
//            ->setIcon("bi-arrow-left-square")
//            ->build();

        $neoxTable = $this->getNeoxTableBuilder()
            ->filterFields("#, title, summary, author.email@user", "post") 
            ->setEntity($postRepository->findAll())
//            ->setActButton($header,"h")
            ->setActButton("@app_admin_post_crud")

        ;

        // 🔥 The magic happens here! 🔥
            if ( $this->getNeoxTableBuilder()::checkTurbo($request) ) {
            return $this->render('@NeoxTable/neoxTable.html.twig',["neoxTable" => $neoxTable  ]);
        }

        return $this->render('admin/post/crud/index.html.twig', [
            'neoxTable' => $neoxTable,
        ]);
    }

```
**As you can see :** _🔥 The magic happens here! 🔥 YES it's made with Magic of Turbo-ux_

```
->filterFields("#, title, summary, author.email@user", "post", [...]) <----- !!here
```
Add all field that you need to see in render table. *if you have relation in entity : author.email@user [@ is use to give domaine name for translator]

**NOTE:** _You can add any button manually in header or in table colonne_
````
        $header =  (new buttonBuild())
            ->setLabel("Back Post")
            ->setRef($this->generateUrl("app_admin_post_crud_index") )
            ->setClass("button-info bd-highlight")
            ->setStyle("height: 30px", true)
            ->setIcon("bi-arrow-left-square")
            ->build();
````
This generate for you all standard button crud : add - delete - pin - edit -- return
````
    ->setActButton("@app_admin_post_crud")  --> all button header and table colonne
    ->setActButton("#app_admin_post_crud")  --> only button table colonne
````

If you need to add special Js or css 
````
    ->styling([...template.html.twig...])
````


## Contributing
If you want to contribute \(thank you!\) to this bundle, here are some guidelines:

* Please respect the [Symfony guidelines](http://symfony.com/doc/current/contributing/code/standards.html)
* Test everything! Please add tests cases to the tests/ directory when:
    * You fix a bug that wasn't covered before
    * You add a new feature
    * You see code that works but isn't covered by any tests \(there is a special place in heaven for you\)

## Todo
* Packagist

## Thanks