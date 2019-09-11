<?php
/*
 * Author: Stanley V
 * Date: MAy 8 , 2019
 *
 * get_log.php
 *
 * Used to get data from the DB server based on dates specified by user.
*/

include_once 'dbh.inc.php';
$output = '';

/*
 * Check if from_date and to_date is not null
 */

if(isset($_POST["from_date"], $_POST["to_date"]))
{

    $sql = "SELECT * FROM LOG L INNER JOIN \"USER\" U ON L.user_id = U.user_id WHERE CONVERT (date,L.date) BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."';";
    $result = odbc_exec($conn, $sql);

    /*
     * Checking if there is any results if yes storing results in $output
     */

    if(odbc_num_rows($result) > 0)
    {
        while($row = odbc_fetch_array($result))
        {
            $output .= '
                    <tr>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal"
                                    data-target="#id_'. $row["record_id"] .'">
                                View Message
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="id_'. $row["record_id"] .'" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sent
                                                by: '. $row["name"] .'</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            '. nl2br($row["message"]) .'
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>'. $row["name"] .' ('. $row["username"] .')</td>
                        <td>'. date('m/d/y - h:i A', strtotime($row["date"])) .'</td>
                        <td>'. $row["sent_count"] .'</td>
                    </tr>
                ';
        }
    }
    else
    {
        /*
         * If no results found print message
         */

        $output .= '  
                <tr>  
                     <td colspan="5">No Records Found :(</td>  
                </tr>  
           ';
    }
    $output .= '</table>';
    echo $output;
}
?>
