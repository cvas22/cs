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
$output = fopen('../dat/barchart_slc_avg.csv', 'w');

// Output the column headings
fputcsv($output, array('bed_count', 'average_price'));

while($data=mysqli_fetch_array($result_bed, MYSQLI_NUM)) 
{

//echo $data[0] . '<br>';
fwrite($output, $data[0] . ',');

//For each bed count in Salt Lake county, find the average bed price
$SelectQ = "SELECT ceil(avg(average)) FROM stats_bed WHERE COUNTY='Salt Lake' and bed_count = $data[0];";
	
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
echo "Average Price per bedroom in Salt Lake County <br> <br>";
echo "</h1>";
?>


<!DOCTYPE html>
<div>
<script src="../js/d3.v3.min.js"></script>
<script>
    var margin = {top: 20, right: 20, bottom: 70, left: 40},
        width = 600 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;
    // Parse the values
    var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);
	var y = d3.scale.linear().range([150, 0]);
    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom")
        .ticks(15);
    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(10);
    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
        "translate(" + margin.left + "," + margin.top + ")");
    d3.csv("../dat/barchart_slc_avg.csv", function(error, data) {
        data.forEach(function(d) {
            d.bed_count = +d.bed_count;
            d.average_price = +d.average_price
;
        });

        x.domain(data.map(function(d) { return d.bed_count; }));
        y.domain([0, d3.max(data, function(d) { return d.average_price; })]);
        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", "-.55em")
            .attr("transform", "rotate(-90)" );
        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Value ($ x 10000)");
        svg.selectAll("bar")
            .data(data)
            .enter().append("rect")
            .style("fill", "steelblue")
            .attr("x", function(d) { return x(d.bed_count); })
            .attr("width", x.rangeBand())
            .attr("y", function(d) { return y(d.average_price); })
            .attr("height", function(d) { return height - y(d.average_price); });
    });
</script>
</div>
</body>

</html>
