<!DOCTYPE html>
<html>
    <head>
        <title>I@D_Tchat</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/main.css">
    </head>

    <body>
        <div class="container">
            <header>
                <?php if (!$authService->getIsAuth()) { ?>
                    <a href="/index.php?controller=register"><button type="button" class="btn btn-primary btn-md">Inscription</button></a>
                    <a href="/index.php?controller=auth"><button type="button" class="btn btn-primary btn-md">Connexion</button></a>
                <?php } else { ?>
                    <a href="/index.php?controller=auth&action=disconnect"><button type="button" class="btn btn-primary btn-md">Déconnexion</button></a>
                <?php } ?>
            </header>
            <h1 id="main-title">I@D - Tchat</h1>
            <div id="tchat" class="col-xs-12 clearfix">
                <?php include 'View/message/messages.php';?>
            </div>

            <div class="clearfix"></div>
        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>

