# library-web-application
by Fynn Linus Kölling and Kai Fehrcke

Implementation of a web application for a library website. The application contains several pages with functions such as registration and log-in options, the creation, search and rating of books, and wish lists. All functions are listed in the table below. AJAX applications were written to implement user-related actions. A MySQL database runs in the background.

# Important:
Please note that all text on the pages is written in German. However, the code is commented in English.
To run the application, XAMPP (https://www.apachefriends.org/de/index.html) must be installed and the Apache and MySQL modules must be started. The repository must be stored under C:\xampp\htdocs. The databases in the backend can be accessed in any web browser via http://localhost/phpmyadmin. Before starting the application, a new database with the name **mybib** must be created there! The application can then be accessed in a web browser via http://localhost/repository-name/start.php. It is necessary to call **start.php** first when starting the application for the first time in order to create the necessary tables!

The application comes with admin access. The access details are: Email: **admin@bib.de** Password: **12345**. The admin has special rights such as creating new books or organising user accounts.

## Folder structure:
- Repository: HTML/PHP pages, CSS file and subfolders js, php and pic.
- Subfolder js: Pure Javascript files
- Subfolder php: Pure PHP files
- Subfolder pic: Images for the website

## Functions

| Funktion               | Page         | PHP function          | Javascript           |
|------------------------|--------------|-----------------------|----------------------|
| Guest functions:       |              |                       |                      |
| Create user account    | register.php | register_fkt.php      | check_register_pw.js |
| Show books             | allbooks.php | allbooks_fkt.php      |                      |
| Search book            | allbooks.php | allbooks_fkt.php      |                      |
| Show book information  | info.php     | info_fkt.php          |                      |
| User functions:        |              |                       |                      |
| Log-in                 | login.php    | login_fkt.php         |                      |
| Log-out                |              | logout_fkt.php        |                      |
| Delete user account    |              | deleteAccount_fkt.php |                      |
| Add book to wish list  | info.php     | addwish_fkt.php       |                      |
| Rate book              | rate.php     | rate_fkt.php          | rate.js              |
| Show wish list         | wishlist.php |                       |                      |
| Edit wish list         | wishlist.php | deletewish_fkt.php    |                      |
| Admin functions:       |              |                       |                      |
| Add book               | addbook.php  | addbook_fkt.php       |                      |
| Edit book              | editbook.php | editbook_fkt.php      |                      |
| Delete book            | editbook.php | deletebook_fkt.php    |                      |
| Show user accounts     | allusers.php |                       |                      |
| Show wish lists        | allusers.php |                       |                      |
| Show wish list of user | wishlist.php |                       |                      |

## Sitemap
![Sitemap](https://github.com/FynnKoelling/library-web-application/blob/main/sitemap.png?raw=true)

## Sources:
- HTML table from PHP array: https://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array, Jordan Arseno 06.04.2015 , last access 18.08.2020
- PHP pop-up message: https://stackoverflow.com/questions/15594807/redirect-on-logout-and-display-you-have-successfully-logged-out/15594843, Luke Shaheen 24.03.2013 , last access 18.08.2020 13:04
- Web Navigation Color Icon Pack made by Freepik from https://www.flaticon.com/packs/web-navigation-color
- Book Icon Pack made by Freepik from https://www.flaticon.com/packs/book-3

