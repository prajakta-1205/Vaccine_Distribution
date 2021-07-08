<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statewise_Dustribution</title>
    <style>
      h2{
        position: relative;
        right:500px;
        top:30px;
        font-size: 30px;
        padding:10px;
        text-align:center;
        top:60px;
        color:#D81B60;
            
        }
      
        .bu1{
            position:relative;
            font-size:25px;
            left:450px;
            background-color: azure;
            border-color:#3b77bb ;
            border-style: double;
            border-radius:12px;
            padding:10px;

        }
        .bu1:hover {
            background-color: #3b77bb;
            color: white;
        }
        .bu2{
            position:relative;
            font-size:25px;
            left:500px;
            background-color: azure;
            border-color:#3b77bb ;
            border-style: double;
            border-radius:12px;
            padding:10px;
        }
        .bu2:hover {
            background-color: #3b77bb;
            color: white;
        }
    
      
      table{
        position: relative;
        left:120px; 
        top:50px;
        border-collapse: collapse;
        width: 80%;
        font-size:20px;
        bottom:70px;
        }
        body{

            background-repeat: no-repeat;
            background-size: cover;
            position : relative;
        }
header{
         
          background-color:grey;
          background-image:url("https://science.ku.dk/english/press/news/2020/artificial-intelligence-to-assess-corona-patients-risk-of-needing-ventilators/billedinformationer/Corona_1100.jpg");
          height:100px;
}
th,td{ 
    text-align: left;
    padding: 8px;
    
}
tr:nth-child(odd){
	background-color: white;
	
}
tr:nth-child(even){
	background-color: #ddedff;
	
}
th{
	background-color: #3b77bb ;
    color: white;
	
}
.bu {
  position:relative;
  left:570px;
  bottom: 35px;
  font-size:20px;
}

   
</style>
</head>
<body>
<header>
  <div class="bu">
  <h2>State_Wise_Distribution</h2>  
  </div>
  </header>
<table border="2" id="left">
  <tr>
      <th>State</th>
      <th>Confirmed</th>
      <th>Active</th>
      <th>No_of_vaccines</th>
  </tr>
  

  <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vaccines";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        //Displays all customers
        $sql = "SELECT * FROM state_final";
        $result = $conn->query($sql);

    
if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["State"] . "</td><td>" . $row["Confirmed"] . "</td><td>" . $row["Active"] . "</td><td>"  . $row["NO_of_vaccines"] . "</td></tr>";
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        ?>
</table>
</body>
</html>