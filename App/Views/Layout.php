<?php

namespace App\Views;

class Layout
{
    public static function header($title = "Biblio") {
        echo <<< HTML
        <!DOCTYPE html>
        <html lang="hu">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>
            
            <!-- styles -->
            <link rel="stylesheet" href="../../style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- scripts -->
        </head>
        <body>
    HTML;

        self::navbar(); // call the navbar at the top of the page
        //self::handleMessage();
        echo "<div class='container'>";
    }

    private static function handleMessage() {
        // TODO
        $messages = [
            "success-message" => 'success'
        ];
    }

    public static function navbar() {
        echo <<< HTML
        <nav class="navbar">
            <ul class="nav-list">
               <li class="nav-button"><a href="/"><button style="button">Main page</button></a></li>
               <!--<li class="nav-button"><a href="/create_db"><button style="button">Create database</button></a></li>-->
               <li class="nav-button"><a href="/books"><button style="button">Books</button></a></li>
               <li class="nav-button"><a href="/authors"><button style="button">Authors</button></a></li>
               <li class="nav-button"><a href="/publishers"><button style="button">Publishers</button></a></li>
            </ul>
        </nav>
    HTML;
    }

    public static function sidebar() {
        echo <<< HTML
        <aside>
            <h3>Sidebar</h3>
        </aside>
    HTML;
    }

    public static function footer() {
        echo <<< HTML
                </div>
                <footer>
                    <hr>
                    <p>2025 &copy; Kolozsvári Barnabás</p>
                </footer>
            </body>
        </html>
    HTML;
    }
}