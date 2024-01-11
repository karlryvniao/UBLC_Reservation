<?php
    include '../../db_conn.php';
    session_start();
    if (!$_SESSION['id']){
        echo json_encode([
            "error" => "no user found"
        ]);
        exit;
    }

    #Date structure YYYY-MM-DD hh:mm:ss
    $missing = [];
    if($_GET['departure_date'] == null){
        array_push($missing, 'departure_date');
    }
    if($_GET['departure_time'] == null){
        array_push($missing, 'departure_time');
    }
    if($_GET['arrival_date'] == null){
        array_push($missing, 'arrival_date');
    }
    if($_GET['arrival_time'] == null){
        array_push($missing, 'arrival_time');
    }

    if(count($missing)){
        $result = [
            "message" => "Missing query parameter",
            "missing_params" => $missing
        ];
        echo json_encode($result);
        exit;
    }

    $departure_datetime = join(" ",[$_GET['departure_date'], $_GET['departure_time'] . ":00"]);
    $arrival_datetime = join(" ",[$_GET['arrival_date'], $_GET['arrival_time'] . ":00"]);
    $result = [
        "departure_datetime" => $departure_datetime,
        "arrival_datetime" => $arrival_datetime
    ];
    $sql = "SELECT A.id, A.name, A.max_capacity FROM vehicle as A WHERE A.id NOT IN(SELECT DISTINCT B.vehicle_id FROM user_reservation_vehicle as A
    JOIN  reserved_vehicles as B ON B.reservation_id = A.id
    WHERE A.departure <= '$arrival_datetime' AND A.arrival >= '$departure_datetime')";

    $sql_result = $conn->query($sql);
    $query_result = $sql_result->fetch_all(MYSQLI_ASSOC);

    $result['available_vehicles'] = $query_result;

    echo json_encode($result);

?>