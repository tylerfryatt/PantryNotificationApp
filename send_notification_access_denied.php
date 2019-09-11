<?php
require_once('includes/PantryDatabase.php');
require_once('includes/Template.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test: Send Notifications</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <style>
        .container {
            margin-top: 10px;
        }

        #no_access {
            height: 45vh;
            background-color: #FFFACD;
            border-radius: 15px;
            border: 1px solid #6c757d;
            padding: auto;
            margin: 10px;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            align-content: center;
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Notification Sender</h2>
    <div class="row">
        <div id="no_access" class="col-12">ACCESS DENIED: You are either not logged in, or you do not have the authority to access this page.
        </div>
    </div>
</div>
<!-- Bootstrap and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>