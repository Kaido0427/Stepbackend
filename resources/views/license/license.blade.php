<?php
$api = new LicenseBoxExternalAPI(); // Initialize a new LicenseBoxAPI object
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<title>step - Installer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <style>
    #cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
    }

    @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
    }

    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }

    #cover-spin::after {
        content:'';
        display:block;
        position:absolute;
        left:48%;top:40%;
        width:40px;height:40px;
        border-style:solid;
        border-color:black;
        border-top-color:transparent;
        border-width: 4px;
        border-radius:50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
    .title{
        padding-top: 20px;
    }
    .custom_error{
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #dc3545;
    }
    </style>
</head>

<body>
<div id="cover-spin"></div>
<?php
$errors = false;
$step = isset($_GET['step']) ? $_GET['step'] : '';
?>
<div class="container">
    <div class="section">
        <div class="column is-6 is-offset-3">
            <center>
                <h1 class="title">step</h1><br>
            </center>
            <div class="box">
                <?php
                switch ($step) {
                    default: ?>
                        <div class="tabs is-fullwidth">
                            <ul>
                                <li class="is-active">
                                    <a>
                                        <span><b>Requirements</b></span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Verify</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Database</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Finish</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        // Add or remove your script's requirements below
                        if (phpversion() < "5.5") {
                            $errors = true;
                            echo "<div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> Current PHP version is " . phpversion() . "! minimum PHP 5.5 or higher required.</div>";
                        } else {
                            echo "<div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> You are running PHP version " . phpversion() . "</div>";
                        }
                        if (!extension_loaded('mysqli')) {
                            $errors = true;
                            echo "<div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> MySQLi PHP extension missing!</div>";
                        } else {
                            echo "<div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> MySQLi PHP extension available</div>";
                        } ?>
                        <div style='text-align: right;'>
                            <?php if ($errors == true) { ?>
                                <a href="javascript:void(0)" class="button is-link" DésActivéd>Suivant</a>
                            <?php } else { ?>
                                <a href="{{url('installer')}}?step=0" class="button is-link">Suivant</a>
                                @csrf
                            <?php } ?>
                        </div>
                        <?php
                                break;
                            case "0": ?>
                        <div class="tabs is-fullwidth">
                            <ul>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Conditions</span>
                                    </a>
                                </li>
                                <li class="is-active">
                                    <a>
                                        <span><b>Verifier</b></span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Base de données</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Finir</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                                $license_code = null;
                                $client_name = null;
                                if (!empty($_POST['license']) && !empty($_POST['client']))
                                {
                                    $license_code = strip_tags(trim($_POST["license"]));
                                    $client_name = strip_tags(trim($_POST["client"]));
                                    /* Once we have the license code and client's name we can use LicenseBoxAPI's activate_license() function for activating/installing the license, if the third parameter is empty a local license file will be created which can be used for background license checks. */
                                    $activate_response = $api->activate_license($license_code, $client_name);
                                    if (empty($activate_response)) {
                                        $msg = 'Server is unavailable.';
                                    } else {
                                        $msg = $activate_response['message'];
                                    }
                                    if ($activate_response['status'] != true) { ?>
                                <form action="{{url('installer')}}?step=0" method="POST">
                                    @csrf
                                    <div class="notification is-danger"><?php echo ucfirst($msg); ?></div>
                                    <div class="field">
                                        <input type="hidden" name="license_code" value="<?php echo $license_code ?>">
                                        <input type="hidden" name="client_name" value="<?php echo $client_name ?>">
                                        <label class="label">License code</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="enter your purchase/license code" name="license" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Envato username</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="enter your name/envato username" name="client" required>
                                        </div>
                                    </div>
                                    <div style='text-align: right;'>
                                        <button type="submit" class="button is-link">Verify</button>
                                    </div>
                                </form><?php
                                    } else { ?>
                                <form action="{{url('installer')}}?step=1" method="POST">
                                    @csrf
                                    <div class="notification is-success"><?php echo ucfirst($msg); ?></div>
                                    <input type="hidden" name="lcscs" id="lcscs" value="<?php echo ucfirst($activate_response['status']); ?>">
                                    <input type="hidden" name="license_code" value="<?php echo $license_code ?>">
                                    <input type="hidden" name="client_name" value="<?php echo $client_name ?>">
                                    <div style='text-align: right;'>
                                        <button type="submit" class="button is-link">Suivant</button>
                                    </div>
                                </form><?php
                                    }
                                } else { ?>
                            <form action="{{url('installer')}}?step=0" method="POST">
                                @csrf
                                <div class="field">
                                    <label class="label">License code</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="enter your purchase/license code" name="license" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Nom d'Client Envato</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="enter your name/envato username" name="client" required>
                                    </div>
                                </div>
                                <div style='text-align: right;'>
                                    <button type="submit" class="button is-link">Verifier</button>
                                </div>
                            </form>
                        <?php }
                                break;
                            case "1": ?>
                        <div class="tabs is-fullwidth">
                            <ul>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Conditions</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Verifier</span>
                                    </a>
                                </li>
                                <li class="is-active">
                                    <a>
                                        <span><b>Base de données</b></span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>Finir</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                                if ($_POST && isset($_POST["lcscs"])) {
                                    $valid = strip_tags(trim($_POST["lcscs"]));
                                    $license_code = strip_tags(trim($_POST["license_code"]));
                                    $client_name = strip_tags(trim($_POST["client_name"]));
                                    $db_host = strip_tags(trim($_POST["host"] ?? ""));
                                    $db_user = strip_tags(trim($_POST["user"] ?? ""));
                                    $db_pass = strip_tags(trim($_POST["pass"] ?? ""));
                                    $db_name = strip_tags(trim($_POST["name"] ?? ""));
                                    // Let's import the sql file into the given database
                                    if (!empty($db_host)) {
                                        $con = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                                        if (mysqli_connect_errno()) { ?>
                                    <form action="{{url('installer')}}?step=1" method="POST">
                                        @csrf
                                        <div class='notification is-danger'>Failed to connect to MySQL: <?php echo mysqli_connect_error(); ?></div>
                                        <input type="hidden" name="lcscs" id="lcscs" value="<?php echo $valid; ?>">
                                        <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                        <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                        <div class="field">
                                            <label class="label">Database Host</label>
                                            <div class="control">
                                                <input class="input" type="text" id="host" placeholder="Entrez l'hôte de votre base de données" name="host" required>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Database Username</label>
                                            <div class="control">
                                                <input class="input" type="text" id="user" placeholder="Entrez le nom d'Client de votre base de données" name="user" required>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Database Password</label>
                                            <div class="control">
                                                <input class="input" type="text" id="pass" placeholder="Entrez le mot de passe de votre base de données" name="pass">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Database Name</label>
                                            <div class="control">
                                                <input class="input" type="text" id="name" placeholder="Entrez le nom de votre base de données" name="name" required>
                                            </div>
                                        </div>
                                        <div style='text-align: right;'>
                                            <button type="submit" class="button db_import is-link">Importer</button>
                                        </div>
                                    </form><?php
                                            exit;
                                        }
                                        $templine = '';
                                        $filename = public_path('step.sql');
                                        $lines = file($filename);
                                        foreach ($lines as $line) {
                                            if (substr($line, 0, 2) == '--' || $line == '')
                                                continue;
                                            $templine .= $line;
                                            $query = false;
                                            if (substr(trim($line), -1, 1) == ';') {
                                                $query = mysqli_query($con, $templine);
                                                $templine = '';
                                            }
                                        } ?>
                                <form action="{{url('installer')}}?step=2" method="POST">
                                    @csrf
                                    <div class='notification is-success'>Database was successfully imported.</div>
                                    <input type="hidden" name="dbscs" id="dbscs" value="true">
                                    <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                    <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                    <input type="hidden" name="db_host" id="db_host" value="<?php echo $db_host; ?>">
                                    <input type="hidden" name="db_user" id="db_user" value="<?php echo $db_user; ?>">
                                    <input type="hidden" name="db_pass" id="db_pass" value="<?php echo $db_pass; ?>">
                                    <input type="hidden" name="db_name" id="db_name" value="<?php echo $db_name; ?>">
                                    <div style='text-align: right;'>
                                        <button type="submit" class="button is-link">Suivant</button>
                                    </div>
                                </form><?php
                                    } else { ?>
                                <form action="{{url('installer')}}?step=1" method="POST">
                                    @csrf
                                    <input type="hidden" name="lcscs" id="lcscs" value="<?php echo $valid; ?>">
                                    <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                    <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                    <div class="field">
                                        <label class="label">Database Host</label>
                                        <div class="control">
                                            <input class="input" type="text" id="host" placeholder="Entrer l'hote de votre base de données" name="host" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Database Username</label>
                                        <div class="control">
                                            <input class="input" type="text" id="user" placeholder="Entrer le nom d'Client de votre base de données" name="user" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Database Password</label>
                                        <div class="control">
                                            <input class="input" type="text" id="pass" placeholder="entrer le mot de passe de votre base de données" name="pass">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Database Name</label>
                                        <div class="control">
                                            <input class="input" type="text" id="name" placeholder="Entrer le nom de votre base de données" name="name" required>
                                        </div>
                                    </div>
                                    <div style='text-align: right;'>
                                        <button type="submit" class="button db_import is-link">Importer</button>
                                    </div>
                                </form><?php
                                    }
                                } else { ?>
                            <div class='notification is-danger'>Sorry, something went wrong.</div><?php
                                                                                                }
                                                                                                break;
                                                                                            case "2": ?>
                        <div class="tabs is-fullwidth">
                            <ul>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Conditions</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Verifier</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span><i class="fa fa-check-circle"></i> Base de données</span>
                                    </a>
                                </li>
                                <li class="is-active">
                                    <a>
                                        <span><b>Finish</b></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                            if ($_POST && isset($_POST["dbscs"])) {
                                $valid = $_POST["dbscs"];
                                $license_code = $_POST['license_code'];
                                $client_name = $_POST['client_name'];
                                $db_host = strip_tags(trim($_POST["db_host"]));
                                $db_user = strip_tags(trim($_POST["db_user"]));
                                $db_pass = strip_tags(trim($_POST["db_pass"]));
                                $db_name = strip_tags(trim($_POST["db_name"]));
                            ?>
                            <center>
                                <p><strong>Admin credential</strong></p><br>
                            </center>

                            <form action="#" id="admin-detal-form" method="POST">
                                <div class="field">
                                    <label class="label">Admin Email</label>
                                    <div class="control">
                                        <input class="input" type="email" value="step@saasmonks.in" id="email" placeholder="Enter your admin email" name="email">
                                        <p class="email" style='color:#f74416;'></p>
                                    </div>
                                    <span class="custom_error text-red-500 text-xs w-full font-bold"><span class="email"></span></span>
                                </div>
                                <input type="hidden" name="db_host" value="<?php echo $db_host; ?>">
                                <input type="hidden" name="db_user" value="<?php echo $db_user; ?>">
                                <input type="hidden" name="db_pass" value="<?php echo $db_pass; ?>">
                                <input type="hidden" name="db_name" value="<?php echo $db_name; ?>">
                                <input type="hidden" name="license_code" value="<?php echo $license_code; ?>">
                                <input type="hidden" name="client_name" value="<?php echo $client_name; ?>">
                                <div class="field">
                                    <label class="label">Admin Password</label>
                                    <div class="control">
                                        <input class="input" type="text" id="password" placeholder="Entrer votre mot de passe administrateur" value="123456" name="password">
                                        <p class="password" style='color:#f74416;'></p>
                                    </div>
                                    <span class="custom_error text-red-500 text-xs w-full font-bold"><span class="password"></span></span>
                                </div>
                                <div style='text-align: right;'>
                                    <button type="button" id="admin-login-btn" class="button is-link">Poursuivre vers la connexion.</button>
                                </div>
                            </form>
                        <?php
                                                                                                } else { ?>
                            <div class='notification is-danger'>Désolé, une erreur s'est produite.</div><?php
                                                                                                }
                                                                                                break;
                                                                                        } ?>
            </div>
        </div>
    </div>
</div>
<div class="content has-text-centered">
    <p>Copyright <?php echo date('Y'); ?> Entreprise, Tous droits réservés.</p><br>
</div>
</body>

<script>
jQuery(document).ready(function($) {
    $(".db_import").on('click', function(event) {
        $('#cover-spin').show(0)
    });
});

jQuery(document).on("click", "#admin-login-btn", function()
{
    url = window.location.origin + window.location.pathname
    url = url.slice(0, -1)
    var name = "{{url('')}}" + '/';
    var formData = new FormData($('#admin-detal-form')[0]);
    $.ajax({
        type: "POST",
        url: name + "SauvegarderEnvData",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result)
        {  
            if (result.success == true) {
                console.log(result);
                $.ajax(
                {
                    type: "POST",
                    url: name + "SauvegarderAdminData",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result)
                    {                            
                        console.log(result);

                        if (result.success == true)
                        {
                            console.log(result);
                            window.location.replace(result.data);
                        }
                        else{
                            alert(result.message);
                        }
                    },
                    error: function(err) {
                        alert(result.message);
                    }
                });
            }
            else{
                alert(result.message);
            }
        },
        error: function(err) {
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".custom_error ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
});
</script>

</html>
