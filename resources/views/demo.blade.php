<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <title>Warning</title>
    <style>
        * {
            transition: all 0.6s;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: #888;
            margin: 0;
        }

        #main {
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }

        .fof {
            display: table-cell;
            vertical-align: middle;
        }

        .fof h1 {
            font-size: 50px;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }

        @keyframes type {
            from {
                box-shadow: inset -3px 0px 0px #888;
            }

            to {
                box-shadow: inset -3px 0px 0px transparent;
            }
        }

        a {
       color: #ffffff;
        background-color: #379437;
        box-shadow: 1px 0px 5px 2px #88888880;
        padding: 8px;
        margin: 4px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        }
    </style>
</head>
<div id="main">
    <div class="fof">
        <h1>this functionality is not available on demo mode!</h1><br>
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
</div>

</html>