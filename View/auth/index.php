<!DOCTYPE html>
<html>
    <head>
        <title>I@D_Connexion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/main.css">
    </head>

    <body>
        <div class="container">
            <header>
                <a href="/"><button type="button" class="btn btn-black btn-md">Retour</button></a>
            </header>

            <h1 id="main-title">I@D - Tchat - Connexion</h1>

            <form method="post" action="/index.php?controller=auth" class="margin-bottom-10">
                <div class="form-group">
                    <label for="name">Pseudo</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Votre Pseudo">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                </div>

                <button type="submit" class="btn btn-black">Connexion</button>
            </form>

            <?php if (!empty($errorMessage)) { ?>
                <div class="alert alert-danger margin-bottom-10" role="alert"><?php echo $errorMessage;?></div>
            <?php } ?>
        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
