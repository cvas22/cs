<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 5/19/2016
 * Time: 1:42 PM
 * barchart.php
 * Data Visualization - Barchart
 */
  
  
// Connect to the database
include "../tools/connect.php";


//echo "PHP Scripted started... Please wait" . '<br> <br>' ;

$SQLQuery = "SELECT distinct bed_count FROM stats_bed WHERE COUNTY='Salt Lake' ORDER BY bed_count ASC";
$result_bed = $conn->query($SQLQuery);


//Create a file pointer connected to the output stream
$output = fopen('../dat/doughnut_slc_low.csv', 'w');

// Output the column headings
fputcsv($output, array('bed_count', 'average_price'));

while($data=mysqli_fetch_array($result_bed, MYSQLI_NUM)) 
{

//echo $data[0] . '<br>';
fwrite($output, $data[0] . ',');

//For each bed count in Salt Lake county, find the average bed price
$SelectQ = "SELECT ceil(avg(lowest)) FROM stats_bed WHERE COUNTY='Salt Lake' and bed_count = $data[0];";
	
$res = $conn->query($SelectQ);

if(!$res){
	echo "SelectQ Query Failed". "<br>";
	echo $SelectQ . '<br>';	
}

$average=mysqli_fetch_array($res, MYSQLI_NUM);

//Export as CSV
fwrite($output, round($average[0]/10000, 2) . "\n");

}
$conn->close();
fclose($output);
echo "<h1> \n";
echo "Lowest Price per bedroom in Salt Lake County <br> <br>";
echo "</h1>";
?>

<!DOCTYPE html>
<script src="//d3js.org/d3.v3.min.js"></script>
<script>

    var width = 400,
        height = 400,
        radius = Math.min(width, height) / 2;

    var color = d3.scale.ordinal()
        .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

    var arc = d3.svg.arc()
        .outerRadius(radius - 10)
        .innerRadius(radius - 70);

    var pie = d3.layout.pie()
        .sort(null)
        .value(function(d) { return d.average_price; });

    var svg = d3.select("body").append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    d3.csv("../dat/doughnut_slc_low.csv", type, function(error, data) {
        if (error) throw error;

        var g = svg.selectAll(".arc")
            .data(pie(data))
            .enter().append("g")
            .attr("class", "arc");

        g.append("path")
            .attr("d", arc)
            .style("fill", function(d) { return color(d.data.bed_count); });

        g.append("text")
            .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
            .attr("dy", ".35em")
            .text(function(d) { return d.data.bed_count; });
    });

    function type(d) {
        d.average_price = +d.average_price;
        return d;
    }

</script>
<footer>
    <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>
</body>
