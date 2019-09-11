<?php
/**
 * This is Front End page for Pantry Log Viewer. It mostly contains html and css layout and controls.
 */
session_start();
// testing line: sets the session's user_role variable to 2 (which is the role value for manager)
$_SESSION['user_role'] = 2; // change value to any other number to see the access-denied page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification Log</title>
    <!-- content that is common to all front-facing pages: -->
	<?php require_once('includes/PantryDatabase.php'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./includes/actions/checkRole.js"></script>
	<script type="text/javascript" src="./includes/log_viewer.js"></script>

</head>
<body>
<header>
<?php include_once 'includes/navbar_content.php'; ?>
</header>
<div class="container">
    <h2 class="text-center">Notification Log</h2>
    <div class="row">
        <div class="input-group col-lg-3 col-md-6 mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">From:</span>
            </div>
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" value="<?php echo date("Y-m-d", strtotime('-30 days'));?>">
        </div>
        
        <div class="input-group col-lg-3 col-md-6 mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">To:</span>
            </div>
            <input type="date" id="to_date" class="form-control" placeholder="To Date" value="<?php echo date("Y-m-d");?>">
        </div>
        <div class="input-group col-lg-3 col-md-6 mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">Per page:</span>
            </div>
            <select class="form-control" id="showNumber">
                <option selected="selected">10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div class="input-group col-lg-3 col-md-6 mb-4">
            <button type="button" id="view" class="btn btn-primary btn-sm btn-block">View</button>
        </div>
    </div>
    <div class="row">
        <table id="paginate" class="table table-striped table-borderless">
            <thead class="thead-light">
            <tr>
                <th scope="col" width="10%" class="d-none d-sm-table-cell">record id</th>
                <th scope="col" class="d-none d-sm-table-cell">Sent by:</th>
                <th scope="col">Date and Time:</th>
                <th scope="col" width="10%">Count:</th>
                <th scope="col" width="10%"></th>
            </tr>
            </thead>
            <tbody id="log_content">
            </tbody>
        </table>
        <nav id="paginate_nav" class="m-1">
            <ul class="pagination justify-content-center">
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
