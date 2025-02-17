<?php
namespace util;

class Html {
    public static function inicio(string $titulo, array $hojas_estilo ): void {
?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, intial-scale=1">
                <title><?=$titulo?></title>
<?php
            foreach($hojas_estilo as $hoja) {
                echo "\t\t<link type='text/css' rel='stylesheet' href='$hoja'>\n";
}
?>
        </head>
        <body>
<?php        
    }

    public static function fin() { ?>
        </body>
        </html>
<?php
    }
}
?>