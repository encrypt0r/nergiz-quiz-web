 <div class="page-header">   
    <h3>Remove a person</h3>
 </div>
 <div class="alert alert-danger">
     Please note that this can't be undone
 </div>
<form class="horizantal-form" method="POST" action="../api.php">
    
    <p>ID:
    <input class="form-control" type="text" name="id" placeholder="Write the ID (int)"/></p>
    <input class="sr-only" type="password" value="pass" name="HowAreYou?"/>
    <input class="sr-only" type="password" value="remove" name="operation"/>
    <br>
    <input class="btn btn-danger btn-lg" type="submit" value="Remove person"/>
</form>

