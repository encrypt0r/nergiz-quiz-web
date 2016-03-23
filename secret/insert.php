<div class="page-header">
    <h3>Insert A new person</h3>
</div>
<form class="horizantal-form" method="POST" action="../api.php">
    Name:
    <input class="form-control" type="text" name="name" placeholder="Write the name (string)"/>
    Time:
    <input class="form-control" type="text" name="time" placeholder="Write the number of seconds it took to complete the test (int)"/>
    Accuracy:
    <input class="form-control" type="text" name="accuracy" placeholder="Write the accuracy (from 0.0 to 1.0) (float)"/>
    <input class="sr-only" type="text" value="pass" name="password"/>
    
    <br>
    <input class="btn btn-success form-control" type="submit" value="Insert new person"/>
</form>

