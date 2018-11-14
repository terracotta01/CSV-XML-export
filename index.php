<?php include_once 'header.php'; ?>

  <body>
    <div class="">
        <form class="selectFile" action="index.php" method="post">
          <div class="input-field col s12">
            <select name="csv_xml" >
              <option value="" disabled selected>Choose CSV or XML</option>
              <option value="csvFile">CSV</option>
              <option value="xmlFile">XML</option>
            </select>
        </div>
          <br></br>
          <button class="btn waves-effect waves-light" type="button" id="GetFile">Submit</button>
          <p id="sucess" onclick="sucess()"></p>
          <p id="fail" onclick="fail()"></p>
        </form>
    </div>

    

<?php include_once 'footer.php';?>
