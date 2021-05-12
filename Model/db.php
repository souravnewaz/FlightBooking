<?php
        $connection = oci_connect('Airlines', 'airlines', 'localhost/XE')
                        or die(oci_error());
        if(!$connection){
            echo '<p style="color:red;">Failed to connect</p>';
        }
        else {
                //echo '<p style="color:#46A049;">connected to oracle database</p>';
        }
        

         function login($name, $password){
             global $connection;

            try{
                $sql = "select * from USERS WHERE USER_NAME = '$name'";        
            $stmt = oci_parse($connection, $sql);        
            oci_execute($stmt);

            while (oci_fetch($stmt)) {            
                $pw =oci_result($stmt, 'PASSWORD');
            }    
          
             if($pw == $password){
                 return 1;                 
             } else{
                
                 return 0;
             }

            } catch (Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
             
         }

         function adminLogin($name, $password){
            global $connection;

           try{
               $sql = "select * from ADMIN WHERE ADMIN_NAME = '$name'";        
           $stmt = oci_parse($connection, $sql);        
           oci_execute($stmt);

           while (oci_fetch($stmt)) {            
               $pw =oci_result($stmt, 'PASSWORD');
           }    
         
            if($pw == $password){
                return 1;                 
            } else{
               
                return 0;
            }

           } catch (Exception $e){
               echo 'Message: ' .$e->getMessage();
           }
            
        }

         function signup($name, $email, $phone, $address, $password){
            global $connection;
            //$p = 8;

            $stid = oci_parse($connection, 'begin :r := ALREADY_EXISTS(:name); end;');
            oci_bind_by_name($stid, ':name', $name);
            oci_bind_by_name($stid, ':r', $r, 40);

            oci_execute($stid);
            if ($r != 1){
                try{
                
                    $sql = "INSERT INTO USERS (USER_ID, USER_NAME, EMAIL, PHONE, PASSWORD, ADDRESS) 
                    values (user_id.nextval, to_char('$name'), to_char('$email'), to_char('$phone'), to_char('$password'), to_char('$address'))";
                    //$sql = "INSERT INTO USERS (user_id, USER_NAME, EMAIL, PHONE, PASSWORD, ADDRESS) VALUES (user_id.nextval, to_char('$name'), to_char('$email'), to_char('$phone'), to_char('$password'), to_char('$address'));";
                    
                    $stmt = oci_parse($connection, $sql);        
                    $result = oci_execute($stmt);
                    if($result){
                        echo "Registration successful";
                        exit();
                    } else{
                        echo "Error";
                    }
    
                } catch(Exception $e){
                    echo 'Message: ' .$e->getMessage();
                }
            } else {
                echo "xxx User Already Registered xxx";
            }   
            
         }


         function addFlight($takeoff, $landing, $departure){
            global $connection;
            //echo $takeoff."----". $landing;
            $stid = oci_parse($connection, 'begin :r := FLIGHT_EXISTS(:LOC1, :LOC2); end;');
            oci_bind_by_name($stid, ':LOC1', $takeoff);
            oci_bind_by_name($stid, ':LOC2', $landing);
            oci_bind_by_name($stid, ':r', $r, 40);
            oci_execute($stid);
            //echo "Checking::" . $r;
            if($r != 1){
                try{
                    $sql = "INSERT INTO FLIGHT (FLIGHT_ID, TAKEOFF, LANDING , DEPARTURE, STATUS) VALUES (FLIGHT_ID.nextval, '$takeoff', '$landing', DATE' $departure ', 'Available')";
                                    
                    $stmt = oci_parse($connection, $sql);        
                    $result = oci_execute($stmt);
                    if($result){
                        echo '</br><span style="color:#239B56;">Flight added successfully</span>';
                        exit();
                    } else{
                        echo "Error";
                    }
    
                } catch(Exception $e){
                    echo 'Message: ' .$e->getMessage();
                }
            } else {
                echo '<script>alert("Flight Already Exists!")</script>';
            }
            
            

         }
         
         //$d = date('j-m-y');
        // echo $d;
        // addFlight('Qar', 'Dka', $d); 
        //to_date('" . $departure . "','DD:MON:YY HH24:MI:SS')
         


         function viewFlightsAdmin(){
            global $connection;
            $sql = 'select * from flight order by flight_id desc';
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            $no = 0;
            echo '<table>';
            echo '<tr>';
                echo '<th>' . 'No';
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Takeoff';
                echo '<th>' . 'Landing';
                echo '<th>' . 'Departure';
                echo '<th>' . 'Status';
                echo '<th>' . 'Action';
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>'  .++$no. '</td>';
            echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
            echo '<td>' . htmlentities($row->TAKEOFF) . '</td>';
            echo '<td>' . htmlentities($row->LANDING) . '</td>';
            echo '<td>' . htmlentities($row->DEPARTURE) . '</td>';
            echo '<td>' . htmlentities($row->STATUS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/Admin/flightDelete.php?id=" . htmlentities($row->FLIGHT_ID) . "'>"; echo "Delete"; echo "</a>"; echo "</td>";
           
            
            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            echo $count . ' record(s) found.';
            oci_free_statement($stmt);
            //oci_close($connection);           
            
         }

         function viewFlightsUser(){
            global $connection;
            $sql = "SELECT * FROM FLIGHT WHERE STATUS = 'Available'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            echo '<table>';
            echo '<tr>';
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Takeoff';
                echo '<th>' . 'Landing';
                echo '<th>' . 'Departure';
                echo '<th>' . 'Status';
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
            echo '<td>' . htmlentities($row->TAKEOFF) . '</td>';
            echo '<td>' . htmlentities($row->LANDING) . '</td>';
            echo '<td>' . htmlentities($row->DEPARTURE) . '</td>';
            echo '<td>' . htmlentities($row->STATUS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/User/bookingAdd.php?fid=" . htmlentities($row->FLIGHT_ID) . "'>"; echo "Book Now"; echo "</a>"; echo "</td>";
           
            
            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            echo $count . ' record(s) found.';
            oci_free_statement($stmt);
            //oci_close($connection);
            

            
            
         }
         
         function deleteFlight($id){
            global $connection;
            // $sql = "delete from FLIGHT where FLIGHT_ID = '$id'";
            // $stmt = oci_parse($connection, $sql);
            // oci_execute($stmt);

            $sql = "BEGIN DELETE_FLIGHT('$id'); END;";
            $stmt = oci_parse($connection, $sql);              
            $result = oci_execute($stmt);
            echo "Flight deleted successfully";
            
         }

         function id(){
            global $connection;
            $name = "Sourav";
            //get user id
            // SELECT GET_USERID('Sourav')FROM dual;
            $stid = oci_parse($connection, 'begin :id := GET_USERID(:name); end;');
            //$stid = oci_parse($connection, 'begin :n := FLIGHT_EXISTS(:LOC1, :LOC2); end;');
            oci_bind_by_name($stid, ':name', $name);
            oci_bind_by_name($stid, ':id', $id, 40);
            oci_execute($stid);
            echo "Checking--" . $id;
         }
         
         function bookingAdd($fid, $class){
            session_start();
            if (isset($_SESSION['name'])){
                $name= $_SESSION['name'];
            }
            
            global $connection;
            //get user id
            // SELECT GET_USERID('Sourav')FROM dual;
            $stid = oci_parse($connection, 'begin :id := GET_USERID(:name); end;');
            oci_bind_by_name($stid, ':name', $name);
            oci_bind_by_name($stid, ':id', $userId, 40);
            oci_execute($stid);
            //echo "Checking--" . $id;
            //$sql = "SELECT USER_ID  FROM USERS WHERE USER_NAME =  '$name'";
            //$stmt = oci_parse($connection, $sql);
            //oci_execute($stmt);
            //while (($row = oci_fetch_object($stmt)) != false) {
            //$userId =  htmlentities($row->USER_ID) ;
            
            
            try{
                //$sql = "INSERT INTO FLIGHT (FLIGHT_ID, TAKEOFF, LANDING , DEPARTURE, STATUS) VALUES (FLIGHT_ID.nextval, '$takeoff', '$landing', to_date('$departure','DD/MM/YYYY'), 'Available')";
                $sql = "INSERT INTO BOOKING (BOOKING_ID, USER_ID, FLIGHT_ID, CLASS_NAME, STATUS) VALUES (BOOKING_ID.nextval, '$userId', '$fid', '$class', 'Pending')";
                //$sql1 = "UPDATE FLIGHT SET STATUS = 'Booked' WHERE FLIGHT_ID = '$fid'";
                $sql1 = "BEGIN UPDATESTS('$fid', 'Booked'); END;";
                                
                $stmt = oci_parse($connection, $sql);        
                $stmt1 = oci_parse($connection, $sql1);        
                $result = oci_execute($stmt);
                $result1 = oci_execute($stmt1);
                if($result){
                    echo '</br><span style="color:#239B56;">Flight added successfully</span>';
                    exit();
                } else{
                    echo "Error";
                }

                } catch(Exception $e){
                    echo 'Message: ' .$e->getMessage();
                }
             }
            
            
        
        function pendingbookings(){
            echo "<h3>Pending Bookings</h3>";
            global $connection;
            $sql = "select * from BOOKING where STATUS = 'Pending'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            $no = 0;
            echo '<table>';
            echo '<tr>';
                echo '<th>' . 'No';
                echo '<th>' . 'Booking Id';
                echo '<th>' . 'User Id';
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Class Name';
                echo '<th>' . 'Status';
                echo '<th>' . '';
                echo '<th>' . '';
                
                
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>'  .++$no. '</td>';
            echo '<td>' . htmlentities($row->BOOKING_ID) . '</td>';
            echo '<td>' . htmlentities($row->USER_ID) . '</td>';
            echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
            echo '<td>' . htmlentities($row->CLASS_NAME) . '</td>';
            echo '<td>' . htmlentities($row->STATUS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/Admin/bookingApprove.php?id=" . htmlentities($row->BOOKING_ID) . "'>"; echo "Approve"; echo "</a>"; echo "</td>";
            echo '<td>';  echo "<a href='../../Controller/Admin/bookingreject.php?id=" . htmlentities($row->BOOKING_ID) . "'>"; echo "Reject"; echo "</a>"; echo "</td>";
            echo '<td>';  echo "</td>";
            //echo '<td>';    echo "</td>";
           
            
            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            //echo $count . ' record(s) found.';
            oci_free_statement($stmt);
        }
        function approvedbookings(){
            global $connection;
            echo "<h3>Approved Bookings</h3>";
            $sql = "select * from BOOKING where STATUS = 'Approved'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            $no = 0;
            echo '<table>';
            echo '<tr>';
                echo '<th>' . 'No';
                echo '<th>' . 'Booking Id';
                echo '<th>' . 'User Id';
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Class Name';
                echo '<th>' . 'Status';
                echo '<th>' . 'Action';
                
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>'  .++$no. '</td>';
            echo '<td>' . htmlentities($row->BOOKING_ID) . '</td>';
            echo '<td>' . htmlentities($row->USER_ID) . '</td>';
            echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
            echo '<td>' . htmlentities($row->CLASS_NAME) . '</td>';
            echo '<td>' . htmlentities($row->STATUS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/Admin/bookingReject.php?id=" . htmlentities($row->BOOKING_ID) .  "'>"; echo "Reject"; echo "</a>"; echo "</td>";
           
            
            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            //echo $count . ' record(s) found.';
            oci_free_statement($stmt);
        }
        function rejectedbookings(){
            echo "<h3>Rejected Bookings</h3>";
            global $connection;
            $sql = "select * from BOOKING where STATUS = 'Rejected'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            $no = 0;
            echo '<table>';
            echo '<tr>';
                
                echo '<th>' . 'No';
                echo '<th>' . 'Booking Id';
                echo '<th>' . 'User Id';
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Class Name';
                echo '<th>' . 'Status';
                echo '<th>' . 'Action';
                
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>'  .++$no. '</td>';
            echo '<td>' . htmlentities($row->BOOKING_ID) . '</td>';
            echo '<td>' . htmlentities($row->USER_ID) . '</td>';
            echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
            echo '<td>' . htmlentities($row->CLASS_NAME) . '</td>';
            echo '<td>' . htmlentities($row->STATUS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/Admin/bookingApprove.php?id=" . htmlentities($row->BOOKING_ID) . "'>"; echo "Approve"; echo "</a>"; echo "</td>";
            
           
            
            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            //echo $count . ' record(s) found.';
            oci_free_statement($stmt);
        }

        function userbooking(){
            global $connection;
            session_start();
            if (isset($_SESSION['name'])){
                $name= $_SESSION['name'];
            }
            //get user id
            $stid = oci_parse($connection, 'begin :id := GET_USERID(:name); end;');
            oci_bind_by_name($stid, ':name', $name);
            oci_bind_by_name($stid, ':id', $userId, 40);
            oci_execute($stid);
            
            //get single booking
            $sql = "select * from BOOKING where USER_ID = '$userId' ";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            
            $count = 0;
            echo '<table>';
            echo '<tr>';
                
                echo '<th>' . 'Flight Id';
                echo '<th>' . 'Flight Class';
                echo '<th>' . 'Status';
            echo '<tr>';   
            while (($row = oci_fetch_object($stmt)) != false) {
                echo '<tr>';
                echo '<td>' . htmlentities($row->FLIGHT_ID) . '</td>';
                echo '<td>' . htmlentities($row->CLASS_NAME) . '</td>';            
                echo '<td>' . htmlentities($row->STATUS) . '</td>';            
                echo '</tr>';
                $count++;
            }
            echo '</table><br/>';
            echo $count . ' record(s) found.';
            oci_free_statement($stmt);
            }
        

        function approveBooking($id){
            global $connection;
            $sql = "UPDATE BOOKING SET STATUS = 'Approved' WHERE BOOKING_ID = '$id'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            echo "Booking Approved successfully";
        }
        function rejectBooking($id){
            global $connection;
            $sql = "UPDATE BOOKING SET STATUS = 'Rejected' WHERE BOOKING_ID = '$id'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            echo "Booking Rejected successfully";
        }

        function showUsers(){
            global $connection;
            $sql = 'select * from USERS';
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            $count = 0;
            $no = 0;
            echo '<table>';
            echo '<tr>';
                
                echo '<th>' . 'No';
                echo '<th>' . 'User Id';
                echo '<th>' . 'User Name';
                echo '<th>' . 'Email';
                echo '<th>' . 'Phone';
                echo '<th>' . 'Location';
                echo '<th>' . 'Action';
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>'  .++$no. '</td>';
            echo '<td>' . htmlentities($row->USER_ID) . '</td>';
            echo '<td>' . htmlentities($row->USER_NAME) . '</td>';
            echo '<td>' . htmlentities($row->EMAIL) . '</td>';
            echo '<td>' . htmlentities($row->PHONE) . '</td>';
            echo '<td>' . htmlentities($row->ADDRESS) . '</td>';
            echo '<td>'; echo "<a href='../../Controller/Admin/userDelete.php?id=" . htmlentities($row->USER_ID) .  "'>"; echo "Delete User"; echo "</a>"; echo "</td>";            
            echo '</tr>';
            $count++;
            }
            echo '</table><br/>';
            echo $count . ' record(s) found.';
            oci_free_statement($stmt);
        }

        function deleteUsers($id){
            global $connection;
            $sql = "delete from USERS where USER_ID = '$id'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            echo "User deleted successfully";
        }

        function userData (){
            global $connection;
            session_start();
            if (isset($_SESSION['name'])){
                $name= $_SESSION['name'];
            }

            global $connection;
            $sql = "select * from USERS WHERE USER_NAME = '$name'";
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            
            echo '<table>';
            echo '<tr>';
                echo '<th>' . 'User Id';
                echo '<th>' . 'User Name';
                echo '<th>' . 'Email';
                echo '<th>' . 'Phone';
                echo '<th>' . 'Password';
            echo '<tr>'; 
            while (($row = oci_fetch_object($stmt)) != false) {
            echo '<tr>';
            echo '<td>' . htmlentities($row->USER_ID) . '</td>';
            echo '<td>' . htmlentities($row->USER_NAME) . '</td>';
            echo '<td>' . htmlentities($row->EMAIL) . '</td>';
            echo '<td>' . htmlentities($row->PHONE) . '</td>';
            echo '<td>' . htmlentities($row->PASSWORD) . '</td>';
           
            
            
            echo '</tr>';
            
            }
            echo '</table><br/>';
            
            oci_free_statement($stmt);
            
        }

        // Statistics
        function flightCount(){
            global $connection;
            $sql = 'SELECT COUNT(*) AS FLIGHTS FROM FLIGHT';
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            while (($row = oci_fetch_object($stmt)) != false) {
                $flight =  htmlentities($row->FLIGHTS) ;
                echo "<h3>We have total $flight Flight(s)</h3>";
            }
        }
        function userCount(){
            global $connection;
            $sql = 'SELECT COUNT(*) AS USERS FROM USERS';
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            while (($row = oci_fetch_object($stmt)) != false) {
                $users =  htmlentities($row->USERS) ;
            }
            echo "<h3>We have total $users Registered User(s)</h3>";
        }
        function bookingCount(){
            global $connection;
            $sql = 'SELECT COUNT(*) AS BOOKINGS FROM BOOKING';
            $stmt = oci_parse($connection, $sql);
            oci_execute($stmt);
            while (($row = oci_fetch_object($stmt)) != false) {
                $bookings =  htmlentities($row->BOOKINGS) ;
            }
            echo "<h3>We have total $bookings Booking(s)</h3>";
        }
       
        

        

         
    
?>


