<!DOCTYPE html>
<html>
<head>
    <title>Projeto Plannera</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- ANGULAR -->
    <script src="js/angular.min.js" type="text/javascript"></script>
    <script src="js/angular-route.min.js" type="text/javascript"></script>

    <!-- JQUERY BOOTSTRAP -->
    <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">var CONSTTK = "{{ csrf_token() }}";</script>

    <script src="js/app.js" type="text/javascript"></script>
    <script src="js/controller.js" type="text/javascript"></script>
    <script src="js/services.js" type="text/javascript"></script>
    <script src="js/directive.js" type="text/javascript"></script>

</head>
<body ng-app="App">
    <div ng-view></div>
</body>
</html>