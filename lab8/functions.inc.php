<?php

    function outputOrderRow($file, $title, $quantity, $price) {
        echo "<tr>";
        //TODO
		$total = $quantity * $price;
		$source = "images/books/tinysquare/".$file;
		echo "<td><img src = $source></td>";
		echo "<td class='mdl-data-table__cell--non-numeric'>$title</td>";
		echo "<td>$quantity</td>";
		echo "<td>$$price.00</td>";
		echo "<td>$$total.00</td>";
        echo "</tr>";
    }
?>