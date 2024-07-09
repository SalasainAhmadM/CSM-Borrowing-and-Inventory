<?php
// get the filter type from the AJAX request
$filter = $_POST['filter'];

// filter the chemicals based on the provided filter type
$res = selectAll('chemical');
$filtered_data = '';
while ($row = mysqli_fetch_assoc($res)) {
    $current_date = strtotime(date('Y-m-d'));
    $expiration_date = strtotime($row['date_exp']);
    $days_diff = ($expiration_date - $current_date) / 86400; //86400 seconds in a day
    if ($filter == 'expiring' && $days_diff < 60 && $expiration_date >= $current_date) {
        $filtered_data .= '<a class="dropdown-item" href="#">' . $row['name'] . ' (' . $row['quantity'] . ' left)</a>';
    } else if ($filter == 'expired' && $expiration_date < $current_date) {
        $filtered_data .= '<a class="dropdown-item" href="#">' . $row['name'] . ' (' . $row['quantity'] . ' left)</a>';
    } else if ($filter == 'critical' && $row['quantity'] <= 100) {
        $filtered_data .= '<a class="dropdown-item" href="#">' . $row['name'] . ' (' . $row['quantity'] . ' left)</a>';
    }
}

// return the filtered data as HTML
echo $filtered_data;
?>