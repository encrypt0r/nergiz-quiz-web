<div class="page-header">
    <h3>Insert a new person</h3>
</div>
<form class="horizantal-form" method="POST" action="../api.php">
    <p>Name:
    <input class="form-control" type="text" name="name" placeholder="Write the name (string)"/></p>
    <p>Time:
    <input class="form-control" type="text" name="time" placeholder="Write the number of seconds it took to complete the test (int)"/></p>
    <p>Accuracy:
    <input class="form-control" type="text" name="accuracy" placeholder="Write the accuracy (from 0.0 to 1.0) (float)"/></p>
    <p>Age:
    <input class="form-control" type="text" name="age" placeholder="Write your age (int)"/></p>
    <p>Gender:
    <input type="radio" name="gender" value="true" checked>Male</input>
    <input type="radio" name="gender" value="false">Female</input>
    </p>
    <input class="sr-only" type="password" value="pass" name="password"/>
    <input class="sr-only" type="password" value="insert" name="operation"/>
    
    <p><input class="btn btn-success btn-lg" type="submit" value="Insert new person"/><p>
</form>

