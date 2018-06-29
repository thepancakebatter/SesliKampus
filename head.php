

<head>
    <title>SesliKampüs</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://rawgithub.com/moment/moment/2.2.1/min/moment.min.js"></script>
<!--    <link rel="stylesheet" href="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.css">-->
<!--    <script src="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script>-->
<!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<!--    <script src="https://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>-->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<!--    <script src="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--    <script src="--><?php //echo $_SESSION['myHost']; ?><!--javascripts/jquery.ui.touch-punch.min.js"></script>-->
    <script src="<?php echo $_SESSION['myHost']; ?>javascripts/Xmap.js"></script>

    <style>
        body {
            margin: 0px;
            font-family: Helvetica;
            overflow: hidden;
            text-shadow: none;
        }
        i { text-shadow: none;}
        span {
            cursor: pointer;
        }
        div{text-shadow: none;}
        .navigation {
            cursor: pointer;
            color: firebrick;
            text-decoration-line: underline;
        }

        .navigate {
            cursor: pointer;
            color: firebrick;
            text-decoration-line: underline;
        }

        .inputs {
            cursor: pointer;
            color: #0c3d5d;
            text-decoration-line: underline;
            font-weight: bold;
        }

        div.inscription {
            display: block;
            width: 50%;
        }

        input.inscription {
            width: 100%;

        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .list-order {
            cursor: pointer;
            font-size: 12px;
        }

        .edit {
            cursor: pointer;
            font-size: 12px;

        }

        .remove {
            cursor: pointer;
            font-size: 12px;
        }

        .edit-selected-outside {
            background: #d7ecfa;
            position: fixed;
            margin: auto;
            display: none;
        }

        .close-edit {
            cursor: pointer;
            float: right;
        }

        .material-icons {
            cursor: pointer;
        }

    </style>

</head>
