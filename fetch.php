<?php
    $con = mysqli_connect("localhost","root","","district");
    $sql = "Select Distinct State from district_sample";
    $res = mysqli_query($con , $sql);
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>District</title>
        <!-- <script type="text/javascript" src="js/function.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
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

select {
                appearance: none;
                outline: 0;
                background:  #ddedff;
                background-image: none;
                width: 100%;
                height: 100%;
                color: black;
                cursor: pointer;
                border:1px solid black;
                border-radius:3px;
            }
.select {
                position: relative;
                left:400px;
                display: block;
                width: 15em;
                height: 2em;
                line-height: 3;
                overflow: hidden;
                border-radius: .25em;
                padding-bottom:10px;
                 
            }
         
    
input{
    position:relative;
            font-size:20px;
            left:650px;
            bottom:35px;
            background-color: azure;
            border-color:#3b77bb ;
            border-style: double;
            border-radius:12px;

}
input:hover{
    background-color: #3b77bb;
            color: white;
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
form{
    position: relative;
    left:200px;
}
h4{
    position: relative;
    top:50px;
    left:300px;
}

   
</style>
    </head>
    <body>
    <header>
  <div class="bu">
  <h2>District_Wise_Distribution</h2>   
  </div>
  </header>
         <table border="2">
            <thead>
                <th style="width:30%">State</th>
                <th style="width:30%">District</th>
                <th style="width:10%">Confirmed</th>
                <th style="width:10%">Active</th>
                <th style="width:10%">No of vaccines</th>
            </thead>
            <tbody id="ans">

            </tbody> 
            <div class="box">
         <h4>Select State</h4>
         
        <form action="" method="post">
        <div class="select">
    <select name="Fruit">
        <option value="" disabled selected>Choose option</option>
        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
        <option value="Andhra Pradesh">Andhra Pradesh</option>
        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
        <option value="Assam">Assam</option>
        <option value="Bihar">Bihar</option>
        <option value="Chandigarh">Chandigarh</option>
        <option value="Chhattisgarh">Chhattisgarh</option>
        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
        <option value="Delhi">Delhi</option>
        <option value="goa">Goa</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Haryana">Haryana</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
        <option value="Jharkhan">Jharkhan</option>
        <option value="Karnataka">Karnataka</option>
        <option value="Kerala">Kerala</option>
        <option value="Ladakh">Ladakh</option>
        <option value="Lakshadweep">Lakshadweep</option>
        <option value="Madhya Pradesh">Madhya Pradesh</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="Manipur">Manipur</option>
        <option value="Meghalaya">Meghalaya</option>
        <option value="Mizoram">Mizoram</option>
        <option value="Nagaland">Nagaland</option>
        <option value="Odisha">Odisha</option>
        <option value="Puducherry">Puducherry</option>
        <option value="Punjab">Punjab</option>
        <option value="Rajasthan">Rajasthan</option>
        <option value="Sikkim">Sikkim</option>
        <option value="Tamil Nadu">Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Uttarakhand</option>
        <option value="West Bengal">West Bengal</option>
        
    
    </select>
   </div>
    <input type="submit" name="submit" vlaue="Choose options">
</form>
</div>
<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['Fruit'])) {
        $selected = $_POST['Fruit'];
        $sql = ("Select * from district_sample where State = '{$selected}'");
        $res = mysqli_query($con, $sql );
        if ($res->num_rows > 0) {
        while($rows = mysqli_fetch_array($res)){
            echo "<tr><td>" . $rows["State"] . "</td><td>" . $rows["District"] . "</td><td>" . $rows["Confirmed"] . "</td><td>" . $rows["Active"] . "</td><td>"  . $rows["No_of_vaccines"] . "</td></tr>";
    
         }
          } else {
            echo "0 results";
          }
          $con->close();
    } else {
        echo 'Please select the value.';
    }
    }
?>
   </table> 
    </body>
</html>